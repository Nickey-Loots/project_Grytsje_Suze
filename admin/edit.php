<?php
include 'auth.php';

// Database verbinding
$host = 'localhost';
$db = 'grytsje suze';
$user = 'bit_academy';
$pass = 'bit_academy';
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (\PDOException $e) {
    die("Database verbinding mislukt: " . $e->getMessage());
}

// 1. Haal de gegevens op
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM tassen WHERE id = :id");
$stmt->execute([':id' => $id]);
$tas = $stmt->fetch();

if (!$tas) {
    die("Tas niet gevonden.");
}

// 2. Verwerk de update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $beschrijving = $_POST['beschrijving'];
    $kleurcode = $_POST['kleurcode'];
    $afbeeldingPad = $tas['afbeelding'];

    if (isset($_FILES['afbeelding']) && $_FILES['afbeelding']['error'] === 0) {
        $unieke_naam = time() . '_' . basename($_FILES['afbeelding']['name']);
        $doel = "../uploads/" . $unieke_naam;
        if (move_uploaded_file($_FILES['afbeelding']['tmp_name'], $doel)) {
            if (file_exists("../" . $tas['afbeelding'])) {
                unlink("../" . $tas['afbeelding']);
            }
            $afbeeldingPad = "uploads/" . $unieke_naam;
        }
    }

    $sql = "UPDATE tassen SET naam = :n, beschrijving = :b, afbeelding = :a, kleurcode = :k WHERE id = :id";
    $pdo->prepare($sql)->execute([':n' => $naam, ':b' => $beschrijving, ':a' => $afbeeldingPad, ':k' => $kleurcode, ':id' => $id]);

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
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans pb-20">

    <nav class="bg-gray-900 h-16 flex items-center shadow-lg px-6 mb-10">
        <span class="text-white font-bold uppercase tracking-widest">Admin<span
                class="text-blue-500">Panel</span></span>
    </nav>

    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-white shadow-xl rounded-2xl p-8">
            <h2 class="text-2xl font-black text-gray-800 mb-8 border-b pb-4">Product Aanpassen</h2>

            <form action="" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-10">

                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Naam</label>
                        <input type="text" name="naam" value="<?= htmlspecialchars($tas['naam']) ?>" required
                            class="w-full border-2 border-gray-100 rounded-xl p-3 focus:border-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Beschrijving</label>
                        <textarea name="beschrijving" rows="6" required
                            class="w-full border-2 border-gray-100 rounded-xl p-3 focus:border-blue-500 outline-none transition"><?= htmlspecialchars($tas['beschrijving']) ?></textarea>
                        </div>
                        <div class="bg-blue-50 p-6 rounded-2xl border-2 border-blue-100">
                            <label class="block text-xs font-bold text-blue-400 uppercase mb-3">Kleur van de tas</label>
                            <div class="flex items-center gap-4">
                                <input type="color" name="kleurcode" id="kleurcode"
                                    value="<?= htmlspecialchars($tas['kleurcode'] ?? '#ffffff') ?>"
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
                            <p class="mt-3 text-[11px] text-blue-400 font-medium leading-tight">Klik op de knop, beweeg je
                                muis over de afbeelding rechts en klik op de tas voor de exacte kleur.</p>
                        </div>
                </div>

                <div class="flex flex-col items-center">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-3 self-start">Productfoto</label>
                    <div class="relative w-full aspect-square max-w-100]">
                        <img id="preview-img" src="../<?= htmlspecialchars($tas['afbeelding']) ?>"
                            class="w-full h-full object-cover rounded-3xl border-8 border-white shadow-2xl transition-all duration-300">
                    </div>
                    <div class="mt-6 w-full">
                        <input type="file" name="afbeelding" id="file-input" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-gray-800 file:text-white hover:file:bg-black transition cursor-pointer">
                    </div>
                </div>

                <div class="md:col-span-2 flex justify-between items-center pt-8 border-t mt-4">
                    <a href="index.php"
                        class="text-gray-400 hover:text-gray-600 font-bold text-sm tracking-widest uppercase transition">Annuleren</a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-black py-4 px-12 rounded-2xl shadow-lg transform hover:-translate-y-1 transition-all uppercase tracking-widest">
                        Wijzigingen Opslaan
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
            const colorHex = document.getElementById('color-hex');

            // Functie om de kleurwaarde overal bij te werken
            function updateColorDisplay(hex) {
                kleurInput.value = hex;
                if (colorHex) colorHex.textContent = hex.toUpperCase();
            }

            // 1. De "Magic" Pipet (Chrome/Edge Desktop)
            if ('EyeDropper' in window) {
                const eyeDropper = new EyeDropper();
                pipetBtn.addEventListener('click', () => {
                    eyeDropper.open().then(result => {
                        updateColorDisplay(result.sRGBHex);
                    }).catch(e => { });
                });
            }
            // 2. Safari (iPhone) & Firefox Fallback
            else {
                pipetBtn.textContent = "Tik op foto voor kleur";
                pipetBtn.classList.replace('text-blue-600', 'text-orange-600');

                // We luisteren naar zowel 'click' (desktop) als 'touchend' (mobiel)
                const getColorFromEvent = function (e) {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    // Gebruik natuurlijke afmetingen van de afbeelding voor nauwkeurigheid
                    canvas.width = previewImg.naturalWidth;
                    canvas.height = previewImg.naturalHeight;
                    ctx.drawImage(previewImg, 0, 0, canvas.width, canvas.height);

                    const rect = previewImg.getBoundingClientRect();

                    // Ondersteuning voor zowel muisklik als vinger-tap
                    const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                    const clientY = e.touches ? e.touches[0].clientY : e.clientY;

                    // Bereken verhouding tussen weergegeven grootte en echte grootte
                    const x = (clientX - rect.left) * (canvas.width / rect.width);
                    const y = (clientY - rect.top) * (canvas.height / rect.height);

                    const pixel = ctx.getImageData(x, y, 1, 1).data;
                    const hex = "#" + ((1 << 24) + (pixel[0] << 16) + (pixel[1] << 8) + pixel[2]).toString(16).slice(1);

                    updateColorDisplay(hex);
                };

                previewImg.addEventListener('click', getColorFromEvent);
                // Voeg touch ondersteuning toe voor iPhone
                previewImg.addEventListener('touchstart', function (e) {
                    // Voorkom dat de pagina scrollt terwijl je tikt voor een kleur
                    getColorFromEvent(e);
                }, { passive: true });
            }

            // De standaard Image Preview voor de file-input
            document.getElementById('file-input').addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (event) => { previewImg.src = event.target.result; };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</body>

</html>