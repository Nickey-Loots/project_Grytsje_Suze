<?php
// 1. Database verbinding
$host = 'localhost';
$db = 'grytsje suze';
$user = 'bitacademy';
$pass = 'bitacademy';
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

// 2. Haal alle tassen op
$stmt = $pdo->query("SELECT * FROM tassen ORDER BY id DESC");
$tassen = $stmt->fetchAll();

/**
 * Functie om te bepalen of tekst zwart of wit moet zijn op basis van de achtergrondkleur.
 * Werkt op basis van de YIQ-helderheidsschaal.
 */
function getContrastColor($hexColor)
{
    // Verwijder de # als die er staat
    $hexColor = str_replace('#', '', $hexColor);

    // Zet hex om naar RGB
    $r = hexdec(substr($hexColor, 0, 2));
    $g = hexdec(substr($hexColor, 2, 2));
    $b = hexdec(substr($hexColor, 4, 2));

    // Bereken de helderheid (YIQ formule)
    // Een waarde boven de 128 wordt over het algemeen als 'licht' beschouwd
    $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

    return ($yiq >= 128) ? 'text-black' : 'text-white';
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - Grytsje Suze</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="./public/css/output.css" rel="stylesheet">
</head>

<body style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">

<<<<<<< HEAD
<<<<<<< HEAD
    <div class="md:hidden fixed left-0 top-0 h-full w-12 z-50 flex flex-col items-center justify-between py-8" style="background-color: #000;">
>>>>>>> 02f357fda2c5a4496c583728be3002fc3f9fa991
=======
    <!-- Mobile Sidebar Nav -->
    <div class="md:hidden fixed left-0 top-0 h-full w-20 z-50 flex flex-col items-center justify-between py-8" style="background-color: #000;">
>>>>>>> webpage
        <a href="portfolio.php" class="text-white text-sm" style="font-family: 'Bebas Neue', sans-serif; writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing: 0.12em;">Portfolio</a>
=======
    <div class="md:hidden fixed left-0 top-0 h-full w-12 z-50 flex flex-col items-center justify-between py-8"
        style="background-color: #000;">
        <a href="portfolio.php" class="text-white text-sm"
            style="font-family: 'Bebas Neue', sans-serif; writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing: 0.12em;">Portfolio</a>
>>>>>>> d36996067eb81731e2f06feab564f73354bbf235
        <a href="index.php">
            <img src="./images/groot logo wit.png" alt="Logo" class="h-auto" style="width: 180px; transform: rotate(-90deg);">
        </a>
<<<<<<< HEAD
        <a href="contact.php" class="text-white text-sm" style="font-family: 'Bebas Neue', sans-serif; writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing: 0.12em;">Contact Me</a>
=======
        <a href="contact.php" class="text-white text-sm"
            style="font-family: 'Bebas Neue', sans-serif; writing-mode: vertical-rl; letter-spacing: 0.12em;">Contact
            Me</a>
>>>>>>> d36996067eb81731e2f06feab564f73354bbf235
    </div>

    <!-- Page wrapper: offset on mobile for sidebar -->
    <div class="flex flex-col min-h-screen pl-20 md:pl-0">

<<<<<<< HEAD
    <div class="md:ml-0 ml-12">
        <header class="flex items-center justify-between px-4 md:px-8 py-4 border-b border-gray-300 bg-white">
            <div class="hidden md:flex gap-8 text-sm uppercase tracking-widest font-bold">
                <a href="portfolio.php" class="hover:text-gray-500">Portfolio</a>
                <a href="contact.php" class="hover:text-gray-500">Contact Me</a>
            </div>
            <div class="mx-auto md:mx-0">
                <a href="index.php">
                    <img src="./images/GS Grytsje Suze Logo goed-01.png" alt="Logo" class="h-12 md:h-16 w-auto">
                </a>
            </div>
            <div class="hidden md:block w-24"></div>
=======
    <!-- Desktop Navbar -->
    <div class="relative hidden md:block" style="padding-top: 50px; margin-top: 5px;">
        <!-- Logo bump: rises UP above the black bar into the white space -->
        <div style="
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 190px;
            height: 100px;
            background-color: #000;
            border-radius: 95px 95px 0 0;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 2px;
            z-index: 10;
        ">
            <a href="index.php">
                <img src="./images/groot logo wit.png" alt="GS Grytsje Suze Logo" style="height: 96px; width: auto;">
            </a>
        </div>

        <!-- Black bar -->
        <header class="flex items-center justify-between px-6 md:px-16" style="background-color: #000; height: 75px;">
            <nav style="font-family: 'Bebas Neue', sans-serif;">
                <a href="portfolio.php" class="text-white text-xl md:text-3xl tracking-widest hover:text-pink-400 transition-colors">Portfolio</a>
            </nav>
            <!-- spacer so text doesn't overlap logo bump -->
            <div style="width: 160px; flex-shrink: 0;"></div>
            <nav style="font-family: 'Bebas Neue', sans-serif;">
                <a href="contact.php" class="text-white text-xl md:text-3xl tracking-widest hover:text-pink-400 transition-colors">Contact Me</a>
            </nav>
>>>>>>> webpage
        </header>
    </div>

        <main>
            <?php
            $count = 0;
            foreach ($tassen as $tas):
                $isEven = ($count % 2 == 0);
                $flexClass = $isEven ? 'flex-row' : 'flex-row-reverse';


                // Gebruik de kleurcode uit de DB, fallback naar wit als deze leeg is
                $bgColor = !empty($tas['kleurcode']) ? $tas['kleurcode'] : '#ffffff';
                // Haal de titelkleur en tekstkleur op uit de DB, fallback naar zwart als deze leeg is
                $titleColor = !empty($tas['titel_kleur']) ? $tas['titel_kleur'] : '#000000';
                $textColor = !empty($tas['tekst_kleur']) ? $tas['tekst_kleur'] : '#000000';
                ?>
                    <div class="flex <?= $flexClass ?>" style="min-height: 400px;">
                    <div class="w-1/2 overflow-hidden bg-gray-100">
                        <img src="./<?= htmlspecialchars($tas['afbeelding']) ?>" alt="<?= htmlspecialchars($tas['naam']) ?>"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="w-1/2 flex flex-col justify-center p-6 md:p-12 <?= $textColorClass ?>"
                        style="background-color: <?= $bgColor ?>;">

                        <h2 class="text-xl md:text-5xl font-bold mb-2 md:mb-4 uppercase"
                            style="font-family: 'Bebas Neue', sans-serif; color: <?= $titleColor ?>;">
                            <?= htmlspecialchars($tas['naam']) ?>
                        </h2>

                        <p class="text-xs md:text-lg opacity-90 leading-relaxed max-w-md" style="color: <?= $textColor ?>;">
                            <?= nl2br(htmlspecialchars($tas['beschrijving'])) ?>
                        </p>

                        <?php if ($tas['model_3d']): ?>
                            <div class="mt-6">
                                <span class="text-[10px] uppercase tracking-widest border border-current px-2 py-1 rounded">
                                    3D Model beschikbaar
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                    $count++;
            endforeach;
            ?>
        </main>

        <footer
            class="border-t border-gray-300 px-4 md:px-8 py-6 flex flex-col md:flex-row items-center justify-between gap-4 bg-white">
            <div>
                <a href="index.php">
                    <img src="./images/GS Grytsje Suze Logo goed-02.png" alt="Footer Logo" class="h-10 w-auto">
                </a>
            </div>
            <nav class="flex gap-6 text-xs uppercase tracking-tighter text-gray-500 font-bold">
                <a href="portfolio.php" class="hover:text-black">Portfolio</a>
                <a href="contact.php" class="hover:text-black">Contact Me</a>
            </nav>
            <div class="text-[10px] text-gray-400 uppercase tracking-widest">
                &copy; <?= date('Y') ?> Grytsje Suze
            </div>
        </footer>
    </div>
</body>

</html>