<?php
include './includes/db.php';

// Haal alle tassen op
$stmt = $pdo->query("SELECT * FROM tassen ORDER BY id DESC");
$tassen = $stmt->fetchAll();

/**
 * Functie om te bepalen of tekst zwart of wit moet zijn op basis van de achtergrondkleur.
 */
function getContrastColor($hexColor)
{
    $hexColor = str_replace('#', '', $hexColor);
    $r = hexdec(substr($hexColor, 0, 2));
    $g = hexdec(substr($hexColor, 2, 2));
    $b = hexdec(substr($hexColor, 4, 2));
    $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
    return ($yiq >= 128) ? 'text-black' : 'text-white';
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="./public/css/output.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen" style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">

    <?php include __DIR__ . '/includes/nav.php'; ?>

    <main class="grow">
        <?php
        $count = 0;
        foreach ($tassen as $tas):
            $bgColor = !empty($tas['kleurcode']) ? htmlspecialchars($tas['kleurcode']) : '#ffffff';
            $textColorClass = getContrastColor($bgColor);
            $reverse = $count % 2 === 1;
            ?>
            <div class="flex flex-col md:flex-row<?= $reverse ? ' md:flex-row-reverse' : '' ?> w-full min-h-[40vh] md:min-h-[60vh] border-b border-gray-300 cursor-pointer hover:opacity-95 transition-opacity"
                onclick="window.location.href='tas.php?id=<?= $tas['id'] ?>'">

                <div class="w-full md:w-1/2 overflow-hidden bg-gray-100">
                    <img src="./<?= htmlspecialchars($tas['afbeelding']) ?>" alt="<?= htmlspecialchars($tas['naam']) ?>"
                        class="w-full h-full object-cover">
                </div>

                <div class="w-full md:w-1/2 flex flex-col justify-center p-6 md:p-12 <?= $textColorClass ?>"
                    style="background-color: <?= $bgColor ?>;">
                    <h2 class="text-xl md:text-5xl font-bold mb-2 md:mb-4 uppercase"
                        style="font-family: 'Bebas Neue', sans-serif;">
                        <?= htmlspecialchars($tas['naam']) ?>
                    </h2>
                    <p class="text-xs md:text-lg opacity-90 leading-relaxed max-w-md mb-6">
                        <?= nl2br(htmlspecialchars($tas['beschrijving'])) ?>
                    </p>

                    <a href="tas.php?id=<?= $tas['id'] ?>"
                        class="inline-block w-full text-sm md:text-lg border border-current px-6 py-2 uppercase tracking-wider hover:bg-white hover:text-black transition-colors"
                        style="font-family: 'Bebas Neue', sans-serif;">
                        Bekijk Customizer <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            <?php
            $count++;
        endforeach;
        ?>
    </main>

    <a href="contact.php"
        class="fixed bottom-8 right-8 z-50 inline-flex items-center gap-2 text-black text-lg px-6 py-3 shadow-2xl transition-all duration-200"
        style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif; border-radius: 50px;"
        onmouseover="this.style.backgroundColor='#e0359e'" onmouseout="this.style.backgroundColor='#ff40b4'">
        Reach Out <i class="fa-solid fa-arrow-right"></i>
    </a>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>