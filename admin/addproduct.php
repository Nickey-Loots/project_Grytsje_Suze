<?php include 'auth.php'; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe Tas Toevoegen</title>
    <link rel="stylesheet" href="../public/css/output.css">
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-gray-900 border-b border-gray-800 shadow-lg">
        <div class="container mx-auto px-4 flex items-center justify-between h-16">
            <span class="text-white text-lg font-bold tracking-wider uppercase">Admin<span class="text-blue-500">Panel</span></span>
            <a href="index.php" class="text-gray-300 hover:text-white text-sm font-medium">Terug naar overzicht</a>
        </div>
    </nav>

    <div class="container mx-auto mt-10 px-4 max-w-2xl">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Nieuwe Tas Toevoegen</h2>
            
            <form action="upload.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Naam</label>
                    <input type="text" name="naam" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Beschrijving</label>
                    <textarea name="beschrijving" rows="4" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500"></textarea>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Hoofdkleur</label>
                    <div class="flex items-center gap-4">
                        <input type="color" name="kleurcode" id="kleurcode" value="#3b82f6" class="h-10 w-20 cursor-pointer rounded border border-gray-300 bg-white p-1">
                        <span id="color-hex" class="text-sm font-mono font-bold text-gray-600 uppercase">#3B82F6</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Afbeelding</label>
                    <div class="mt-2 flex items-center gap-6">
                        <div class="relative">
                            <img id="preview-img" src="https://via.placeholder.com/150?text=Preview" class="h-32 w-32 object-cover rounded-lg border-2 border-gray-300 shadow-sm">
                        </div>
                        <input type="file" name="afbeelding" id="file-input" accept="image/*" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-50 file:text-blue-700">
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="index.php" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded transition">Annuleren</a>
                    <button type="submit" name="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded shadow-sm transition">Opslaan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Color Hex update
        document.getElementById('kleurcode').addEventListener('input', (e) => {
            document.getElementById('color-hex').textContent = e.target.value.toUpperCase();
        });

        // Image Preview
        document.getElementById('file-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => { document.getElementById('preview-img').src = event.target.result; };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>