<?php
// Database instellingen (dezelfde als in upload.php)
$host = 'localhost';
$db = 'grytsje suze';
$user = 'bit_academy';
$pass = 'bit_academy';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database verbinding mislukt: " . $e->getMessage());
}

// Haal alle tassen op uit de database, nieuwste eerst
$sql = "SELECT * FROM tassen ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$tassen = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Tassen</title>
    <link href="../public/css/output.css" rel="stylesheet">
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
            <!-- Pas de href aan naar jouw formulier pagina -->
            <a href="addproduct.php"
                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-3 sm:px-4 rounded shadow-sm transition duration-150 ease-in-out flex items-center text-sm sm:text-base whitespace-nowrap">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="hidden sm:inline">Nieuwe Tas Toevoegen</span>
                <span class="sm:hidden">Toevoegen</span>
            </a>
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

                        <?php if (count($tassen) > 0): ?>
                            <?php foreach ($tassen as $tas): ?>
                                <tr class="hover:bg-gray-50 border-b border-gray-200 transition duration-150">
                                    <!-- Afbeelding -->
                                    <!-- We gebruiken htmlspecialchars() om XSS-aanvallen te voorkomen -->
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap w-20 sm:w-auto align-top sm:align-middle">
                                        <img class="h-16 w-16 sm:h-12 sm:w-12 rounded object-cover border border-gray-300"
                                            src="<?= htmlspecialchars($tas['afbeelding']) ?>"
                                            alt="<?= htmlspecialchars($tas['naam']) ?>">
                                    </td>

                                    <!-- Mobiele Details -->
                                    <td class="sm:hidden px-4 py-4 align-top">
                                        <div class="font-bold text-gray-900 mb-1 text-base">
                                            <?= htmlspecialchars($tas['naam']) ?>
                                        </div>
                                        <div class="text-sm text-gray-600 mb-3">
                                            <?= nl2br(htmlspecialchars($tas['beschrijving'])) ?>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="edit.php?id=<?= $tas['id'] ?>"
                                                class="bg-blue-500 hover:bg-blue-600 text-white py-1.5 px-3 rounded text-xs transition duration-150">Bewerk</a>
                                            <!-- Delete actie met een kleine javascript confirm als extra veiligheid -->
                                            <a href="delete.php?id=<?= $tas['id'] ?>"
                                                onclick="return confirm('Weet je zeker dat je deze tas wilt verwijderen?');"
                                                class="bg-red-500 hover:bg-red-600 text-white py-1.5 px-3 rounded text-xs transition duration-150">Verwijder</a>
                                        </div>
                                    </td>

                                    <!-- Desktop Details -->
                                    <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                        <?= htmlspecialchars($tas['naam']) ?>
                                    </td>
                                    <td class="hidden sm:table-cell px-6 py-4 text-sm text-gray-600">
                                        <!-- nl2br zorgt ervoor dat enters in de textarea ook in de tabel als enters getoond worden -->
                                        <?= nl2br(htmlspecialchars($tas['beschrijving'])) ?>
                                    </td>
                                    <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex justify-center gap-3">
                                            <a href="edit.php?id=<?= $tas['id'] ?>"
                                                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded text-sm font-medium transition duration-150">Bewerk</a>
                                            <a href="delete.php?id=<?= $tas['id'] ?>"
                                                onclick="return confirm('Weet je zeker dat je deze tas wilt verwijderen?');"
                                                class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded text-sm font-medium transition duration-150">Verwijder</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Melding als de database leeg is -->
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    Er zijn nog geen tassen toegevoegd. Klik op "Nieuwe Tas Toevoegen" om te beginnen.
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

            <!-- Paginering (Momenteel statisch, kan later dynamisch gemaakt worden indien nodig) -->
            <div
                class="px-4 sm:px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                <span class="text-xs sm:text-sm text-gray-600 text-center sm:text-left">Totaal: <?= count($tassen) ?>
                    tassen</span>
            </div>
        </div>
    </div>

</body>

</html>