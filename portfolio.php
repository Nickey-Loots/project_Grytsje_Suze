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

    <!-- Mobile Sidebar Nav -->
    <div class="md:hidden fixed left-0 top-0 h-full w-20 z-50 flex flex-col items-center justify-between py-8" style="background-color: #000;">
        <a href="portfolio.php" class="text-white text-sm" style="font-family: 'Bebas Neue', sans-serif; writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing: 0.12em;">Portfolio</a>
        <a href="index.php">
            <img src="./images/groot logo wit.png" alt="Logo" class="h-auto" style="width: 180px; transform: rotate(-90deg);">
        </a>
        <a href="contact.php" class="text-white text-sm" style="font-family: 'Bebas Neue', sans-serif; writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing: 0.12em;">Contact Me</a>
    </div>

    <!-- Page wrapper: offset on mobile for sidebar -->
    <div class="flex flex-col min-h-screen pl-20 md:pl-0">

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
        </header>
    </div>

        <main>
            <?php
            $count = 0;
            foreach ($tassen as $tas):
                // Om de beurt links en rechts wisselen (flex-row vs flex-row-reverse)
                $isEven = ($count % 2 == 0);
                $flexClass = $isEven ? 'flex-row' : 'flex-row-reverse';
                ?>
                <div class="flex <?= $flexClass ?>" style="min-height: 280px;">
                    <div class="w-1/2 overflow-hidden bg-gray-100">
                        <img src="./<?= htmlspecialchars($tas['afbeelding']) ?>" alt="<?= htmlspecialchars($tas['naam']) ?>"
                        class="w-full h-full object-cover shadow-inner">
                </div>
                    <div class="w-1/2 flex flex-col justify-center p-6 md:p-12 bg-white">
                        <h2 class="text-xl md:text-5xl font-bold mb-2 md:mb-4 uppercase" style="font-family: 'Bebas Neue', sans-serif;">
                            <?= htmlspecialchars($tas['naam']) ?>
                        </h2>
                        <p class="text-xs md:text-lg text-gray-700 leading-relaxed max-w-md">
                            <?= nl2br(htmlspecialchars($tas['beschrijving'])) ?>
                        </p>

                        </div>
                </div>
            <?php
                $count++;
            endforeach;
            ?>
        </main>

        <footer class="border-t border-gray-300 px-4 md:px-8 py-6 flex flex-col md:flex-row items-center justify-between gap-4">
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