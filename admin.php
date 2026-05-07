<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Tassen</title>
    <link href="./public/css/output.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navigatie / Header -->
    <nav class="bg-gray-800 p-4 shadow-md">
        <div class="container mx-auto">
            <span class="text-white text-xl font-semibold">Admin Panel</span>
        </div>
    </nav>

    <!-- Hoofdcontainer -->
    <div class="container mx-auto mt-6 md:mt-10 px-4 max-w-6xl">

        <!-- Paginakop en Toevoeg Knop -->
        <div class="flex flex-row justify-between items-center mb-6 gap-4">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Tassen Beheer</h1>
            <!-- Add button is nu geen 'w-full' meer op mobiel -->
            <button
                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-3 sm:px-4 rounded shadow-sm transition duration-150 ease-in-out flex items-center text-sm sm:text-base whitespace-nowrap">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="hidden sm:inline">Nieuwe Tas Toevoegen</span>
                <span class="sm:hidden">Toevoegen</span>
            </button>
        </div>

        <!-- Tabel Container -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <!-- Desktop Headers -->
                        <tr
                            class="bg-gray-50 text-gray-600 text-left text-sm uppercase tracking-wider hidden sm:table-row">
                            <th class="px-6 py-3 border-b-2 border-gray-200 font-semibold">Afbeelding</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 font-semibold">Naam</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 font-semibold">Beschrijving</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 font-semibold text-center">Acties</th>
                        </tr>
                        <!-- Mobiele Headers -->
                        <tr class="bg-gray-50 text-gray-600 text-left text-xs uppercase tracking-wider sm:hidden">
                            <th class="px-4 py-3 border-b-2 border-gray-200 font-semibold">Afbeelding</th>
                            <th class="px-4 py-3 border-b-2 border-gray-200 font-semibold">Details & Acties</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">

                        <!-- Rij 1 -->
                        <tr class="hover:bg-gray-50 border-b border-gray-200 transition duration-150">
                            <!-- Afbeelding (Altijd zichtbaar) -->
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap w-20 sm:w-auto align-top sm:align-middle">
                                <img class="h-16 w-16 sm:h-12 sm:w-12 rounded object-cover border border-gray-300"
                                    src="https://via.placeholder.com/150/000000/FFFFFF/?text=Tas+1" alt="Leren Rugzak">
                            </td>

                            <!-- Mobiele Details (Alleen op mobiel) -->
                            <td class="sm:hidden px-4 py-4 align-top">
                                <div class="font-bold text-gray-900 mb-1 text-base">Leren Rugzak</div>
                                <div class="text-sm text-gray-600 mb-3">Een stijlvolle en duurzame leren rugzak, perfect
                                    voor dagelijks gebruik en werk.</div>
                                <div class="flex gap-2">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white py-1.5 px-3 rounded text-xs transition duration-150">Bewerk</button>
                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white py-1.5 px-3 rounded text-xs transition duration-150">Verwijder</button>
                                </div>
                            </td>

                            <!-- Desktop Details (Alleen op grotere schermen) -->
                            <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap font-medium text-gray-900">Leren
                                Rugzak</td>
                            <td class="hidden sm:table-cell px-6 py-4 text-sm text-gray-600">Een stijlvolle en duurzame
                                leren rugzak, perfect voor dagelijks gebruik en werk.</td>
                            <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center gap-2">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-xs transition duration-150">Bewerk</button>
                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-xs transition duration-150">Verwijder</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Rij 2 -->
                        <tr class="hover:bg-gray-50 border-b border-gray-200 transition duration-150">
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap w-20 sm:w-auto align-top sm:align-middle">
                                <img class="h-16 w-16 sm:h-12 sm:w-12 rounded object-cover border border-gray-300"
                                    src="https://via.placeholder.com/150/333333/FFFFFF/?text=Tas+2"
                                    alt="Linnen Shopper">
                            </td>

                            <!-- Mobiele Details -->
                            <td class="sm:hidden px-4 py-4 align-top">
                                <div class="font-bold text-gray-900 mb-1 text-base">Linnen Shopper</div>
                                <div class="text-sm text-gray-600 mb-3">Grote, lichte shopper gemaakt van biologisch
                                    linnen. Ideaal voor de boodschappen.</div>
                                <div class="flex gap-2">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white py-1.5 px-3 rounded text-xs transition duration-150">Bewerk</button>
                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white py-1.5 px-3 rounded text-xs transition duration-150">Verwijder</button>
                                </div>
                            </td>

                            <!-- Desktop Details -->
                            <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                Linnen Shopper</td>
                            <td class="hidden sm:table-cell px-6 py-4 text-sm text-gray-600">Grote, lichte shopper
                                gemaakt van biologisch linnen. Ideaal voor de boodschappen.</td>
                            <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center gap-2">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-xs transition duration-150">Bewerk</button>
                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-xs transition duration-150">Verwijder</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Rij 3 -->
                        <tr class="hover:bg-gray-50 border-b border-gray-200 transition duration-150">
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap w-20 sm:w-auto align-top sm:align-middle">
                                <img class="h-16 w-16 sm:h-12 sm:w-12 rounded object-cover border border-gray-300"
                                    src="https://via.placeholder.com/150/666666/FFFFFF/?text=Tas+3" alt="Laptoptas">
                            </td>

                            <!-- Mobiele Details -->
                            <td class="sm:hidden px-4 py-4 align-top">
                                <div class="font-bold text-gray-900 mb-1 text-base">Zakelijke Laptoptas</div>
                                <div class="text-sm text-gray-600 mb-3">Waterafstotende laptoptas met extra vakken voor
                                    accessoires en documenten.</div>
                                <div class="flex gap-2">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white py-1.5 px-3 rounded text-xs transition duration-150">Bewerk</button>
                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white py-1.5 px-3 rounded text-xs transition duration-150">Verwijder</button>
                                </div>
                            </td>

                            <!-- Desktop Details -->
                            <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                Zakelijke Laptoptas</td>
                            <td class="hidden sm:table-cell px-6 py-4 text-sm text-gray-600">Waterafstotende laptoptas
                                met extra vakken voor accessoires en documenten.</td>
                            <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center gap-2">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-xs transition duration-150">Bewerk</button>
                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-xs transition duration-150">Verwijder</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Paginering -->
            <div
                class="px-4 sm:px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                <span class="text-xs sm:text-sm text-gray-600 text-center sm:text-left">Toont 1 tot 3 van 24
                    tassen</span>
                <div class="inline-flex justify-center">
                    <button
                        class="text-xs sm:text-sm text-gray-600 bg-white border border-gray-300 hover:bg-gray-100 font-semibold py-2 px-4 rounded-l">
                        Vorige
                    </button>
                    <button
                        class="text-xs sm:text-sm text-gray-600 bg-white border-y border-r border-gray-300 hover:bg-gray-100 font-semibold py-2 px-4 rounded-r">
                        Volgende
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>