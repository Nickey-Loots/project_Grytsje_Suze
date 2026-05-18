<?php
include './includes/db.php';
include './admin/functions.php';

$tassen = getAllTassen($pdo);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work — Grytsje Suze</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="./public/css/output.css" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen" style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">

<?php include __DIR__ . '/includes/nav.php'; ?>

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
                <div class="flex <?= $flexClass ?>" style="min-height: 400px;">
                    <div class="w-1/2 overflow-hidden bg-gray-100">
                        <img src="./<?= htmlspecialchars($tas['afbeelding']) ?>" alt="<?= htmlspecialchars($tas['naam']) ?>" class="w-full h-full object-cover">
                    </div>
                    <div class="w-1/2 flex flex-col justify-center p-6 md:p-12 <?= $textColorClass ?>" style="background-color: <?= $bgColor ?>;">
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

<!-- Floating Reach Out Button -->
<a href="contact.php"
   class="fixed bottom-8 right-8 z-50 inline-flex items-center gap-2 text-black text-lg px-6 py-3 shadow-2xl transition-all duration-200"
   style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif; border-radius: 50px;"
   onmouseover="this.style.backgroundColor='#e0359e'"
   onmouseout="this.style.backgroundColor='#ff40b4'">✦ Reach Out</a>

<?php include __DIR__ . '/includes/footer.php'; ?>

</body>

</html>