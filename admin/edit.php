<?php
// 1. Database verbinding
$host = 'localhost';
$db = 'grytsje suze';
$user = 'bit_academy';
$pass = 'bit_academy';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database verbinding mislukt: " . $e->getMessage());
}

// 2. Haal de huidige gegevens van de tas op
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM tassen WHERE id = :id");
$stmt->execute([':id' => $id]);
$tas = $stmt->fetch();

if (!$tas) {
    die("Tas niet gevonden.");
}

// 3. Verwerk het formulier als er gepost wordt
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $beschrijving = $_POST['beschrijving'];
    $afbeeldingPad = $tas['afbeelding']; // Standaard behouden we de oude afbeelding

    // Check of er een nieuwe afbeelding is geüpload
    if (isset($_FILES['afbeelding']) && $_FILES['afbeelding']['error'] === UPLOAD_ERR_OK) {
        $bestandsnaam = $_FILES['afbeelding']['name'];
        $tijdelijke_locatie = $_FILES['afbeelding']['tmp_name'];
        $doel_map = "../uploads/";
        $unieke_naam = time() . '_' . basename($bestandsnaam);
        $volledige_pad = $doel_map . $unieke_naam;

        if (move_uploaded_file($tijdelijke_locatie, $volledige_pad)) {
            // Verwijder de oude afbeelding van de server als die bestaat
            if (file_exists("../" . $tas['afbeelding'])) {
                unlink("../" . $tas['afbeelding']);
            }
            $afbeeldingPad = "uploads/" . $unieke_naam;
        }
    }

    // Update de database
    $updateSql = "UPDATE tassen SET naam = :naam, beschrijving = :beschrijving, afbeelding = :afbeelding WHERE id = :id";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->execute([
        ':naam' => $naam,
        ':beschrijving' => $beschrijving,
        ':afbeelding' => $afbeeldingPad,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tas Bewerken</title>
    <link rel="stylesheet" href="../public/css/output.css">
</head>

<body class="bg-gray-100 font-sans">

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
            <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">Tas Aanpassen</h2>

            <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Naam</label>
                    <input type="text" name="naam" value="<?= htmlspecialchars($tas['naam']) ?>" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Beschrijving</label>
                    <textarea name="beschrijving" rows="4" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500"><?= htmlspecialchars($tas['beschrijving']) ?></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Huidige Afbeelding</label>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Afbeelding</label>

                        <div class="mt-2 flex items-center gap-6">
                            <!-- De afbeelding container -->
                            <div class="relative">
                                <img id="preview-img" src="../<?= htmlspecialchars($tas['afbeelding']) ?>"
                                    class="h-32 w-32 object-cover rounded-lg border-2 border-gray-300 shadow-sm">
                                <span id="preview-label"
                                    class="absolute -top-2 -left-2 bg-blue-600 text-white text-[10px] px-2 py-0.5 rounded-full uppercase font-bold">
                                    Huidig
                                </span>
                            </div>
                        </div>
                    </div>

                    <label class="block text-sm font-semibold text-gray-700 mt-4">Nieuwe Afbeelding (optioneel)</label>
                    <input id="file-input" type="file" name="afbeelding" accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-50 file:text-blue-700">
                </div>

                <div class="flex justify-between items-center pt-6">
                    <a href="index.php" class="text-gray-600 hover:underline text-sm font-semibold">Terug naar
                        overzicht</a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition">
                        Wijzigingen Opslaan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Wacht tot de pagina geladen is
        document.addEventListener('DOMContentLoaded', function () {
            const fileInput = document.getElementById('file-input');
            const preview = document.getElementById('preview-img');
            const label = document.getElementById('preview-label');

            // Alleen uitvoeren als het element echt bestaat
            if (fileInput) {
                fileInput.addEventListener('change', function (event) {
                    const file = event.target.files[0];

                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            preview.src = e.target.result;

                            if (label) {
                                label.textContent = "Nieuw";
                                label.classList.replace('bg-blue-600', 'bg-green-600');
                            }

                            preview.classList.replace('border-gray-300', 'border-green-500');
                        }

                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
</body>

</html>