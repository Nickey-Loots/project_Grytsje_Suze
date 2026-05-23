<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborations — Grytsje Suze</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="/css/output.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen" style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">

<?php require ROOT_PATH . '/app/Views/layouts/header.php'; ?>

<main class="flex-1">

    <div style="background-color: #000; padding: 3rem 2rem 2.5rem;">
        <div class="max-w-7xl mx-auto">
            <h1 style="font-family: 'Bebas Neue', sans-serif; color: #fff; font-size: clamp(3rem, 10vw, 8rem); line-height: 1;">Collaborations</h1>
        </div>
    </div>

    <section style="background-color: #fff; padding: 5rem 2rem;">
        <div class="max-w-4xl mx-auto">
            <p style="font-size: 1.15rem; color: #111; line-height: 1.9; margin-bottom: 1.5rem;">Grytsje Suze works as a conceptual designer and creative consultant, collaborating with brands, agencies and creative teams to develop leather-based objects, experiences and visual systems for fashion campaigns, film, editorial work and brand activations.</p>
            <p style="font-size: 1.15rem; color: #111; line-height: 1.9;">Each project is developed in close dialogue. Translating ideas, narratives and identities into sculptural leather objects and experiential formats that function as visual and physical extensions of a brand's story.</p>
        </div>
    </section>

    <section style="background-color: #f5f5f5; padding: 5rem 2rem;">
        <div class="max-w-4xl mx-auto">
            <div style="width: 100%; height: 3px; background-color: #ff40b4; margin-bottom: 3rem;"></div>
            <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 1.5rem;">CAPABILITIES</p>
            <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 0.75rem;">
                <?php foreach ($capabilities as $cap): ?>
                <li style="font-size: 1rem; color: #111; padding: 0.85rem 1.25rem; border-left: 4px solid #ff40b4; background-color: #fff;">
                    ✦ <?= htmlspecialchars($cap) ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <div style="width: 100%; height: 3px; background-color: #ff40b4; margin-top: 3rem;"></div>
        </div>
    </section>

    <section style="background-color: #fff; padding: 5rem 2rem;">
        <div class="max-w-4xl mx-auto">
            <div style="width: 100%; height: 3px; background-color: #ff40b4; margin-bottom: 3rem;"></div>
            <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 1.5rem;">PROCESS</p>
            <p style="font-size: 1.1rem; color: #111; line-height: 1.9; margin-bottom: 3rem;">Each project begins with an idea, narrative or visual direction. Through conversation, experimentation and development, Grytsje Suze translates concepts into objects or experiential formats that align with the story, identity or atmosphere of a project. She works independently or in collaboration with specialist makers and production partners.</p>

            <div style="width: 100%; height: 3px; background-color: #ff40b4; margin-bottom: 3rem;"></div>
            <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 1.5rem;">SCALE</p>
            <p style="font-size: 1.1rem; color: #111; line-height: 1.9; margin-bottom: 3rem;">Grytsje Suze operates across different scales. From singular leather statement pieces and conversation objects to limited series, workshops, brand experiences and larger visual systems for campaigns, launches and activations.</p>

            <div style="width: 100%; height: 3px; background-color: #ff40b4; margin-bottom: 3rem;"></div>
            <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 1.5rem;">APPLICATION &amp; IMPACT</p>
            <p style="font-size: 1.1rem; color: #111; line-height: 1.9; margin-bottom: 1.5rem;">Her work is used to strengthen visual identity and create distinction within competitive visual environments. Leather objects and experiences function as engagement tools, conversation starters and focal points within campaigns.</p>
            <p style="font-size: 1.1rem; color: #111; line-height: 1.9; margin-bottom: 1.5rem;">They are applied in brand activations, product launches, workshops and experiential settings, contributing to a more tangible and immersive brand experience.</p>
            <p style="font-size: 1.1rem; color: #111; line-height: 1.9; margin-bottom: 1.5rem;">Her work is also available for use in film, television and editorial productions. These works function as props, wearable statements or visual elements within storytelling contexts.</p>
            <p style="font-size: 1.1rem; color: #111; line-height: 1.9;">In addition, her work includes bespoke gifting — custom-designed leather objects for corporate gifting, VIP relations and special campaigns.</p>
            <div style="width: 100%; height: 3px; background-color: #ff40b4; margin-top: 3rem;"></div>
        </div>
    </section>

    <section style="background-color: #000; padding: 5rem 2rem;">
        <div class="max-w-7xl mx-auto">
            <p style="font-family: 'Bebas Neue', sans-serif; color: #aaa; font-size: 0.85rem; letter-spacing: 0.3em; text-align: center; margin-bottom: 1.5rem;">FEATURED COLLABORATION</p>
            <div style="background-color: #111; padding: 3rem; text-align: center;">
                <p style="font-family: 'Bebas Neue', sans-serif; color: #fff; font-size: clamp(1.5rem, 4vw, 2.5rem); margin-bottom: 0.5rem;">Magnum Show</p>
                <p style="color: #aaa; font-size: 0.9rem; margin-bottom: 2rem;">Film by Fourcreating</p>
                <div style="width: 100%; max-width: 800px; margin: 0 auto; overflow: hidden;">
                    <img src="/images/Magnum Bags.jpg" alt="Magnum Show — Grytsje Suze" style="width: 100%; height: auto; display: block;">
                </div>
                <div class="mt-8">
                    <a href="/portfolio" class="inline-block text-black text-xl px-10 py-4 transition-all duration-200"
                       style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif;"
                       onmouseover="this.style.backgroundColor='#e0359e'"
                       onmouseout="this.style.backgroundColor='#ff40b4'">View Full Portfolio →</a>
                </div>
            </div>
        </div>
    </section>

    <section style="background-color: #ff40b4; padding: 5rem 2rem; text-align: center;">
        <div class="max-w-3xl mx-auto">
            <div style="width: 100%; height: 2px; background-color: #000; margin-bottom: 3rem;"></div>
            <p style="font-family: 'Bebas Neue', sans-serif; color: #000; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 1rem;">COLLABORATION</p>
            <h2 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(1.8rem, 4vw, 3rem); color: #000; margin-bottom: 2rem;">For collaborations, production use, workshops or bespoke commissions</h2>
            <a href="/contact" class="inline-block text-white text-2xl px-12 py-5 transition-all duration-200"
               style="background-color: #000; font-family: 'Bebas Neue', sans-serif;"
               onmouseover="this.style.backgroundColor='#333'"
               onmouseout="this.style.backgroundColor='#000'">Feel free to contact me →</a>
        </div>
    </section>

</main>

<a href="/contact"
   class="fixed bottom-8 right-8 z-50 inline-flex items-center gap-2 text-black text-lg px-6 py-3 shadow-2xl transition-all duration-200"
   style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif; border-radius: 50px;"
   onmouseover="this.style.backgroundColor='#e0359e'"
   onmouseout="this.style.backgroundColor='#ff40b4'">✦ Reach Out</a>

<?php require ROOT_PATH . '/app/Views/layouts/footer.php'; ?>
<script src="/js/script.js"></script>
</body>
</html>
