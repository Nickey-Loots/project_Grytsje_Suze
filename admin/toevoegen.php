<?php include 'auth.php'; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe Tas Toevoegen</title>
    <link rel="stylesheet" href="../public/css/output.css">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>
    <style>
        model-viewer { width: 100%; height: 300px; background-color: #f9fafb; border-radius: 1rem; }
        .drag-area { border: 2px dashed #d8b4fe; transition: all 0.2s ease; }
        .drag-area:hover { border-color: #a855f7; background-color: #f5f3ff; }
    </style>
</head>
<body class="bg-gray-100 font-sans pb-20">

    <nav class="bg-gray-900 h-16 flex items-center shadow-lg px-6 mb-10">
        <span class="text-white font-bold uppercase tracking-widest">Admin<span class="text-blue-500">Panel</span></span>
    </nav>

    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-white shadow-xl rounded-2xl p-8">
            <h2 class="text-2xl font-black text-gray-800 mb-8 border-b pb-4">Nieuwe Tas Toevoegen</h2>
            
            <form action="upload.php" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Naam</label>
                        <input type="text" name="naam" required class="w-full border-2 border-gray-100 rounded-xl p-3 focus:border-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Beschrijving</label>
                        <textarea name="beschrijving" rows="4" required class="w-full border-2 border-gray-100 rounded-xl p-3 focus:border-blue-500 outline-none transition"></textarea>
                    </div>

                    <div class="bg-purple-50 p-6 rounded-2xl drag-area cursor-pointer relative" onclick="document.getElementById('model-input').click();">
                        <label class="block text-xs font-bold text-purple-400 uppercase mb-3">3D Model (.glb)</label>
                        
                        <div id="model-placeholder" class="text-center py-10">
                            <svg class="w-12 h-12 text-purple-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                            <p class="text-purple-400 text-sm font-bold">Klik hier om een 3D model te uploaden</p>
                        </div>

                        <div id="model-preview-container" class="hidden">
                            <model-viewer id="model-preview" auto-rotate camera-controls shadow-intensity="1"></model-viewer>
                            <p class="text-[10px] text-purple-400 mt-2 text-center">Tik/Klik opnieuw om het bestand te wijzigen</p>
                        </div>
                        
                        <input type="file" name="model_3d" id="model-input" accept=".glb" class="hidden">
                    </div>
                    
                    <div class="bg-blue-50 p-6 rounded-2xl border-2 border-blue-100">
                        <label class="block text-xs font-bold text-blue-400 uppercase mb-3">Kleur van de tas</label>
                        <div class="flex items-center gap-4">
                            <input type="color" name="kleurcode" id="kleurcode" value="#3b82f6" class="h-12 w-12 cursor-pointer border-none bg-transparent">
                            <button type="button" id="pipet-btn" class="flex-1 bg-white border-2 border-blue-200 py-3 rounded-xl font-bold text-blue-600">Pipet / Tik op foto</button>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-3 self-start">Productfoto</label>
                    <div class="relative w-full aspect-square max-w-[400px]">
                        <img id="preview-img" src="https://via.placeholder.com/800?text=Klik+hier+voor+foto" 
                             class="w-full h-full object-cover rounded-3xl border-8 border-white shadow-2xl bg-gray-200 cursor-pointer"
                             onclick="document.getElementById('file-input').click();">
                    </div>
                    <input type="file" name="afbeelding" id="file-input" accept="image/*" required class="hidden">
                    <button type="button" onclick="document.getElementById('file-input').click();" class="mt-4 text-xs font-bold text-blue-600 uppercase tracking-widest">Wijzig Foto</button>
                </div>

                <div class="md:col-span-2 flex justify-between items-center pt-8 border-t">
                    <a href="index.php" class="text-gray-400 font-bold text-sm uppercase">Annuleren</a>
                    <button type="submit" name="submit" class="bg-blue-600 text-white font-black py-4 px-12 rounded-2xl shadow-lg uppercase tracking-widest">Opslaan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // 3D Preview Logica
        document.getElementById('model-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('model-preview').src = URL.createObjectURL(file);
                document.getElementById('model-placeholder').classList.add('hidden');
                document.getElementById('model-preview-container').classList.remove('hidden');
            }
        });

        // Foto Preview & Pipet (Universele code)
        const pipetBtn = document.getElementById('pipet-btn');
        const kleurInput = document.getElementById('kleurcode');
        const previewImg = document.getElementById('preview-img');

        document.getElementById('file-input').addEventListener('change', function(e) {
            const reader = new FileReader();
            reader.onload = (ev) => { previewImg.src = ev.target.result; };
            reader.readAsDataURL(e.target.files[0]);
        });

        if ('EyeDropper' in window) {
            const ed = new EyeDropper();
            pipetBtn.addEventListener('click', () => {
                ed.open().then(result => { kleurInput.value = result.sRGBHex; });
            });
        } else {
            const getColor = (e) => {
                if (previewImg.src.includes('placeholder')) return;
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = previewImg.naturalWidth;
                canvas.height = previewImg.naturalHeight;
                ctx.drawImage(previewImg, 0, 0, canvas.width, canvas.height);
                const rect = previewImg.getBoundingClientRect();
                const x = ((e.touches ? e.touches[0].clientX : e.clientX) - rect.left) * (canvas.width / rect.width);
                const y = ((e.touches ? e.touches[0].clientY : e.clientY) - rect.top) * (canvas.height / rect.height);
                const p = ctx.getImageData(x, y, 1, 1).data;
                kleurInput.value = "#" + ((1 << 24) + (p[0] << 16) + (p[1] << 8) + p[2]).toString(16).slice(1);
            };
            previewImg.addEventListener('click', getColor);
            previewImg.addEventListener('touchstart', getColor, {passive: true});
        }
    </script>
</body>
</html>