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
    <title>Work — Grytsje Suze</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="./public/css/output.css" rel="stylesheet">
    <style>
        /* Hide entire top navbar on mobile for portfolio page (sidebar nav used instead) */
        @media (max-width: 767px) {
            body > div.relative { display: none !important; }
            .portfolio-card { height: 400px; overflow: hidden; }
            .portfolio-card-text { overflow: hidden; }
        }
    </style>
</head>

<body class="flex flex-col min-h-screen" style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">

<!-- Mobile Sidebar Nav (portfolio-specific, only visible on small screens) -->
<div class="md:hidden fixed left-0 top-0 h-full w-20 z-50 flex flex-col items-center justify-between py-8" style="background-color: #000;">
    <a href="portfolio.php" class="text-white text-sm" style="font-family: 'Bebas Neue', sans-serif; writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing: 0.12em;">Portfolio</a>
    <a href="index.php">
        <img src="./images/groot logo wit.png" alt="Logo" class="h-auto" style="width: 180px; transform: rotate(-90deg);">
    </a>
    <a href="contact.php" class="text-white text-sm" style="font-family: 'Bebas Neue', sans-serif; writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing: 0.12em;">Contact Me</a>
</div>

<?php include __DIR__ . '/includes/nav.php'; ?>

<div class="pl-20 md:pl-0 flex flex-col flex-1">

<!-- PAGE HEADING -->
<div style="background-color: #000; padding: 3rem 2rem 2.5rem;">
    <div class="max-w-7xl mx-auto">
        <h1 style="font-family: 'Bebas Neue', sans-serif; color: #fff; font-size: clamp(3.5rem, 12vw, 9rem); line-height: 1;">Work</h1>
    </div>
</div>

        <main class="flex-1">
            <?php
            $count = 0;
            foreach ($tassen as $tas):
                $isEven = ($count % 2 == 0);
                $flexClass = $isEven ? 'flex-row' : 'flex-row-reverse';
                $bgColor = !empty($tas['kleurcode']) ? $tas['kleurcode'] : '#ffffff';
                $textColorClass = getContrastColor($bgColor);
            ?>
                <div class="portfolio-card flex <?= $flexClass ?>" style="min-height: 400px;">
                    <div class="w-1/2 overflow-hidden bg-gray-100">
                        <img src="./<?= htmlspecialchars($tas['afbeelding']) ?>" alt="<?= htmlspecialchars($tas['naam']) ?>" class="w-full h-full object-cover">
                    </div>
                    <div class="portfolio-card-text w-1/2 flex flex-col justify-center p-6 md:p-12 <?= $textColorClass ?>" style="background-color: <?= $bgColor ?>;">
                        <h2 class="text-xl md:text-5xl font-bold mb-2 md:mb-4 uppercase" style="font-family: 'Bebas Neue', sans-serif;">
                            <?= htmlspecialchars($tas['naam']) ?>
                        </h2>
                        <p class="text-xs md:text-lg opacity-90 leading-relaxed max-w-md">
                            <?= nl2br(htmlspecialchars($tas['beschrijving'])) ?>
                        </p>
                    </div>
                </div>
            <?php
                $count++;
            endforeach;
            ?>
        </main>

</div><!-- end mobile-offset wrapper -->

<!-- Floating Reach Out Button -->
<a href="contact.php"
   class="fixed bottom-8 right-8 z-50 inline-flex items-center gap-2 text-black text-lg px-6 py-3 shadow-2xl transition-all duration-200"
   style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif; border-radius: 50px;"
   onmouseover="this.style.backgroundColor='#e0359e'"
   onmouseout="this.style.backgroundColor='#ff40b4'">✦ Reach Out</a>

<?php include __DIR__ . '/includes/footer.php'; ?>

</body>

</html>
