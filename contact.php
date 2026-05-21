<?php
// Userstory #5: Contact pagina met gegevens bedrijfseigenaar en contactformulier
// Userstory #8: Contact pagina bereikbaar via de navbar
// Userstory #9: Instagram link op de contact pagina
// Handle form submission
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inquiry_type = trim(htmlspecialchars($_POST['inquiry_type'] ?? '', ENT_QUOTES, 'UTF-8'));
    $name         = trim(htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8'));
    $email        = trim($_POST['email'] ?? '');
    $company      = trim(htmlspecialchars($_POST['company'] ?? '', ENT_QUOTES, 'UTF-8'));
    $project      = trim(htmlspecialchars($_POST['project'] ?? '', ENT_QUOTES, 'UTF-8'));
    $timeline     = trim(htmlspecialchars($_POST['timeline'] ?? '', ENT_QUOTES, 'UTF-8'));
    $budget       = trim(htmlspecialchars($_POST['budget'] ?? '', ENT_QUOTES, 'UTF-8'));

    // Validate required fields
    if (empty($inquiry_type)) $errors[] = 'Please select an inquiry type.';
    if (empty($name))         $errors[] = 'Name is required.';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email address is required.';
    if (empty($project))      $errors[] = 'Please describe your project or request.';

    if (empty($errors)) {
        $studioEmail = 'GrytsjeSuze@hotmail.com';
        $safeEmail   = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Notification email to studio
        $notifSubject = "New Inquiry: {$inquiry_type} – from {$name}";
        $notifBody    = "New inquiry received via the website.\n\n";
        $notifBody   .= "Type:    {$inquiry_type}\n";
        $notifBody   .= "Name:    {$name}\n";
        $notifBody   .= "Email:   {$safeEmail}\n";
        if ($company) $notifBody .= "Company: {$company}\n";
        $notifBody   .= "\nProject / Request:\n{$project}\n";
        if ($timeline) $notifBody .= "\nTimeline: {$timeline}";
        if ($budget)   $notifBody .= "\nBudget:   {$budget}";
        $notifHeaders  = "From: noreply@grytsjesuze.nl\r\n";
        $notifHeaders .= "Reply-To: {$safeEmail}\r\n";
        $notifHeaders .= "Content-Type: text/plain; charset=UTF-8\r\n";
        mail($studioEmail, $notifSubject, $notifBody, $notifHeaders);

        // Auto-reply to sender
        $replySubject = 'Thank you for your message';
        $replyBody    = "Hi {$name},\n\n"
                      . "Thank you for reaching out to me and sharing your ideas or project.\n"
                      . "I've received your inquiry and will take the time to review it carefully. "
                      . "I aim to respond as soon as possible.\n\n"
                      . "Warm regards,\n\nGrytsje Suze";
        $replyHeaders  = "From: GrytsjeSuze@hotmail.com\r\n";
        $replyHeaders .= "Content-Type: text/plain; charset=UTF-8\r\n";
        mail($safeEmail, $replySubject, $replyBody, $replyHeaders);

        header('Location: thankyou.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact — Grytsje Suze</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="./public/css/output.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen" style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">

<?php include __DIR__ . '/includes/nav.php'; ?>

<main class="flex-1">

    <!-- PAGE HEADING -->
    <div style="background-color: #ff40b4; padding: 3rem 2rem 2.5rem;">
        <div class="max-w-7xl mx-auto">
            <p style="font-family: 'Bebas Neue', sans-serif; color: #000; font-size: 0.85rem; letter-spacing: 0.3em; margin-bottom: 0.5rem;">✦ FEEL FREE TO REACH OUT ✨</p>
            <h1 style="font-family: 'Bebas Neue', sans-serif; color: #fff; font-size: clamp(3rem, 10vw, 7rem); line-height: 1;">Contact</h1>
        </div>
    </div>

    <!-- INTRO -->
    <div style="background-color: #fff; padding: 2.5rem 2rem; border-bottom: 1px solid #f0f0f0;">
        <div class="max-w-4xl mx-auto">
            <p style="font-size: 1.05rem; color: #333; line-height: 1.8;">
                Whether it's a collaboration, an idea, or a question. Feel free to reach out to me and share a few details below.
            </p>
        </div>
    </div>

    <!-- FORM + PHOTO -->
    <section style="background-color: #fff; padding: 5rem 2rem;">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-start">

            <!-- Contact Form -->
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

                <form action="contact.php" method="POST" class="flex flex-col gap-5">

                    <!-- 1. Inquiry type -->
                    <div class="flex flex-col gap-1">
                        <label style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.8rem; letter-spacing: 0.2em;">I'M REACHING OUT FOR</label>
                        <select name="inquiry_type" style="background-color: #111; color: #fff; border: 2px solid #fff; padding: 0.75rem 1rem; font-size: 0.95rem; outline: none;" required>
                            <option value="" disabled <?= empty($_POST['inquiry_type']) ? 'selected' : '' ?>>— Select an option —</option>
                            <option value="Collaboration (brand / campaign / film)" <?= ($_POST['inquiry_type'] ?? '') === 'Collaboration (brand / campaign / film)' ? 'selected' : '' ?>>Collaboration (brand / campaign / film)</option>
                            <option value="Commission (custom piece)" <?= ($_POST['inquiry_type'] ?? '') === 'Commission (custom piece)' ? 'selected' : '' ?>>Commission (custom piece)</option>
                            <option value="Available work inquiry" <?= ($_POST['inquiry_type'] ?? '') === 'Available work inquiry' ? 'selected' : '' ?>>Available work inquiry</option>
                            <option value="Styling / production use (film, events, shoot)" <?= ($_POST['inquiry_type'] ?? '') === 'Styling / production use (film, events, shoot)' ? 'selected' : '' ?>>Styling / production use (film, events, shoot)</option>
                            <option value="Workshop / brand experience" <?= ($_POST['inquiry_type'] ?? '') === 'Workshop / brand experience' ? 'selected' : '' ?>>Workshop / brand experience</option>
                            <option value="Other" <?= ($_POST['inquiry_type'] ?? '') === 'Other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>

                    <!-- 2. Name -->
                    <div class="flex flex-col gap-1">
                        <label style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.8rem; letter-spacing: 0.2em;">NAME</label>
                        <input type="text" name="name" placeholder="Your name"
                               value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                               style="background-color: #111; color: #fff; border: 2px solid #fff; padding: 0.75rem 1rem; font-size: 0.95rem; outline: none;" required>
                    </div>

                    <!-- 3. Email -->
                    <div class="flex flex-col gap-1">
                        <label style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.8rem; letter-spacing: 0.2em;">EMAIL</label>
                        <input type="email" name="email" placeholder="your@email.com"
                               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                               style="background-color: #111; color: #fff; border: 2px solid #fff; padding: 0.75rem 1rem; font-size: 0.95rem; outline: none;" required>
                    </div>

                    <!-- 4. Company / Project (optional) -->
                    <div class="flex flex-col gap-1">
                        <label style="font-family: 'Bebas Neue', sans-serif; color: #aaa; font-size: 0.8rem; letter-spacing: 0.2em;">COMPANY / PROJECT <span style="color:#555;">(optional)</span></label>
                        <input type="text" name="company" placeholder="Company or project name"
                               value="<?= htmlspecialchars($_POST['company'] ?? '') ?>"
                               style="background-color: #111; color: #fff; border: 2px solid #333; padding: 0.75rem 1rem; font-size: 0.95rem; outline: none;">
                    </div>

                    <!-- 5. Project description -->
                    <div class="flex flex-col gap-1">
                        <label style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4; font-size: 0.8rem; letter-spacing: 0.2em;">TELL ME ABOUT YOUR PROJECT</label>
                        <p style="color: #777; font-size: 0.8rem; margin-bottom: 0.5rem;">Please describe your idea, use case, or request in detail.</p>
                        <textarea name="project" rows="5" placeholder="Describe your idea, use case or request..."
                                  style="background-color: #111; color: #fff; border: 2px solid #fff; padding: 0.75rem 1rem; font-size: 0.95rem; outline: none; resize: vertical;" required><?= htmlspecialchars($_POST['project'] ?? '') ?></textarea>
                    </div>

                    <!-- 6. Timeline (optional) -->
                    <div class="flex flex-col gap-1">
                        <label style="font-family: 'Bebas Neue', sans-serif; color: #aaa; font-size: 0.8rem; letter-spacing: 0.2em;">TIMELINE <span style="color:#555;">(optional)</span></label>
                        <select name="timeline" style="background-color: #111; color: #fff; border: 2px solid #333; padding: 0.75rem 1rem; font-size: 0.95rem; outline: none;">
                            <option value="">— Select timeline —</option>
                            <option value="ASAP" <?= ($_POST['timeline'] ?? '') === 'ASAP' ? 'selected' : '' ?>>ASAP</option>
                            <option value="1–3 months" <?= ($_POST['timeline'] ?? '') === '1–3 months' ? 'selected' : '' ?>>1–3 months</option>
                            <option value="Flexible" <?= ($_POST['timeline'] ?? '') === 'Flexible' ? 'selected' : '' ?>>Flexible</option>
                        </select>
                    </div>

                    <!-- 7. Budget range (optional) -->
                    <div class="flex flex-col gap-1">
                        <label style="font-family: 'Bebas Neue', sans-serif; color: #aaa; font-size: 0.8rem; letter-spacing: 0.2em;">BUDGET RANGE <span style="color:#555;">(optional)</span></label>
                        <select name="budget" style="background-color: #111; color: #fff; border: 2px solid #333; padding: 0.75rem 1rem; font-size: 0.95rem; outline: none;">
                            <option value="">— Select budget —</option>
                            <option value="Under €2k" <?= ($_POST['budget'] ?? '') === 'Under €2k' ? 'selected' : '' ?>>Under €2k</option>
                            <option value="€2k–€10k" <?= ($_POST['budget'] ?? '') === '€2k–€10k' ? 'selected' : '' ?>>€2k–€10k</option>
                            <option value="€10k–€25k" <?= ($_POST['budget'] ?? '') === '€10k–€25k' ? 'selected' : '' ?>>€10k–€25k</option>
                            <option value="€25k+" <?= ($_POST['budget'] ?? '') === '€25k+' ? 'selected' : '' ?>>€25k+</option>
                            <option value="Not sure yet" <?= ($_POST['budget'] ?? '') === 'Not sure yet' ? 'selected' : '' ?>>Not sure yet</option>
                        </select>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full text-white text-2xl px-8 py-4 transition-all duration-200 shadow-lg mt-2"
                            style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif;"
                            onmouseover="this.style.backgroundColor='#e0359e'"
                            onmouseout="this.style.backgroundColor='#ff40b4'">SEND INQUIRY →</button>

                </form>
            </div>

            <!-- Photo placeholder + info -->
            <div class="flex flex-col gap-6">
                <!-- Photo -->
                <div style="overflow: hidden; min-height: 500px;">
                    <img src="./images/magnum selfieh.jpg" alt="Grytsje Suze" style="width: 100%; height: 100%; object-fit: cover; display: block; min-height: 500px;">
                </div>
                <!-- Footer note -->
                <p style="font-size: 0.9rem; color: #555; line-height: 1.8; font-style: italic;">
                    Each inquiry is reviewed with care, and I'll come back to you as soon as possible.
                </p>

                <!-- Instagram -->
                <a href="https://www.instagram.com/grytsjesuze" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-3 text-black transition-opacity duration-200"
                   style="text-decoration: none;"
                   onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                    <!-- Instagram icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                         style="width: 28px; height: 28px; flex-shrink: 0;">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                        <circle cx="12" cy="12" r="4"/>
                        <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
                    </svg>
                    <span style="font-family: 'Bebas Neue', sans-serif; font-size: 1.4rem; letter-spacing: 0.1em;">@grytsjesuze</span>
                </a>
            </div>

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

</body>
</html>

