<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News — Grytsje Suze</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="./public/css/output.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen" style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">

<?php include __DIR__ . '/includes/nav.php'; ?>

<main class="flex-1">

    <!-- PAGE HEADING -->
    <div style="background-color: #000; padding: 3rem 2rem 2.5rem;">
        <div class="max-w-7xl mx-auto">
            <h1 style="font-family: 'Bebas Neue', sans-serif; color: #fff; font-size: clamp(3.5rem, 12vw, 9rem); line-height: 1;">News</h1>
            <p style="color: #aaa; font-size: 1rem; margin-top: 1rem;">Agenda, upcoming &amp; recent expositions, projects, articles and studio updates.</p>
        </div>
    </div>

    <!-- NEWS GRID -->
    <section style="background-color: #fff; padding: 5rem 2rem;">
        <div class="max-w-6xl mx-auto">

            <!-- Placeholder news items — replace/extend with real content or DB -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Item 1 -->
                <article style="border-top: 4px solid #ff40b4; padding-top: 1.5rem;">
                    <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.8rem; letter-spacing: 0.25em; margin-bottom: 0.5rem;">EXPOSITION</p>
                    <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.6rem; color: #000; margin-bottom: 0.75rem; line-height: 1.2;">Upcoming: Title to be announced</h3>
                    <p style="font-size: 0.9rem; color: #777; margin-bottom: 1rem;">Date · Location</p>
                    <p style="font-size: 0.95rem; color: #333; line-height: 1.7;">
                        More information to follow. Stay tuned for updates on upcoming expositions and events.
                    </p>
                </article>

                <!-- Item 2 -->
                <article style="border-top: 4px solid #ff40b4; padding-top: 1.5rem;">
                    <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.8rem; letter-spacing: 0.25em; margin-bottom: 0.5rem;">PROJECT</p>
                    <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.6rem; color: #000; margin-bottom: 0.75rem; line-height: 1.2;">Recent Work: Magnum Show</h3>
                    <p style="font-size: 0.9rem; color: #777; margin-bottom: 1rem;">Film by Fourcreating</p>
                    <p style="font-size: 0.95rem; color: #333; line-height: 1.7;">
                        Leather bags and wearable objects created for the Magnum Show — a film production by Fourcreating.
                    </p>
                    <a href="portfolio.php" style="display: inline-block; margin-top: 1rem; font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.9rem; letter-spacing: 0.1em;">View in Portfolio →</a>
                </article>

                <!-- Item 3 -->
                <article style="border-top: 4px solid #ff40b4; padding-top: 1.5rem;">
                    <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.8rem; letter-spacing: 0.25em; margin-bottom: 0.5rem;">STUDIO UPDATE</p>
                    <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.6rem; color: #000; margin-bottom: 0.75rem; line-height: 1.2;">New Work in Progress</h3>
                    <p style="font-size: 0.9rem; color: #777; margin-bottom: 1rem;">Studio, 2025</p>
                    <p style="font-size: 0.95rem; color: #333; line-height: 1.7;">
                        New collections and commissioned objects currently in development. More to be shared soon.
                    </p>
                </article>

            </div>

        </div>
    </section>

    <!-- CONTACT CTA -->
    <section style="background-color: #000; padding: 4rem 2rem; text-align: center;">
        <div class="max-w-3xl mx-auto">
            <p style="color: #aaa; font-size: 1rem; margin-bottom: 1.5rem;">Want to stay informed or collaborate on a project?</p>
            <a href="contact.php" class="inline-block text-black text-xl px-10 py-4 transition-all duration-200"
               style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif;"
               onmouseover="this.style.backgroundColor='#e0359e'"
               onmouseout="this.style.backgroundColor='#ff40b4'">Reach Out →</a>
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
