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
    <!-- dit is de navbar -->
    <header class="px-8 py-4 flex items-center justify-between">
        <nav class="text-gray-700 flex-1 flex justify-end pr-100 text-5xl" style="font-family: 'Bebas Neue', sans-serif;"><a href="portfolio.php">Portfolio</a></nav>
        <div class="flex-shrink-0 flex items-center justify-center">
            <a href="index.php"><img src="./images/GS Grytsje Suze Logo goed-01.png" alt="GS Grytsje Suze Logo" class="h-28 w-auto"></a>
        </div>
        <nav class="text-gray-700 flex-1 flex justify-start pl-100 text-5xl" style="font-family: 'Bebas Neue', sans-serif;"><a href="contact.php">Contact Me</a></nav>
    </header>
    <!-- de mainain -->
    <main class="flex-1 px-8 py-8">
        <!-- Intro text -->
        <div class="mb-6 flex justify-start items-center max-w-7xl mx-auto">
            <div class="flex items-center px-6 pt-6 pb-3" style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif; letter-spacing: 0.05em; gap: 16px;">
                <span class="text-white" style="font-size: 4.5rem; line-height: 1;">TAKE A</span>
                <img src="./images/oogtas.png" alt="Oogtas" style="height: 4.5rem; width: auto; display: inline-block; position: relative; top: -10px;">
                <span class="text-white" style="font-size: 4.5rem; line-height: 1; margin-left: -8px;">IN MY WORLD</span>
            </div>
        </div>
        <!-- Image grid -->
        <div class="grid grid-cols-2 gap-2 max-w-7xl mx-auto mb-8" style="height: 800px;">

            <!-- links: één large image -->
            <div class="rounded overflow-hidden border-4 border-black" style="height: 800px;">
                <img src="./images/heart-bags.jpg" alt="Heart handle bags" class="w-full h-full object-cover">
            </div>

            <!-- rechts: stacked images -->
            <div class="flex flex-col gap-2" style="height: 800px;">

                <!-- rechts boven: large image -->
                <div class="rounded overflow-hidden border-4 border-black" style="height: 400px;">
                    <img src="./images/geometric-bag.jpg" alt="Geometric bag" class="w-full h-full object-cover">
                </div>

                <!-- rechts onder: twee columns -->
                <div class="flex gap-2" style="height: 392px;">
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

        <!-- Bottom text -->
        <p class="text-sm text-gray-600 mt-8">Text</p>

    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-300 px-8 py-4 flex items-center justify-between">
        <div class="text-sm font-bold text-gray-800">Logo</div>
        <nav class="flex gap-6 text-sm text-gray-700">
            <a href="#" class="hover:underline">Text</a>
            <a href="#" class="hover:underline">Text</a>
            <a href="#" class="hover:underline">Text</a>
        </nav>
    </footer>

</body>

</html>