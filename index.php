<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="./public/css/output.css" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen" style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">
    <!-- Navbar wrapper: white top space + black bar -->
    <div class="relative" style="padding-top: 50px; margin-top: 5px;">
        <!-- Logo bump: rises UP above the black bar into the white space -->
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
            z-index: 10;
        ">
            <a href="index.php">
                <img src="./images/groot logo wit.png" alt="GS Grytsje Suze Logo" style="height: 96px; width: auto;">
            </a>
        </div>

        <!-- Black bar -->
        <header class="flex items-center justify-between px-6 md:px-16" style="background-color: #000; height: 75px;">
            <nav style="font-family: 'Bebas Neue', sans-serif;">
                <a href="portfolio.php" class="text-white text-xl md:text-3xl tracking-widest hover:text-pink-400 transition-colors">Portfolio</a>
            </nav>
            <!-- spacer so text doesn't overlap logo bump -->
            <div style="width: 160px; flex-shrink: 0;"></div>
            <nav style="font-family: 'Bebas Neue', sans-serif;">
                <a href="contact.php" class="text-white text-xl md:text-3xl tracking-widest hover:text-pink-400 transition-colors">Contact Me</a>
            </nav>
        </header>
    </div>

    <!-- Mobile hero banner -->
    <div class="md:hidden w-full flex items-center px-4 py-3" style="background-color: #ff40b4;">
        <span class="text-white text-3xl tracking-widest" style="font-family: 'Bebas Neue', sans-serif;">HANDMADE BAGS</span>
    </div>

    <!-- Main -->
    <main class="flex-1 px-4 md:px-8 py-4 md:py-8">

        <!-- Mobile layout: 2 stacked photos + button -->
        <div class="flex flex-col gap-4 mb-4 md:hidden">
            <div class="overflow-hidden border-4 border-black" style="height: 280px;">
                <img src="./images/heartbagduo.jpg" alt="Heart handle bags" class="w-full h-full object-cover">
            </div>
            <div class="overflow-hidden border-4 border-black" style="height: 280px;">
                <img src="./images/geometric-bag.jpg" alt="Geometric bag" class="w-full h-full object-cover">
            </div>
            <a href="portfolio.php">
                <button class="w-full text-white text-2xl py-5 transition-all duration-200 shadow-lg" style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif;" onmouseover="this.style.backgroundColor='#e0359e'" onmouseout="this.style.backgroundColor='#ff40b4'">SHOW MORE</button>
            </a>
        </div>

        <!-- Desktop layout: image grid -->
        <div class="hidden md:grid grid-cols-2 gap-2 mx-auto mb-8" style="height: 1100px; max-width: 1600px;">

            <!-- links: één large image -->
            <div class="rounded overflow-hidden border-4 border-black" style="height: 1100px;">
                <img src="./images/heartbagduo.jpg" alt="Heart handle bags" class="w-full h-full object-cover">
            </div>

            <!-- rechts: stacked images -->
            <div class="flex flex-col gap-2" style="height: 1100px;">

                <!-- rechts boven: large image -->
                <div class="rounded overflow-hidden border-4 border-black" style="height: 550px;">
                    <img src="./images/geometric-bag.jpg" alt="Geometric bag" class="w-full h-full object-cover">
                </div>

                <!-- rechts onder: twee columns -->
                <div class="flex gap-2" style="height: 542px;">
                    <div class="flex-1 rounded overflow-hidden border-4 border-black">
                        <img src="./images/worker-bag.jpg" alt="Worker bag" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 rounded overflow-hidden relative border-4 border-black">
                        <img src="./images/swirl-bag.jpg" alt="Swirl bag" class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex flex-col justify-center items-center gap-4 bg-gradient-to-t from-black/50 to-transparent">
                            <p class="text-xs text-white">Text</p>
                            <button class="text-white text-2xl px-12 py-6 rounded-xl transition-all duration-200 shadow-lg hover:opacity-100" style="background-color: #ff40b4; opacity: 0.85; font-family: 'Bebas Neue', sans-serif;" onmouseover="this.style.backgroundColor='#e0359e'" onmouseout="this.style.backgroundColor='#ff40b4'">SHOW MORE</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- About Me Section -->
        <section class="mt-8 md:mt-12">
            <!-- Top colour bar -->
            <div class="-mx-4 md:-mx-8 mb-6" style="height: 5px; background-color: #ff40b4;"></div>

            <div class="max-w-3xl mx-auto px-2 md:px-0">
                <h2 class="text-4xl md:text-6xl mb-4" style="font-family: 'Bebas Neue', sans-serif; color: #ff40b4;">About Me</h2>
                <p class="text-base md:text-lg text-gray-700 leading-relaxed">
                    Grytsje believes that the value of design is born in the concept: the idea, the form, and the meaning.
                    By collaborating with specialised partners, she realises designs at the highest level — without
                    compromising creative integrity.
                    <span id="about-more" class="hidden">
                        In the long term, she positions herself as an international designer at the intersection of art,
                        design, and functionality within fashion, film, and brand concepts.
                    </span>
                </p>
                <button
                    id="read-more-btn"
                    onclick="document.getElementById('about-more').classList.toggle('hidden'); this.textContent = this.textContent === 'READ MORE' ? 'READ LESS' : 'READ MORE';"
                    class="mt-4 text-white text-lg px-8 py-3 transition-all duration-200 shadow"
                    style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif;"
                    onmouseover="this.style.backgroundColor='#e0359e'"
                    onmouseout="this.style.backgroundColor='#ff40b4'">READ MORE</button>
            </div>

            <!-- Bottom colour bar -->
            <div class="-mx-4 md:-mx-8 mt-6" style="height: 5px; background-color: #ff40b4;"></div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="border-t-4 border-black px-4 md:px-8 py-4 flex flex-col md:flex-row items-center justify-between gap-3">
        <div><a href="index.php"><img src="./images/GS Grytsje Suze Logo goed-02.png" alt="GS Grytsje Suze Logo 02" class="h-12 w-auto"></a></div>
        <nav class="hidden md:flex gap-6 text-sm text-gray-700">
            <a href="#" class="hover:underline">Text</a>
            <a href="#" class="hover:underline">Text</a>
            <a href="#" class="hover:underline">Text</a>
        </nav>
    </footer>

</body>

</html>