<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="./public/css/output.css" rel="stylesheet">
</head>
<body style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">
    <!-- Mobile Sidebar Nav (only on mobile) -->
    <div class="md:hidden fixed left-0 top-0 h-full w-20 z-50 flex flex-col items-center justify-between py-8" style="background-color: #000;">
        <a href="portfolio.php" class="text-white text-sm" style="font-family: 'Bebas Neue', sans-serif; writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing: 0.12em;">Portfolio</a>
        <a href="index.php">
            <img src="./images/Groot logo wit.png" alt="Logo" class="h-auto" style="width: 180px; transform: rotate(-90deg);">
        </a>
        <a href="contact.php" class="text-white text-sm" style="font-family: 'Bebas Neue', sans-serif; writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing: 0.12em;">Contact Me</a>
    </div>
    <!-- Page wrapper: offset on mobile for sidebar -->
    <div class="flex flex-col min-h-screen pl-20 md:pl-0">
        <!-- Desktop Navbar -->
        <header class="hidden md:flex px-8 py-4 items-center justify-between" style="background-color: #000;">
            <nav class="text-white flex-1 flex justify-end text-4xl pr-24 mt-12" style="font-family: 'Bebas Neue', sans-serif;"><a href="portfolio.php" class="text-white">Portfolio</a></nav>
            <div class="flex-shrink-0 flex items-center justify-center px-8">
                <a href="index.php"><img src="./images/groot logo wit.png" alt="GS Grytsje Suze Logo" class="h-48 w-auto"></a>
            </div>
            <nav class="text-white flex-1 flex justify-start text-4xl pl-24 mt-12" style="font-family: 'Bebas Neue', sans-serif;"><a href="contact.php" class="text-white">Contact Me</a></nav>
        </header>
        <!-- Portfolio Items -->
        <main class="flex-1 border-t-4 border-black relative">
            <!-- Center line -->
            <div class="absolute top-0 bottom-0 left-1/2 bg-black" style="width: 4px; transform: translateX(-50%);"></div>
            <!-- Item 1: Image left, Text right -->
            <div class="flex flex-row border-b-4 border-black" style="min-height: 280px;">
                <div class="w-1/2 overflow-hidden">
                    <img src="./images/heartbagduo.jpg" alt="Heart Handle Bags" class="w-full h-full object-cover">
                </div>
                <div class="w-1/2 flex flex-col justify-center p-4 md:p-12">
                    <h2 class="text-xl md:text-4xl font-bold mb-2 md:mb-4" style="font-family: 'Bebas Neue', sans-serif;">Heart Handle Bags</h2>
                    <p class="text-xs md:text-base text-gray-700">Handmade heart handle bags crafted with love and precision. Each bag features unique heart-shaped handles that make a bold fashion statement.</p>
                </div>
            </div>
            <!-- Item 2: Text left, Image right -->
            <div class="flex flex-row-reverse border-b-4 border-black" style="min-height: 280px;">
                <div class="w-1/2 overflow-hidden">
                    <img src="./images/geometric-bag.jpg" alt="Geometric Bag" class="w-full h-full object-cover">
                </div>
                <div class="w-1/2 flex flex-col justify-center p-4 md:p-12">
                    <h2 class="text-xl md:text-4xl font-bold mb-2 md:mb-4" style="font-family: 'Bebas Neue', sans-serif;">Geometric Bag</h2>
                    <p class="text-xs md:text-base text-gray-700">A bold geometric design that merges art with functionality. This structured bag is perfect for those who appreciate clean lines and modern aesthetics.</p>
                </div>
            </div>

            <!-- Item 3: Image left, Text right -->
            <div class="flex flex-row border-b-4 border-black" style="min-height: 280px;">
                <div class="w-1/2 overflow-hidden">
                    <img src="./images/swirl-bag.jpg" alt="Swirl Bag" class="w-full h-full object-cover">
                </div>
                <div class="w-1/2 flex flex-col justify-center p-4 md:p-12">
                    <h2 class="text-xl md:text-4xl font-bold mb-2 md:mb-4" style="font-family: 'Bebas Neue', sans-serif;">Swirl Bag</h2>
                    <p class="text-xs md:text-base text-gray-700">Inspired by flowing movement, the swirl bag features mesmerizing patterns that catch the eye from every angle.</p>
                </div>
            </div>
            <!-- Item 4: Text left, Image right -->
            <div class="flex flex-row-reverse border-b-4 border-black" style="min-height: 280px;">
                <div class="w-1/2 overflow-hidden">
                    <img src="./images/worker-bag.jpg" alt="Worker Bag" class="w-full h-full object-cover">
                </div>
                <div class="w-1/2 flex flex-col justify-center p-4 md:p-12">
                    <h2 class="text-xl md:text-4xl font-bold mb-2 md:mb-4" style="font-family: 'Bebas Neue', sans-serif;">Worker Bag</h2>
                    <p class="text-xs md:text-base text-gray-700">Built for the everyday creative. This spacious bag combines practical design with artistic flair, making it perfect for work and play.</p>
                </div>
            </div>

            <!-- Item 5: Image left, Text right -->
            <div class="flex flex-row border-b-4 border-black" style="min-height: 280px;">
                <div class="w-1/2 overflow-hidden">
                    <img src="./images/oogtas.png" alt="Eye Bag" class="w-full h-full object-cover">
                </div>
                <div class="w-1/2 flex flex-col justify-center p-4 md:p-12">
                    <h2 class="text-xl md:text-4xl font-bold mb-2 md:mb-4" style="font-family: 'Bebas Neue', sans-serif;">Eye Bag</h2>
                    <p class="text-xs md:text-base text-gray-700">A statement piece with an eye-catching design. This unique bag is guaranteed to turn heads wherever you go.</p>
                </div>
            </div>

            <!-- Item 6: Text left, Image right -->
            <div class="flex flex-row-reverse" style="min-height: 280px;">
                <div class="w-1/2 overflow-hidden">
                    <img src="./images/heartbagpink.jpg" alt="Pink Heart Bag" class="w-full h-full object-cover">
                </div>
                <div class="w-1/2 flex flex-col justify-center p-4 md:p-12">
                    <h2 class="text-xl md:text-4xl font-bold mb-2 md:mb-4" style="font-family: 'Bebas Neue', sans-serif;">Pink Heart Bag</h2>
                    <p class="text-xs md:text-base text-gray-700">A soft pink tone meets the iconic heart design. This bag radiates warmth and charm, perfect for any occasion.</p>
                </div>
            </div>

        </main>

        <!-- Footer -->
        <footer class="border-t border-gray-300 px-4 md:px-8 py-4 flex flex-col md:flex-row items-center justify-between gap-3">
            <div><a href="index.php"><img src="./images/GS Grytsje Suze Logo goed-02.png" alt="GS Grytsje Suze Logo 02" class="h-12 w-auto"></a></div>
            <nav class="flex gap-6 text-sm text-gray-700">
                <a href="#" class="hover:underline">Text</a>
                <a href="#" class="hover:underline">Text</a>
                <a href="#" class="hover:underline">Text</a>
            </nav>
        </footer>
    </div>
</body>
</html>
