<?php include 'auth.php'; ?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe Tas Toevoegen</title>
    <link rel="stylesheet" href="../public/css/output.css">
</head>

<body class="bg-gray-100 font-sans pb-20">

    <nav class="bg-gray-900 h-16 flex items-center shadow-lg px-6 mb-10">
        <span class="text-white font-bold uppercase tracking-widest">Admin<span
                class="text-blue-500">Panel</span></span>
    </nav>

    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-white shadow-xl rounded-2xl p-8">
            <h2 class="text-2xl font-black text-gray-800 mb-8 border-b pb-4">Nieuwe Tas Toevoegen</h2>

            <form action="upload.php" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-2 gap-10">

                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Naam</label>
                        <input type="text" name="naam" placeholder="Naam van de tas" required
                            class="w-full border-2 border-gray-100 rounded-xl p-3 focus:border-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Beschrijving</label>
                        <textarea name="beschrijving" rows="6" placeholder="Vertel iets over deze tas..." required
                            class="w-full border-2 border-gray-100 rounded-xl p-3 focus:border-blue-500 outline-none transition"></textarea>
                    </div>

                    <div class="bg-blue-50 p-6 rounded-2xl border-2 border-blue-100">
                        <label class="block text-xs font-bold text-blue-400 uppercase mb-3">Kleur van de tas</label>
                        <div class="flex items-center gap-4">
                            <input type="color" name="kleurcode" id="kleurcode" value="#3b82f6"
                                class="h-12 w-12 cursor-pointer border-none bg-transparent">

                            <button type="button" id="pipet-btn"
                                class="flex-1 bg-white border-2 border-blue-200 hover:border-blue-500 py-3 px-4 rounded-xl flex items-center justify-center gap-3 transition shadow-sm font-bold text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-3">
                                    </path>
                                </svg>
                                Kleur uit foto prikken
                            </button>
                        </div>
                        <p id="instruction-text" class="mt-3 text-[11px] text-blue-400 font-medium leading-tight">
                            Gebruik de pipet of selecteer eerst een afbeelding om daar een kleur uit te kiezen.</p>
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-3 self-start">Productfoto
                        Preview</label>
                    <div class="relative w-full aspect-square max-w-[400px]">
                        <img id="preview-img" src="https://via.placeholder.com/800?text=Selecteer+Afbeelding"
                            class="w-full h-full object-cover rounded-3xl border-8 border-white shadow-2xl transition-all duration-300 bg-gray-200">
                    </div>
                    <div class="mt-6 w-full">
                        <input type="file" name="afbeelding" id="file-input" accept="image/*" required
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-gray-800 file:text-white hover:file:bg-black transition cursor-pointer">
                    </div>
                </div>

                <div class="md:col-span-2 flex justify-between items-center pt-8 border-t mt-4">
                    <a href="index.php"
                        class="text-gray-400 hover:text-gray-600 font-bold text-sm tracking-widest uppercase transition">Annuleren</a>
                    <button type="submit" name="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-black py-4 px-12 rounded-2xl shadow-lg transform hover:-translate-y-1 transition-all uppercase tracking-widest">
                        Product Toevoegen
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pipetBtn = document.getElementById('pipet-btn');
            const kleurInput = document.getElementById('kleurcode');
            const previewImg = document.getElementById('preview-img');
            const fileInput = document.getElementById('file-input');
            const instruction = document.getElementById('instruction-text');

            function updateColor(hex) {
                kleurInput.value = hex;
            }

            // EyeDropper (Chrome/Edge/Opera)
            if ('EyeDropper' in window) {
                const eyeDropper = new EyeDropper();
                pipetBtn.addEventListener('click', () => {
                    eyeDropper.open().then(result => updateColor(result.sRGBHex));
                });
            }
            // Fallback (Firefox & iOS Safari)
            else {
                pipetBtn.textContent = "Tik op foto voor kleur";
                pipetBtn.classList.replace('text-blue-600', 'text-orange-600');
                instruction.textContent = "Klik/Tik op de geüploade foto om de exacte kleur te kiezen.";

                const getColor = (e) => {
                    if (previewImg.src.includes('placeholder')) return;

                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    canvas.width = previewImg.naturalWidth;
                    canvas.height = previewImg.naturalHeight;
                    ctx.drawImage(previewImg, 0, 0, canvas.width, canvas.height);

                    const rect = previewImg.getBoundingClientRect();
                    const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                    const clientY = e.touches ? e.touches[0].clientY : e.clientY;

                    const x = (clientX - rect.left) * (canvas.width / rect.width);
                    const y = (clientY - rect.top) * (canvas.height / rect.height);

                    const pixel = ctx.getImageData(x, y, 1, 1).data;
                    const hex = "#" + ((1 << 24) + (pixel[0] << 16) + (pixel[1] << 8) + pixel[2]).toString(16).slice(1);
                    updateColor(hex);
                };

                previewImg.addEventListener('click', getColor);
                previewImg.addEventListener('touchstart', getColor, { passive: true });
                previewImg.style.cursor = 'crosshair';
            }

            // Preview update
            fileInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (ev) => { previewImg.src = ev.target.result; };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</body>


</html>