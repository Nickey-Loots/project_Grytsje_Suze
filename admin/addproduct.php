<?php include 'auth.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/output.css">
    <title>Document</title>
</head>

<body>

    <nav class="bg-gray-900 border-b border-gray-800 shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center gap-2">
                <div class="bg-blue-600 p-1.5 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <span class="text-white text-lg font-bold tracking-wider uppercase">Admin<span class="text-blue-500">Panel</span></span>
            </div>

            <div class="flex items-center space-x-4">
                <a href="index.php" class="text-gray-300 hover:text-white hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-medium transition duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Tassen
                </a>

                <a href="gebruikers.php" class="text-gray-300 hover:text-white hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-medium transition duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Admins
                </a>

                <div class="h-6 w-px bg-gray-700 mx-2"></div>

                <a href="logout.php" class="text-red-400 hover:text-red-300 hover:bg-red-900/20 px-3 py-2 rounded-md text-sm font-medium transition duration-200">
                    Uitloggen
                </a>
            </div>
        </div>
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