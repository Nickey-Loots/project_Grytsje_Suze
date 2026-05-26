<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Paginakop: tekenset, viewport, lettertype en stijlbladen -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact — Grytsje Suze</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="/css/output.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen">

<!-- Navigatiebalk: ingeladen via de herbruikbare header-layout -->
<?php require ROOT_PATH . '/app/Views/layouts/header.php'; ?>

<main class="flex-1 bg-white py-16 px-8">
    <div class="max-w-2xl mx-auto">

        <!-- Paginatitel -->
        <p class="font-bebas text-brand text-[0.85rem] tracking-[0.3em] mb-2">✦ GET IN TOUCH</p>
        <h1 class="font-bebas text-[clamp(3rem,8vw,5rem)] leading-[1.05] text-black mb-10">Contact</h1>

        <!-- Foutmeldingen -->
        <?php if (!empty($errors)): ?>
            <ul class="mb-6 text-red-600 list-disc list-inside">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <!-- Contactformulier -->
        <form method="POST" action="/contact" class="flex flex-col gap-5">

            <!-- Type aanvraag -->
            <div>
                <label class="block text-sm font-semibold mb-1" for="inquiry_type">Inquiry type *</label>
                <select id="inquiry_type" name="inquiry_type" class="w-full border border-gray-300 px-4 py-3 focus:outline-none focus:border-black">
                    <option value="">Select a type</option>
                    <option value="commission" <?= ($post['inquiry_type'] ?? '') === 'commission' ? 'selected' : '' ?>>Commission</option>
                    <option value="collaboration" <?= ($post['inquiry_type'] ?? '') === 'collaboration' ? 'selected' : '' ?>>Collaboration</option>
                    <option value="other" <?= ($post['inquiry_type'] ?? '') === 'other' ? 'selected' : '' ?>>Other</option>
                </select>
            </div>

            <!-- Naam -->
            <div>
                <label class="block text-sm font-semibold mb-1" for="name">Name *</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($post['name'] ?? '') ?>"
                    class="w-full border border-gray-300 px-4 py-3 focus:outline-none focus:border-black">
            </div>

            <!-- E-mail -->
            <div>
                <label class="block text-sm font-semibold mb-1" for="email">Email *</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($post['email'] ?? '') ?>"
                    class="w-full border border-gray-300 px-4 py-3 focus:outline-none focus:border-black">
            </div>

            <!-- Bedrijf (optioneel) -->
            <div>
                <label class="block text-sm font-semibold mb-1" for="company">Company</label>
                <input type="text" id="company" name="company" value="<?= htmlspecialchars($post['company'] ?? '') ?>"
                    class="w-full border border-gray-300 px-4 py-3 focus:outline-none focus:border-black">
            </div>

            <!-- Projectomschrijving -->
            <div>
                <label class="block text-sm font-semibold mb-1" for="project">Project / Request *</label>
                <textarea id="project" name="project" rows="5"
                    class="w-full border border-gray-300 px-4 py-3 focus:outline-none focus:border-black"><?= htmlspecialchars($post['project'] ?? '') ?></textarea>
            </div>

            <!-- Tijdlijn -->
            <div>
                <label class="block text-sm font-semibold mb-1" for="timeline">Timeline</label>
                <input type="text" id="timeline" name="timeline" value="<?= htmlspecialchars($post['timeline'] ?? '') ?>"
                    class="w-full border border-gray-300 px-4 py-3 focus:outline-none focus:border-black">
            </div>

            <!-- Budget -->
            <div>
                <label class="block text-sm font-semibold mb-1" for="budget">Budget</label>
                <input type="text" id="budget" name="budget" value="<?= htmlspecialchars($post['budget'] ?? '') ?>"
                    class="w-full border border-gray-300 px-4 py-3 focus:outline-none focus:border-black">
            </div>

            <button type="submit"
                class="bg-black text-white font-bebas text-2xl px-12 py-4 hover:bg-brand transition-colors duration-200 self-start">
                Send →
            </button>
        </form>
    </div>
</main>

</body>
</html>
