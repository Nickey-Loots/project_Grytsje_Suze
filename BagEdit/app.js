import * as THREE from 'three';

import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

import { dripMeshNames, materialGroups, toppingMeshNames } from './config.js';
// SCENE

const scene = new THREE.Scene();
scene.background = null;

// CAMERA

const camera = new THREE.PerspectiveCamera(
  75,
  window.innerWidth / window.innerHeight,
  0.1,
  1000
);

camera.position.set(0, 1.5, 4);

// RENDERER

const renderer = new THREE.WebGLRenderer({
  antialias: true,
  alpha: true
});

const viewerElement = document.getElementById("viewer");

renderer.setSize(viewerElement.clientWidth, viewerElement.clientHeight);
renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
renderer.setClearColor(0xf5f5f5, 1);
renderer.shadowMap.enabled = true;
renderer.shadowMap.type = THREE.PCFShadowMap;

renderer.domElement.style.width = "100%";
renderer.domElement.style.height = "100%";
renderer.domElement.style.display = "block";

viewerElement.appendChild(renderer.domElement);

camera.aspect = viewerElement.clientWidth / viewerElement.clientHeight;
camera.updateProjectionMatrix();

// LIGHTING — 3-point lighting setup for product visualization

const ambientLight = new THREE.AmbientLight(0xffffff, 1.5);
scene.add(ambientLight);

// Key light — main directional light from front-right
const keyLight = new THREE.DirectionalLight(0xffffff, 2.0);
keyLight.position.set(8, 6, 8);
keyLight.castShadow = true;
keyLight.shadow.mapSize.width = 1024;
keyLight.shadow.mapSize.height = 1024;
keyLight.shadow.camera.far = 50;
keyLight.shadow.camera.left = -15;
keyLight.shadow.camera.right = 15;
keyLight.shadow.camera.top = 15;
keyLight.shadow.camera.bottom = -15;
scene.add(keyLight);

// Fill light — opposite side to soften shadows
const fillLight = new THREE.DirectionalLight(0xffffff, 1.5);
fillLight.position.set(-6, 4, -6);
scene.add(fillLight);

// Back light — adds rim lighting and separation
const backLight = new THREE.DirectionalLight(0xffffff, 1.0);
backLight.position.set(0, 8, -10);
scene.add(backLight);


// CONTROLS

const controls = new OrbitControls(
  camera,
  renderer.domElement
);

controls.enableDamping = true;

controls.dampingFactor = 0.05;

// MODEL

const loader = new GLTFLoader();

// -----------------------------
// STATE
// -----------------------------

const state = {
  model: null,
  materials: {},
  layers: {
    topping: {
      sprinkles: false
    },
    drip: {
      goldDrip: false,
      swirlDrip: false
    }
  },
  meshes: {
    topping: {
      sprinkles: []
    },
    drip: {
      goldDrip: [],
      swirlDrip: []
    },
    closed: []
  },
  nodes: {
    closedRoot: null
  },
  // Active drip target: 'Drip' or 'Swirl' — user-selectable via UI toggle
  dripActive: 'Drip',
  // Track the last-selected swatch per group (so toggles can reapply the same swatch)
  selectedSwatches: {
    hardware: { name: "Silver", color: "#a8a8a8" }
  },
  autoRotate: false
};

const allToppingMeshNames = [
  ...toppingMeshNames.sprinkles
];

// -----------------------------
// HELPERS
// -----------------------------

function getMeshNameFromMaterialName(materialName) {
  return String(materialName || "").replace(/\s-\sMaterial(?:\s\d+)?$/, "").trim();
}

function isDripNoneSwatch(swatch) {
  return swatch.name === "None";
}

function updateDripToggleLabels() {
  // No-op: drip target toggle removed; function retained for backward-compatibility.
}

function setToppingLayersFromSwatchName(swatchName) {
  state.layers.topping.sprinkles = swatchName === "Discodip/Sprinkels";
}

function buildSwatchBackground(swatch) {
  if (swatch.accent) {
    return `linear-gradient(135deg, ${swatch.color} 0%, ${swatch.color} 40%, #ffffff 40%, #ffffff 60%, ${swatch.color} 60%, ${swatch.color} 100%)`;
  }

  return swatch.color;
}

function hasAncestorNamed(object3d, targetName) {
  const normalizedTargetName = String(targetName || "").toLowerCase();
  let current = object3d?.parent;

  while (current) {
    if (String(current.name || "").trim().toLowerCase() === normalizedTargetName) {
      return true;
    }
    current = current.parent;
  }

  return false;
}

function getAncestorChain(object3d) {
  const chain = [];
  let current = object3d?.parent;

  while (current) {
    chain.push(String(current.name || current.type || "(unnamed)").trim());
    current = current.parent;
  }

  return chain;
}

function setVisibilityRecursive(object3d, visible) {
  if (!object3d) return;

  object3d.visible = visible;
  object3d.traverse((child) => {
    child.visible = visible;
  });
}

function copyMaterialSettings(sourceMaterial, targetMaterial) {
  if (!sourceMaterial || !targetMaterial) return;

  targetMaterial.copy(sourceMaterial);
  targetMaterial.needsUpdate = true;
}

function getVariantCounterpartName(name) {
  const trimmedName = String(name || "").trim();

  if (!trimmedName) return "";

  if (trimmedName.toLowerCase().endsWith("open")) {
    return trimmedName.replace(/open$/i, "");
  }

  return `${trimmedName}Open`;
}

function syncObjectMaterialAndVisibility(sourceObject, targetObject) {
  if (!sourceObject || !targetObject) return;

  // Only sync materials, NOT visibility
  // Visibility will be handled separately based on layer state

  const sourceMaterial = sourceObject.material;
  const targetMaterial = targetObject.material;

  if (Array.isArray(sourceMaterial) && Array.isArray(targetMaterial)) {
    const count = Math.min(sourceMaterial.length, targetMaterial.length);
    for (let index = 0; index < count; index += 1) {
      copyMaterialSettings(sourceMaterial[index], targetMaterial[index]);
    }
  } else if (!Array.isArray(sourceMaterial) && !Array.isArray(targetMaterial)) {
    copyMaterialSettings(sourceMaterial, targetMaterial);
  }
}

function syncVariantState(sourceRoot, targetRoot) {
  if (!sourceRoot || !targetRoot) return;

  const targetLookup = new Map();

  targetRoot.traverse((child) => {
    const childName = String(child.name || "").trim().toLowerCase();
    if (childName) {
      targetLookup.set(childName, child);
    }
  });

  sourceRoot.traverse((sourceNode) => {
    const sourceName = String(sourceNode.name || "").trim();
    if (!sourceName) return;

    const targetNode = targetLookup.get(getVariantCounterpartName(sourceName).toLowerCase());
    if (!targetNode) return;

    syncObjectMaterialAndVisibility(sourceNode, targetNode);
  });
}

function updateToppingLayerVisibility() {
  if (!state.model) return;

  state.meshes.topping.sprinkles.forEach(mesh => {
    mesh.visible = state.layers.topping.sprinkles;
  });
}

function updateDripLayerVisibility() {
  if (!state.model) return;

  state.meshes.drip.goldDrip.forEach(mesh => {
    mesh.visible = state.layers.drip.goldDrip;
  });
  state.meshes.drip.swirlDrip.forEach(mesh => {
    mesh.visible = state.layers.drip.swirlDrip;
  });
}

function toggleBagOpenClose() {
  // Open/close removed — function kept as no-op placeholder in case called elsewhere.
  return;
}

function setMaterialColor(material, color, groupName) {
  if (!material) return;

  material.color.set(color);

  // Only apply metallic finish to hardware and drip
  if (groupName === "hardware" || groupName === "drip") {
    if ("metalness" in material) material.metalness = 0.9;
    if ("roughness" in material) material.roughness = 0.08;
  }

  if (material.map) {
    material.map = null;
  }

  material.needsUpdate = true;
}

function findMatchedMaterials(group) {
  const matched = [];
  const entries = Object.entries(state.materials);
  const groupMeshNames = Array.isArray(group.meshNames) ? group.meshNames : [];

  if (!entries.length || !groupMeshNames.length) {
    return matched;
  }

  const normalizedGroupMeshNames = groupMeshNames
    .map(meshName => String(meshName || "").toLowerCase())
    .filter(Boolean);

  entries.forEach(([name, material]) => {
    const meshName = getMeshNameFromMaterialName(name).toLowerCase();
    const isMatch = normalizedGroupMeshNames.some((groupMeshName) => {
      return meshName === groupMeshName || meshName.includes(groupMeshName) || groupMeshName.includes(meshName);
    });

    if (isMatch) {
      matched.push({ name, material });
    }
  });

  return matched;
}

// Customization functions removed - to be rewritten

function applyColorToMeshName(meshName, color, groupName) {
  Object.entries(state.materials).forEach(([name, material]) => {
    const resolvedMeshName = getMeshNameFromMaterialName(name);
    if (resolvedMeshName === meshName || resolvedMeshName === `${meshName}Open`) {
      setMaterialColor(material, color, groupName);
    }
  });
}

function handleDripSwatch(swatch, targetName) {
  // targetName should be either "Drip" (gold) or "Swirl" (swirl)
  if (!targetName) return;
  if (isDripNoneSwatch(swatch)) {
    state.layers.drip.goldDrip = false;
    state.layers.drip.swirlDrip = false;
    updateDripLayerVisibility();
    return;
  }

  // Apply color to the selected target and ensure the other is disabled (mutual exclusive)
  applyColorToMeshName(targetName, swatch.color, 'drip');
  if (targetName === "Drip") {
    state.layers.drip.goldDrip = true;
    state.layers.drip.swirlDrip = false;
  } else if (targetName === "Swirl") {
    state.layers.drip.swirlDrip = true;
    state.layers.drip.goldDrip = false;
  }

  updateDripLayerVisibility();
}

function applyColorForGroup(groupName, swatch, targets) {
  if (groupName === "drip") {
    // Deprecated: drip now handled via explicit target in the UI.
    return;
  }

  if (groupName === "topping") {
    targets.forEach(({ name, material }) => {
      const meshName = getMeshNameFromMaterialName(name);
      if (!allToppingMeshNames.includes(meshName)) {
        setMaterialColor(material, swatch.color, groupName);
      }
    });
    return;
  }

  targets.forEach(({ material }) => {
    setMaterialColor(material, swatch.color, groupName);
  });
}


// -----------------------------
// ACTIONS
// -----------------------------

// applySwatch and buildGroupUI removed - to be rewritten

function applySwatch(groupName, swatch, button) {
  const group = materialGroups[groupName];
  const targets = group.targets || [];

  if (groupName === "drip") {
    handleDripSwatch(swatch, state.dripActive || 'Drip');
  }

  if (groupName === "topping") {
    setToppingLayersFromSwatchName(swatch.name);
    updateToppingLayerVisibility();
  }

  applyColorForGroup(groupName, swatch, targets);
  // Remember the selected swatch for this group
  state.selectedSwatches[groupName] = swatch;

  document.querySelectorAll(".swatch-btn").forEach((element) => {
    element.classList.remove("is-active");
  });

  if (button) {
    button.classList.add("is-active");
  }
}

function buildGroupUI() {
  const groupsContainer = document.getElementById("groups");
  groupsContainer.innerHTML = "";

  Object.entries(materialGroups).forEach(([groupName, group]) => {
    const section = document.createElement("section");
    section.className = "group";

    const title = document.createElement("h2");
    title.className = "group-title";
    title.textContent = group.title;
    section.appendChild(title);

    if (group.subtitle) {
      const subtitle = document.createElement("p");
      subtitle.className = "group-subtitle";
      subtitle.textContent = group.subtitle;
      section.appendChild(subtitle);
    }

    const swatchList = document.createElement("div");
    swatchList.className = "swatch-list";

    if (groupName === 'drip') {
      // Toggle to choose which target is active (mutually exclusive)
      const toggleWrap = document.createElement('div');
      toggleWrap.className = 'drip-toggle';

      ['Drip', 'Swirl'].forEach((t) => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'drip-toggle-btn p-2';

        const chipEl = document.createElement('span');
        chipEl.className = 'swatch-chip';

        // allow custom images at assets/icons/drip.png and assets/icons/swirl.png
        const img = document.createElement('img');
        img.className = 'drip-img';
        img.alt = t === 'Drip' ? 'drip' : 'swirl';
        img.src = t === 'Drip' ? 'assets/icons/drip.png' : 'assets/icons/swirl.png';

        // fallback to inline SVG if custom image not found
        const iconSVG = t === 'Drip'
          ? `<svg viewBox="0 0 24 24" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 3c2.5 3.5 6 6 6 9a6 6 0 11-12 0c0-3 3.5-5.5 6-9z" fill="#333"/></svg>`
          : `<svg viewBox="0 0 24 24" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 8c4-4 8-4 12 0s-2 6-4 8-6 2-8 0 0-6 0-8z" stroke="#333" stroke-width="1.2" fill="none"/></svg>`;

        img.onerror = () => {
          chipEl.innerHTML = iconSVG;
        };

        chipEl.appendChild(img);

        const labelEl = document.createElement('span');
        labelEl.className = 'drip-label';
        labelEl.textContent = t === 'Drip' ? 'Drip' : 'Swirl';

        btn.appendChild(chipEl);
        btn.appendChild(labelEl);

        // set active class on chip only
        if (state.dripActive === t) chipEl.classList.add('is-active');

        chipEl.addEventListener('click', () => {
          state.dripActive = t;
          toggleWrap.querySelectorAll('.drip-toggle-btn .swatch-chip').forEach(b => b.classList.remove('is-active'));
          chipEl.classList.add('is-active');

          // Apply the currently selected drip swatch (if any) to this target
          const selected = state.selectedSwatches['drip'] || materialGroups['drip'].swatches.find(s => !s.toggleDripMesh) || null;
          if (selected) {
            handleDripSwatch(selected, t);
            // update swatch buttons' active state to the selected swatch
            document.querySelectorAll('#groups .group').forEach((g) => {
              if (!g.querySelector('.group-title') || g.querySelector('.group-title').textContent !== materialGroups['drip'].title) return;
              g.querySelectorAll('.swatch-btn').forEach((b) => b.classList.remove('is-active'));
              g.querySelectorAll('.swatch-btn').forEach((b) => {
                const lbl = b.querySelector('.swatch-label')?.textContent?.trim();
                if (lbl === selected.name) b.classList.add('is-active');
              });
            });
          }
        });

        toggleWrap.appendChild(btn);
      });

      section.appendChild(toggleWrap);

      // Single swatch list applies to the currently selected drip target
      group.swatches.forEach((swatch) => {
        if (swatch.toggleDripMesh) return; // skip the old toggle-entry
        const button = document.createElement('button');
        button.className = 'swatch-btn';
        button.type = 'button';

        const chip = document.createElement('span');
        chip.className = 'swatch-chip';
        chip.style.background = buildSwatchBackground(swatch);

        const label = document.createElement('span');
        label.className = 'swatch-label';
        label.textContent = swatch.name;

        button.appendChild(chip);
        button.appendChild(label);

        button.addEventListener('click', () => applySwatch(groupName, swatch, button));

        swatchList.appendChild(button);
      });
    } else {
      group.swatches.forEach((swatch) => {
        const button = document.createElement("button");
        button.className = "swatch-btn";
        button.type = "button";

        const chip = document.createElement("span");
        chip.className = "swatch-chip";
        chip.style.background = buildSwatchBackground(swatch);

        const label = document.createElement("span");
        label.className = "swatch-label";
        label.textContent = swatch.name;

        button.appendChild(chip);
        button.appendChild(label);

        button.addEventListener("click", () => applySwatch(groupName, swatch, button));

        swatchList.appendChild(button);
      });
    }

    section.appendChild(swatchList);
    groupsContainer.appendChild(section);
  });
}


// -----------------------------
// MODEL LOAD / UI WIRING
// -----------------------------

loader.load(

  HUIDIG_3D_MODEL,

  function (gltf) {

    state.model = gltf.scene;

    // SCALE

    state.model.scale.set(1, 1, 1);

    // POSITION

    state.model.position.set(0, -1, 0);

    // EXTRACT MATERIALS


    state.model.traverse((child) => {
      const childName = String(child.name || "").trim();
      const normalizedChildName = childName.toLowerCase();
      const isUnderOpenHierarchy = hasAncestorNamed(child, "Open");
      const isUnderClosedHierarchy = hasAncestorNamed(child, "Closed");

      if (normalizedChildName.includes("zipper")) {
        // Zipper meshes are handled explicitly below.
      }

      if (!child.isMesh) {
        if (normalizedChildName === "closed") {
          state.nodes.closedRoot = child;
        } else if (normalizedChildName === "zipper") {
          setVisibilityRecursive(child, true);
        }
      }

      if (child.isMesh) {
        const lowerChildName = childName.toLowerCase();

        if (Array.isArray(child.material)) {
          child.material.forEach((mat, idx) => {
            const matName = childName + " - Material " + idx;
            state.materials[matName] = mat;
          });
        } else if (child.material) {
          const matName = childName + " - Material";
          state.materials[matName] = child.material;
        }

        if (lowerChildName === "zipper") {
          state.meshes.zipper = state.meshes.zipper || {};
          state.meshes.zipper.closed = child;
          setVisibilityRecursive(child, true);
        }

        if (isUnderClosedHierarchy || !childName.includes("Material")) {
          state.meshes.closed.push(child);
        }

        if (lowerChildName === "zipper") {
          state.meshes.zipper = state.meshes.zipper || {};
          state.meshes.zipper.closed = child;
        }

        // Categorize topping meshes by explicit names (closed variants only)
        if (toppingMeshNames.sprinkles.includes(childName)) {
          state.meshes.topping.sprinkles.push(child);
        }

        // Categorize drip meshes by explicit names (closed variants only)
        if (dripMeshNames.goldDrip.includes(childName)) {
          state.meshes.drip.goldDrip.push(child);
        } else if (dripMeshNames.swirlDrip.includes(childName)) {
          state.meshes.drip.swirlDrip.push(child);
        }
      }
    });

    Object.entries(materialGroups).forEach(([groupName, group]) => {
      group.targets = findMatchedMaterials(group);
      group.defaultMaterialName = group.targets[0]?.name || null;
    });

    console.log("All available materials:", Object.keys(state.materials));

    buildGroupUI();

    const firstAvailableGroupName = Object.keys(materialGroups).find((groupName) => materialGroups[groupName].targets && materialGroups[groupName].targets.length);
    if (firstAvailableGroupName) {
      const firstSwatch = materialGroups[firstAvailableGroupName].swatches[0];
      const firstButton = document.querySelector(`.group .swatch-btn`);
      applySwatch(firstAvailableGroupName, firstSwatch, firstButton);
    }

    // Apply hardware default (Silver)
    const hardwareSwatch = materialGroups['hardware'].swatches.find(s => s.name === 'Silver');
    if (hardwareSwatch) {
      const hardwareGroup = Array.from(document.querySelectorAll('.group')).find(g => {
        const title = g.querySelector('.group-title');
        return title && title.textContent === 'Hardware';
      });
      if (hardwareGroup) {
        const hardwareButton = hardwareGroup.querySelector('.swatch-btn');
        if (hardwareButton) {
          applySwatch('hardware', hardwareSwatch, hardwareButton);
        }
      }
    }

    // Initialize layers
    updateToppingLayerVisibility();
    updateDripLayerVisibility();

    scene.add(state.model);

    document.getElementById("loading").style.display = "none";
  },

  undefined,

  function (error) {

    console.error(error);

    alert("Failed to load GLB model.");

  }

);

const rotateBtn =
  document.getElementById("rotateBtn");

rotateBtn.addEventListener("click", () => {

  state.autoRotate = !state.autoRotate;

});

// Open/close UI removed: toggle button listener deleted.
window.addEventListener("resize", () => {

  const viewerWidth = viewerElement.clientWidth;
  const viewerHeight = viewerElement.clientHeight;

  camera.aspect = viewerWidth / viewerHeight;

  camera.updateProjectionMatrix();

  renderer.setSize(
    viewerWidth,
    viewerHeight
  );

});

//////////////////////////////////////////////////////
// ANIMATION LOOP
//////////////////////////////////////////////////////

function animate() {

  requestAnimationFrame(animate);

  controls.update();

  if (state.model && state.autoRotate) {

    state.model.rotation.y += 0.01;

  }

  renderer.render(scene, camera);

}

animate();
