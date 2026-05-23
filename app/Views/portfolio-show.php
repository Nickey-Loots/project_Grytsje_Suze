<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($tas['naam']) ?> - Customizer</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="/css/output.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/BagEdit/styles.css">

    <script type="importmap">
    {
      "imports": {
        "three": "https://cdn.jsdelivr.net/npm/three@0.165.0/build/three.module.js",
        "three/addons/controls/OrbitControls.js": "https://cdn.jsdelivr.net/npm/three@0.165.0/examples/jsm/controls/OrbitControls.js",
        "three/addons/loaders/GLTFLoader.js": "https://cdn.jsdelivr.net/npm/three@0.165.0/examples/jsm/loaders/GLTFLoader.js"
      }
    }
    </script>

    <style>
        body.customizer-page {
            --customizer-bg: <?= $bgColor ?>;
            --customizer-text: <?= $isDark ? '#fff' : '#1c1c1c' ?>;
            --customizer-overlay-rgb: <?= $overlayRgb ?>;
        }
    </style>
</head>

<body class="min-h-screen! flex! flex-col! text-white! customizer-page">

    <?php require ROOT_PATH . '/app/Views/layouts/header.php'; ?>

    <main class="flex-1 w-full max-w-400 mx-auto px-4 md:px-8 py-6">

        <div class="mb-6">
            <a href="/portfolio" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest
                      transition mb-4 no-underline px-4 py-2 rounded"
                style="background-color: <?= $bgColor ?>; color: <?= $isDark ? '#fff' : '#1c1c1c' ?>;">
                <i class="fa fa-arrow-left"></i> Back to Work
            </a>
            <h2 class="text-4xl md:text-6xl font-bold uppercase mb-2 leading-none text-black"
                style="font-family: 'Bebas Neue', sans-serif;">
                <?= htmlspecialchars($tas['naam']) ?>
            </h2>
            <p class="text-base md:text-lg opacity-70 max-w-3xl leading-relaxed text-black">
                <?= nl2br(htmlspecialchars($tas['beschrijving'])) ?>
            </p>
        </div>

        <!-- Customizer -->
        <div id="customizer-wrapper" class="pl-4 md:pl-8">
            <div id="app">
                <div id="viewer">
                    <div id="loading">Loading 3D Model...</div>
                </div>
                <aside id="palette" class="overflow-hidden! flex! flex-col! p-5! pl-8!">
                    <header class="flex flex-col gap-1 mb-4">
                        <h1 class="text-[32px]! m-0!">Flavours & Options</h1>
                        <p class="text-[15px]! leading-snug opacity-80 max-w-sm m-0!">
                            Pas de materialen en kleuren van de tas live aan via de onderstaande opties.
                        </p>
                    </header>
                    <div class="group-grid overflow-y-auto! flex-1! pr-1.5" id="groups"></div>
                    <div class="toolbar shrink-0! mt-3! pt-3! border-t!">
                        <div class="button-row">
                            <button class="action-btn color-[currentColor]!" id="rotateBtn">Toggle Auto Rotate</button>
                        </div>
                    </div>
                </aside>
            </div>
        </div>

        <!-- Galerij -->
        <?php if (!empty($galerij)): ?>
            <div class="mt-12 border-t border-gray-800 pt-8">
                <h3 class="text-2xl font-bold uppercase mb-4" style="font-family: 'Bebas Neue', sans-serif;">Product Details</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <?php foreach ($galerij as $img): ?>
                        <div class="aspect-square bg-neutral-900 overflow-hidden rounded-lg border border-gray-800">
                            <img src="/<?= htmlspecialchars($img) ?>" class="w-full h-full object-cover">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <?php require ROOT_PATH . '/app/Views/layouts/footer.php'; ?>

    <script>
        const HUIDIG_3D_MODEL = "/<?= htmlspecialchars($tas['model_3d'] ?? '') ?>";
    </script>
    <script src="/BagEdit/app.js" type="module"></script>

</body>

</html>
