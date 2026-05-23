export const toppingMeshNames = {
  sprinkles: ["Sprinkles", "Sprinkles1", "Sprinkles2", "Sprinkles3"]
};

export const dripMeshNames = {
  goldDrip: ["Drip"],
  swirlDrip: ["Swirl"]
};

export const materialGroups = {
  flavors: {
    title: "Flavours",
    subtitle: "(Base color)",
    meshNames: ["Body"],
    swatches: [
      { name: "Vanilla", color: "#f0e6d2" },
      { name: "Mint", color: "#bbdfc0" },
      { name: "Pistache", color: "#c6d92d" },
      { name: "Lemon", color: "#fec91c" },
      { name: "Mango", color: "#e07e26" },
      { name: "Bubblegum", color: "#f166a7" },
      { name: "Raspberry", color: "#ad266d" },
      { name: "Blackberry", color: "#761b7b" },
      { name: "Cherry", color: "#7b1012" },
      { name: "Chocolate", color: "#744c27" }
    ]
  },
  drip: {
    title: "Drip or Swirl",
    subtitle: "",
    meshNames: ["Drip", "Plane005", "Swirl"],
    swatches: [
      { name: "None", color: "#ffffff" },
      { name: "Switch Target", color: "#ffffff", toggleDripMesh: true },
      { name: "Silver", color: "#97a3a1" },
      { name: "Gold Caramel", color: "#d4a054", accent: true },
      { name: "Rose gold", color: "#d9aebb" },
      { name: "Dark chocolate", color: "#652901" }
    ]
  },
  topping: {
    title: "Topping",
    subtitle: "",
    meshNames: ["Cylinder", "Cylinder_1"],
    swatches: [
      { name: "None", color: "#ffffff" },
      { name: "Discodip/Sprinkels", color: "#ff6b35", accent: true }
    ]
  },
  hardware: {
    title: "Hardware",
    subtitle: "(Zipper, Chain, Logo, Teeth, Pull)",
    meshNames: ["Chain", "Holder", "Slider", "Pull", "Teeth"],
    swatches: [
      { name: "Silver", color: "#859390" },
      { name: "Gold", color: "#cd9a52" }
    ]
  }
};
