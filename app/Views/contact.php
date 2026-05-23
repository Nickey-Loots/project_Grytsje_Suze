<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact — Grytsje Suze</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="/css/output.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen" style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">

<?php require ROOT_PATH . '/app/Views/layouts/header.php'; ?>

<main class="flex-1">

    <div style="background-color: #ff40b4; padding: 3rem 2rem 2.5rem;">
        <div class="max-w-7xl mx-auto">
            <p style="font-family: 'Bebas Neue', sans-serif; color: #000; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 0.5rem;">✦ FEEL FREE TO REACH OUT ✨</p>
            <h1 style="font-family: 'Bebas Neue', sans-serif; color: #fff; font-size: clamp(3rem, 10vw, 7rem); line-height: 1;">Contact</h1>
        </div>
    </div>

    <div style="background-color: #fff; padding: 2.5rem 2rem; border-bottom: 1px solid #f0f0f0;">
        <div class="max-w-4xl mx-auto">
            <p style="font-size: 1.05rem; color: #333; line-height: 1.8;">Whether it's a collaboration, an idea, or a question. Feel free to reach out to me and share a few details below.</p>
        </div>
    </div>

    <section style="background-color: #fff; padding: 5rem 2rem;">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-start">

            <div style="background-color: #000; padding: 3rem 2.5rem;">
                <h2 style="font-family: 'Bebas Neue', sans-serif; color: #fff; font-size: 2rem; margin-bottom: 2rem;">Send Inquiry</h2>

                <?php if (!empty($errors)): ?>
                <div style="background-color: #ff40b4; padding: 1rem 1.5rem; margin-bottom: 2rem;">
                    <ul style="list-style: none; padding: 0; color: #000; font-size: 0.9rem; line-height: 1.8;">
                        <?php foreach ($errors as $err): ?>
                        <li>✦ <?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <form action="/contact" method="POST" class="flex flex-col gap-5">

                    <div class="flex flex-col gap-1">
                        <label style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.8rem; letter-spacing: 0.2em;">I'M REACHING OUT FOR</label>
                        <select name="inquiry_type" style="background-color: #111; color: #fff; border: 2px solid #fff; padding: 0.75rem 1rem; font-size: 0.95rem; outline: none;" required>
                            <option value="" disabled <?= empty($post['inquiry_type']) ? 'selected' : '' ?>>— Select an option —</option>
                            <?php
                            $inquiryOptions = [
                                'Collaboration (brand / campaign / film)',
                                'Commission (custom piece)',
                                'Available work inquiry',
                                'Styling / production use (film, events, shoot)',
                                'Workshop / brand experience',
                                'Other',
                            ];
                            foreach ($inquiryOptions as $opt): ?>
                            <option value="<?= htmlspecialchars($opt) ?>" <?= ($post['inquiry_type'] ?? '') === $opt ? 'selected' : '' ?>><?= htmlspecialchars($opt) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.8rem; letter-spacing: 0.2em;">NAME</label>
                        <input type="text" name="name" placeholder="Your name" value="<?= htmlspecialchars($post['name'] ?? '') ?>"
                               style="background-color: #111; color: #fff; border: 2px solid #fff; padding: 0.75rem 1rem; font-size: 0.95rem; outline: none;" required>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.8rem; letter-spacing: 0.2em;">EMAIL</label>
                        <input type="email" name="email" placeholder="your@email.com" value="<?= htmlspecialchars($post['email'] ?? '') ?>"
                               style="background-color: #111; color: #fff; border: 2px solid #fff; padding: 0.75rem 1rem; font-size: 0.95rem; outline: none;" required>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label style="font-family: 'Bebas Neue', sans-serif; color: #aaa; font-size: 0.8rem; letter-spacing: 0.2em;">COMPANY / PROJECT <span style="color:#555;">(optional)</span></label>
                        <input type="text" name="company" placeholder="Company or project name" value="<?= htmlspecialchars($post['company'] ?? '') ?>"
                               style="background-color: #111; color: #fff; border: 2px solid #333; padding: 0.75rem 1rem; font-size: 0.95rem; outline: none;">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.8rem; letter-spacing: 0.2em;">TELL ME ABOUT YOUR PROJECT</label>
                        <p style="color: #777; font-size: 0.8rem; margin-bottom: 0.5rem;">Please describe your idea, use case, or request in detail.</p>
                        <textarea name="project" rows="5" placeholder="Describe your idea, use case or request..."
                                  style="background-color: #111; color: #fff; border: 2px solid #fff; padding: 0.75rem 1rem; font-size: 0.95rem; outline: none; resize: vertical;" required><?= htmlspecialchars($post['project'] ?? '') ?></textarea>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label style="font-family: 'Bebas Neue', sans-serif; color: #aaa; font-size: 0.8rem; letter-spacing: 0.2em;">TIMELINE <span style="color:#555;">(optional)</span></label>
                        <select name="timeline" style="background-color: #111; color: #fff; border: 2px solid #333; padding: 0.75rem 1rem; font-size: 0.95rem; outline: none;">
                            <option value="">— Select timeline —</option>
                            <?php foreach (['ASAP', '1–3 months', 'Flexible'] as $t): ?>
                            <option value="<?= $t ?>" <?= ($post['timeline'] ?? '') === $t ? 'selected' : '' ?>><?= $t ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label style="font-family: 'Bebas Neue', sans-serif; color: #aaa; font-size: 0.8rem; letter-spacing: 0.2em;">BUDGET RANGE <span style="color:#555;">(optional)</span></label>
                        <select name="budget" style="background-color: #111; color: #fff; border: 2px solid #333; padding: 0.75rem 1rem; font-size: 0.95rem; outline: none;">
                            <option value="">— Select budget —</option>
                            <?php foreach (['Under €2k', '€2k–€10k', '€10k–€25k', '€25k+', 'Not sure yet'] as $b): ?>
                            <option value="<?= $b ?>" <?= ($post['budget'] ?? '') === $b ? 'selected' : '' ?>><?= $b ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="w-full text-white text-2xl px-8 py-4 transition-all duration-200 shadow-lg mt-2"
                            style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif;"
                            onmouseover="this.style.backgroundColor='#e0359e'"
                            onmouseout="this.style.backgroundColor='#ff40b4'">SEND INQUIRY →</button>
                </form>
            </div>

            <div class="flex flex-col gap-6">
                <div style="overflow: hidden; min-height: 500px;">
                    <img src="/images/magnum selfieh.jpg" alt="Grytsje Suze" style="width: 100%; height: 100%; object-fit: cover; display: block; min-height: 500px;">
                </div>
                <p style="font-size: 0.9rem; color: #555; line-height: 1.8; font-style: italic;">Each inquiry is reviewed with care, and I'll come back to you as soon as possible.</p>
            </div>

        </div>
    </section>

</main>

<a href="/contact"
   class="fixed bottom-8 right-8 z-50 inline-flex items-center gap-2 text-black text-lg px-6 py-3 shadow-2xl transition-all duration-200"
   style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif; border-radius: 50px;"
   onmouseover="this.style.backgroundColor='#e0359e'"
   onmouseout="this.style.backgroundColor='#ff40b4'">✦ Reach Out</a>

<?php require ROOT_PATH . '/app/Views/layouts/footer.php'; ?>
</body>
</html>
