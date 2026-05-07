<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="./public/css/output.css" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen" style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">
    <!-- dit is de navbar -->
    <header class="border-b border-gray-300 px-8 py-4 flex items-center justify-between">
        <nav class="text-sm text-gray-700">Text</nav>
        <div class="flex items-center justify-center">
            <img src="./images/GS Grytsje Suze Logo goed-01.png" alt="GS Grytsje Suze Logo" class="h-16 w-auto">
        </div>
        <nav class="text-sm text-gray-700">Text</nav>
    </header>
    <!-- de mainain -->
    <main class="flex-1 px-8 py-8">
        <!-- Intro text -->
        <p class="text-sm text-gray-600 mb-6">Text</p>
        <!-- Image grid -->
        <div class="grid grid-cols-2 gap-4 max-w-6xl mx-auto mb-8" style="height: 580px;">

            <!-- links: één large image -->
            <div class="rounded overflow-hidden" style="height: 580px;">
                <img src="./images/heart-bags.jpg" alt="Heart handle bags" class="w-full h-full object-cover">
            </div>

            <!-- rechts: stacked images -->
            <div class="flex flex-col gap-4" style="height: 580px;">

                <!-- rechts boven: large image -->
                <div class="rounded overflow-hidden" style="height: 290px;">
                    <img src="./images/geometric-bag.jpg" alt="Geometric bag" class="w-full h-full object-cover">
                </div>

                <!-- rechts onder: twee columns -->
                <div class="flex gap-4" style="height: 274px;">
                    <div class="flex-1 rounded overflow-hidden">
                        <img src="./images/worker-bag.jpg" alt="Worker bag" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 rounded overflow-hidden relative">
                        <img src="./images/swirl-bag.jpg" alt="Swirl bag" class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex flex-col justify-center items-center gap-4 bg-gradient-to-t from-black/50 to-transparent">
                            <p class="text-xs text-white">Text</p>
                            <button class="text-white text-lg px-8 py-4 rounded-lg transition-all duration-200 shadow-lg" style="background-color: #ff40b4; opacity: 0.85;">SHOW MORE</button>
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