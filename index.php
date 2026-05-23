<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grytsje Suze — Design made to be seen, meant to be felt</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="./public/css/output.css" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen" style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">

<?php include __DIR__ . '/includes/nav.php'; ?>

<style>
    .catalogue-wrapper { overflow: hidden; width: 100%; background-color: #000; padding: 12px 0; }
    .catalogue-track { display: flex; width: max-content; will-change: transform; }
    .catalogue-item { flex-shrink: 0; width: 700px; height: 850px; margin: 0 12px; overflow: hidden; border: 4px solid #fff; }
    .catalogue-item img { width: 100%; height: 100%; object-fit: cover; display: block; }
</style>

<main class="flex-1">

    <!-- HERO SLOGAN -->
    <section style="background-color: #000; padding: 4rem 2rem 2rem; text-align: center;">
        <h1 style="font-family: 'Bebas Neue', sans-serif; color: #fff; font-size: clamp(2.5rem, 8vw, 7rem); line-height: 1.05; letter-spacing: 0.02em;">
            Design made to be seen,<br><span style="color: #ff40b4;">meant to be felt.</span>
        </h1>
    </section>

    <!-- HERO CAROUSEL -->
    <div class="catalogue-wrapper">
        <div class="catalogue-track" id="catalogueTrack">
            <?php
            $imgDir = __DIR__ . '/images/';
            $excluded = ['groot logo wit.png', 'GS Grytsje Suze Logo goed-01.png', 'GS Grytsje Suze Logo goed-02.png', 'GSLOGOWIT'];
            $extensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            $images = [];
            foreach (scandir($imgDir) as $file) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, $extensions) && !in_array($file, $excluded)) {
                    $images[] = $file;
                }
            }
            shuffle($images);
            foreach ($images as $img):
            ?>
            <div class="catalogue-item">
                <img src="./images/<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars(pathinfo($img, PATHINFO_FILENAME)) ?>">
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- See More of My Work -->
    <div class="flex justify-center py-8" style="background-color: #000;">
        <a href="portfolio.php" class="text-white text-2xl px-16 py-4 inline-block transition-all duration-200 shadow-lg"
           style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif;"
           onmouseover="this.style.backgroundColor='#e0359e'"
           onmouseout="this.style.backgroundColor='#ff40b4'">See More of My Work →</a>
    </div>

    <!-- WHAT'S IN MY BAG (mini About) -->
    <section style="background-color: #fff; padding: 5rem 2rem;">
        <div class="max-w-4xl mx-auto">
            <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 1rem;">✦ WHAT'S IN MY BAG</p>
            <h2 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 5vw, 4rem); line-height: 1.1; margin-bottom: 2rem; color: #000;">
                Bags that carry more than objects.<br>They carry presence.
            </h2>
            <p style="font-size: 1.05rem; color: #333; line-height: 1.9; max-width: 680px;">
                Leather as a medium for expression. Sculptural, bold and playful. Not silent accessories — but statements and conversation pieces that invite interaction and interpretation.
            </p>
            <div class="mt-8">
                <a href="about.php" class="text-white text-xl px-10 py-4 inline-block transition-all duration-200"
                   style="background-color: #000; font-family: 'Bebas Neue', sans-serif;"
                   onmouseover="this.style.backgroundColor='#ff40b4'"
                   onmouseout="this.style.backgroundColor='#000'">About the Studio →</a>
            </div>
        </div>
    </section>

    <!-- WAYS TO WORK TOGETHER -->
    <section style="background-color: #f5f5f5; padding: 5rem 2rem;">
        <div class="max-w-5xl mx-auto">
            <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 0.5rem; text-align: center;">✦ WAYS TO WORK TOGETHER</p>
            <h2 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 5vw, 3.5rem); text-align: center; margin-bottom: 1rem; color: #000;">
                My work moves between brand collaborations<br class="hidden md:inline"> and private commissions.
            </h2>
            <p style="text-align: center; color: #555; margin-bottom: 3rem; font-size: 1rem;">Choose the context that fits your project:</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Collaborations -->
                <div style="background-color: #000; padding: 3rem 2.5rem;">
                    <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 1rem;">✦ COLLABORATIONS</p>
                    <p style="color: #fff; font-size: 1rem; line-height: 1.8; margin-bottom: 2rem;">For brands, campaigns, film and creative productions.</p>
                    <a href="collaborations.php" class="inline-block text-black text-xl px-8 py-3 transition-all duration-200"
                       style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif;"
                       onmouseover="this.style.backgroundColor='#e0359e'"
                       onmouseout="this.style.backgroundColor='#ff40b4'">→ Explore Collaborations</a>
                </div>

                <!-- Commissions -->
                <div style="background-color: #ff40b4; padding: 3rem 2.5rem;">
                    <p style="font-family: 'Bebas Neue', sans-serif; color: #000; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 1rem;">✦ COMMISSIONS</p>
                    <p style="color: #000; font-size: 1rem; line-height: 1.8; margin-bottom: 2rem;">For bespoke pieces, collectors and private clients.</p>
                    <a href="commissions.php" class="inline-block text-white text-xl px-8 py-3 transition-all duration-200"
                       style="background-color: #000; font-family: 'Bebas Neue', sans-serif;"
                       onmouseover="this.style.backgroundColor='#222'"
                       onmouseout="this.style.backgroundColor='#000'">→ Explore Commissions</a>
                </div>

            </div>
        </div>
    </section>

    <!-- NEWS TEASER -->
    <section style="background-color: #000; padding: 5rem 2rem;">
        <div class="max-w-4xl mx-auto">
            <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 0.5rem;">✦ NEWS</p>
            <h2 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 5vw, 3.5rem); color: #fff; margin-bottom: 1rem;">Latest Updates</h2>
            <p style="color: #aaa; font-size: 1rem; line-height: 1.8; margin-bottom: 2.5rem;">Studio updates, expositions, recent work and projects.</p>
            <a href="news.php" class="inline-block text-black text-xl px-10 py-4 transition-all duration-200"
               style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif;"
               onmouseover="this.style.backgroundColor='#e0359e'"
               onmouseout="this.style.backgroundColor='#ff40b4'">View News →</a>
        </div>
    </section>

    <!-- CONTACT CTA -->
    <section style="background-color: #fff; padding: 5rem 2rem;">
        <div class="max-w-3xl mx-auto">
            <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 0.5rem;">✦ GET IN TOUCH</p>
            <h2 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 5vw, 3.5rem); color: #000; margin-bottom: 1rem;">Feel free to reach out.</h2>
            <p style="color: #555; font-size: 1rem; margin-bottom: 2.5rem;">For more information, collaborations, commissions or just to say hello.</p>
            <a href="contact.php" class="inline-block text-white text-xl px-10 py-4 transition-all duration-200"
               style="background-color: #000; font-family: 'Bebas Neue', sans-serif;"
               onmouseover="this.style.backgroundColor='#ff40b4'"
               onmouseout="this.style.backgroundColor='#000'">Send Inquiry →</a>
        </div>
    </section>

</main>

<!-- Floating Reach Out Button -->
<a href="contact.php"
   class="fixed bottom-8 right-8 z-50 inline-flex items-center gap-2 text-black text-lg px-6 py-3 shadow-2xl transition-all duration-200"
   style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif; border-radius: 50px;"
   onmouseover="this.style.backgroundColor='#e0359e'"
   onmouseout="this.style.backgroundColor='#ff40b4'">✦ Reach Out</a>

<?php include __DIR__ . '/includes/footer.php'; ?>

<script src="./script.js"></script>

</body>
</html>
