<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About — Grytsje Suze</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="/css/output.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen" style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">

<?php require ROOT_PATH . '/app/Views/layouts/header.php'; ?>

<main class="flex-1">

    <div style="background-color: #ff40b4; padding: 3rem 2rem 2.5rem;">
        <div class="max-w-7xl mx-auto">
            <h1 style="font-family: 'Bebas Neue', sans-serif; color: #fff; font-size: clamp(3.5rem, 12vw, 9rem); line-height: 1;">About</h1>
        </div>
    </div>

    <section style="background-color: #fff; padding: 5rem 2rem;">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            <div>
                <p style="font-size: 1.1rem; color: #111; line-height: 1.9; margin-bottom: 1.5rem;">Grytsje Suze creates bags and leather objects that exist between fashion, art and visual storytelling.</p>
                <p style="font-size: 1.1rem; color: #111; line-height: 1.9; margin-bottom: 1.5rem;">Starting from a concept, emotion or image, she develops expressive pieces designed to carry presence: to be seen, felt and remembered.</p>
                <p style="font-size: 1.1rem; color: #111; line-height: 1.9; margin-bottom: 1.5rem;">Her practice moves between thinking and making. Ideas are shaped into form through an intuitive process that blends conceptual development with hands-on exploration. Depending on the project, she works independently or in collaboration with specialist makers and production partners to bring ideas into physical reality.</p>
                <p style="font-size: 1.1rem; color: #111; line-height: 1.9; margin-bottom: 1.5rem;">Her work is driven by visual energy, material contrast and a strong sense of character. With a focus on intentional design and materials that last, craftsmanship, quality and meaning are central. Both visually and physically.</p>
                <p style="font-size: 1.1rem; color: #111; line-height: 1.9; margin-bottom: 1.5rem;">Through experimentation with material, shape and interaction, her process remains innovative and explorative. Many pieces are modular or adaptable, shifting in meaning depending on how they are worn, placed or experienced. In this way, each design becomes part of a larger narrative; a moment, a mood, a statement, or an extension of identity.</p>
                <p style="font-size: 1.1rem; color: #111; line-height: 1.9; margin-bottom: 1.5rem;">Leather is used as a medium for expression: sculptural, bold and playful. Her objects are not silent accessories, but statements and conversation pieces that invite interaction and interpretation.</p>
                <p style="font-size: 1.1rem; color: #111; line-height: 1.9; margin-bottom: 1.5rem;">Her practice spans bags, wearable objects and spatial concepts, developed for fashion campaigns, brand activations, film and editorial productions. Within collaborations, she operates as a conceptual designer and creative partner, translating ideas into striking visual form.</p>
                <p style="font-size: 1.1rem; color: #111; line-height: 1.9;">Her work gives ideas form, and allows them to exist within the visual world.</p>
            </div>
            <div style="overflow: hidden; min-height: 600px;">
                <img src="/images/magnum selfieh.jpg" alt="Grytsje Suze at work with Magnum bags" style="width: 100%; height: 100%; object-fit: cover; display: block; min-height: 600px;">
            </div>
        </div>
    </section>

    <section style="background-color: #000; padding: 5rem 2rem;">
        <div class="max-w-5xl mx-auto">
            <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 0.5rem; text-align: center;">✦ WORK WITH ME</p>
            <h2 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 5vw, 3.5rem); color: #fff; text-align: center; margin-bottom: 1rem;">My work moves between brand collaborations<br class="hidden md:inline"> and private commissions.</h2>
            <p style="color: #aaa; text-align: center; margin-bottom: 3rem; font-size: 1rem;">Choose the context that fits your project:</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div style="border: 2px solid #ff40b4; padding: 2.5rem;">
                    <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 1rem;">✦ COLLABORATIONS</p>
                    <p style="color: #fff; font-size: 1rem; line-height: 1.8; margin-bottom: 2rem;">For brands, campaigns, film, activations and creative projects.</p>
                    <a href="/collaborations" class="inline-block text-black text-xl px-8 py-3 transition-all duration-200"
                       style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif;"
                       onmouseover="this.style.backgroundColor='#e0359e'"
                       onmouseout="this.style.backgroundColor='#ff40b4'">→ Explore Collaborations</a>
                </div>
                <div style="border: 2px solid #fff; padding: 2.5rem;">
                    <p style="font-family: 'Bebas Neue', sans-serif; color: #fff; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 1rem;">✦ PRIVATE WORK</p>
                    <p style="color: #fff; font-size: 1rem; line-height: 1.8; margin-bottom: 2rem;">For bespoke commissions, collectible objects and styling use.</p>
                    <a href="/commissions" class="inline-block text-white text-xl px-8 py-3 transition-all duration-200"
                       style="border: 2px solid #fff; font-family: 'Bebas Neue', sans-serif;"
                       onmouseover="this.style.backgroundColor='#fff'; this.style.color='#000';"
                       onmouseout="this.style.backgroundColor='transparent'; this.style.color='#fff';">→ Explore Private Work</a>
                </div>
            </div>
        </div>
    </section>

    <section style="background-color: #ff40b4; padding: 4rem 2rem; text-align: center;">
        <a href="/contact" class="inline-block text-white text-2xl px-12 py-5 transition-all duration-200"
           style="background-color: #000; font-family: 'Bebas Neue', sans-serif;"
           onmouseover="this.style.backgroundColor='#333'"
           onmouseout="this.style.backgroundColor='#000'">Feel free to reach out →</a>
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
