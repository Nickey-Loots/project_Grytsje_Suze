<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you — Grytsje Suze</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="./public/css/output.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen" style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">

<?php include __DIR__ . '/includes/nav.php'; ?>

<main class="flex-1 flex items-center justify-center" style="background-color: #fff; padding: 6rem 2rem;">
    <div class="text-center max-w-2xl mx-auto">
        <p style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 1rem;">✦ MESSAGE RECEIVED</p>
        <h1 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(3rem, 10vw, 6rem); line-height: 1.05; color: #000; margin-bottom: 2rem;">
            Thank you for<br>reaching out.
        </h1>
        <p style="font-size: 1.1rem; color: #333; line-height: 1.8; margin-bottom: 1rem;">
            Your request has been received.
        </p>
        <p style="font-size: 1rem; color: #777; line-height: 1.8; margin-bottom: 3rem;">
            Each inquiry is reviewed with care, and I'll come back to you as soon as possible.
        </p>
        <a href="index.php" class="inline-block text-white text-2xl px-12 py-5 transition-all duration-200"
           style="background-color: #000; font-family: 'Bebas Neue', sans-serif;"
           onmouseover="this.style.backgroundColor='#ff40b4'"
           onmouseout="this.style.backgroundColor='#000'">Return to Homepage →</a>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

</body>
</html>
