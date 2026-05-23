<?php
$currentPath = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') ?: '/';
function navLink(string $href, string $label, string $current): string {
    $isActive = ($current === $href || (strlen($href) > 1 && str_starts_with($current, $href)));
    $activeStyle = $isActive ? 'color:#ff40b4;' : '';
    return '<a href="' . $href . '" style="' . $activeStyle . '" class="text-white tracking-widest hover:text-pink-400 transition-colors duration-200">' . $label . '</a>';
}
?>
<div class="relative" style="padding-top: 50px; margin-top: 5px;">

    <!-- Logo bump -->
    <div style="
        position: absolute;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 190px;
        height: 100px;
        background-color: #000;
        border-radius: 95px 95px 0 0;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding-bottom: 2px;
        z-index: 20;
    ">
        <a href="/">
            <img src="/images/groot logo wit.png" alt="GS Grytsje Suze Logo" style="height: 96px; width: auto;">
        </a>
    </div>

    <!-- Desktop black bar -->
    <header style="background-color: #000; height: 75px; position: relative; z-index: 10;" class="flex items-center justify-between px-4 md:px-10">

        <!-- Left nav: About / Work / Collaborations -->
        <nav class="hidden md:flex items-center gap-6 lg:gap-10" style="font-family: 'Bebas Neue', sans-serif; font-size: 1.1rem;">
            <?= navLink('/about', 'About', $currentPath) ?>
            <?= navLink('/portfolio', 'Work', $currentPath) ?>
            <?= navLink('/collaborations', 'Collaborations', $currentPath) ?>
        </nav>

        <!-- Spacer for logo bump -->
        <div class="hidden md:block" style="width: 200px; flex-shrink: 0;"></div>

        <!-- Right nav: Commissions / News / Contact -->
        <nav class="hidden md:flex items-center gap-6 lg:gap-10" style="font-family: 'Bebas Neue', sans-serif; font-size: 1.1rem;">
            <?= navLink('/commissions', 'Commissions', $currentPath) ?>
            <?= navLink('/news', 'News', $currentPath) ?>
            <?= navLink('/contact', 'Contact', $currentPath) ?>
        </nav>

        <!-- Mobile: hamburger -->
        <button
            class="md:hidden text-white ml-auto"
            onclick="document.getElementById('mob-menu').classList.toggle('hidden')"
            aria-label="Toggle menu"
            style="z-index: 30; position: relative;">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

    </header>

    <!-- Mobile dropdown menu -->
    <div id="mob-menu" class="hidden" style="background-color: #111; padding: 1.5rem 2rem; position: relative; z-index: 15;">
        <nav class="flex flex-col gap-5" style="font-family: 'Bebas Neue', sans-serif;">
            <a href="/about" class="text-white text-2xl tracking-widest hover:text-pink-400 transition-colors">About</a>
            <a href="/portfolio" class="text-white text-2xl tracking-widest hover:text-pink-400 transition-colors">Work</a>
            <a href="/collaborations" class="text-white text-2xl tracking-widest hover:text-pink-400 transition-colors">Collaborations</a>
            <a href="/commissions" class="text-white text-2xl tracking-widest hover:text-pink-400 transition-colors">Commissions</a>
            <a href="/news" class="text-white text-2xl tracking-widest hover:text-pink-400 transition-colors">News</a>
            <a href="/contact" class="text-white text-2xl tracking-widest hover:text-pink-400 transition-colors">Contact</a>
        </nav>
    </div>

</div>
