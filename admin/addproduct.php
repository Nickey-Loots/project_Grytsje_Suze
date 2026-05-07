<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/output.css">
    <title>Document</title>
</head>

<body>

    <nav class="bg-gray-800 p-4 shadow-md">
        <div class="container mx-auto">
            <span class="text-white text-xl font-semibold">Admin Panel</span>
        </div>
    </nav>

    <div class="container mx-auto mt-10 px-4 max-w-2xl">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Nieuwe Tas Toevoegen</h2>

            <form action="upload.php" method="POST" enctype="multipart/form-data" class="space-y-4">

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Naam van de tas</label>
                    <input type="text" name="naam" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Beschrijving</label>
                    <textarea name="beschrijving" rows="4" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Afbeelding selecteren</label>
                    <div class="mt-1 flex items-center">
                        <input type="file" name="afbeelding" accept="image/*" required
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Alleen .jpg, .png of .webp bestanden.</p>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <a href="index.php"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded transition">
                        Annuleren
                    </a>
                    <button type="submit" name="submit"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded shadow-sm transition">
                        Tas Opslaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>