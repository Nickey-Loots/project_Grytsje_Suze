<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="./public/css/output.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen" style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">

    <!-- Navbar -->
    <header class="px-4 md:px-8 py-4 flex items-center justify-between" style="background-color: #000;">
        <nav class="text-white flex-1 flex justify-end text-2xl md:text-5xl md:pr-24" style="font-family: 'Bebas Neue', sans-serif;"><a href="portfolio.php" class="text-white">Portfolio</a></nav>
        <div class="flex-shrink-0 flex items-center justify-center px-3 md:px-8">
            <a href="index.php"><img src="./images/groot logo wit.png" alt="GS Grytsje Suze Logo" class="h-16 md:h-28 w-auto"></a>
        </div>
        <nav class="text-white flex-1 flex justify-start text-2xl md:text-5xl md:pl-24" style="font-family: 'Bebas Neue', sans-serif;"><a href="contact.php" class="text-white">Contact Me</a></nav>
    </header>

    <!-- Main -->
    <main class="flex-1 px-4 md:px-8 py-6 md:py-8">

        <!-- Heading banner -->
        <div class="mb-6 md:mb-8 flex justify-start items-center max-w-7xl mx-auto">
            <div class="flex items-center px-4 md:px-6 pt-4 md:pt-6 pb-2 md:pb-3" style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif; letter-spacing: 0.05em;">
                <span class="text-white" style="font-size: clamp(2rem, 8vw, 4.5rem); line-height: 1;">GET IN TOUCH</span>
            </div>
        </div>

        <!-- Contact section -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">

            <!-- Contact form -->
            <div class="p-6 md:p-8" style="background-color: #000;">
                <h2 class="text-2xl mb-6 text-white" style="font-family: 'Bebas Neue', sans-serif;">Send a Message</h2>
                <form action="" method="POST" class="flex flex-col gap-4">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-bold text-white">Name</label>
                        <input type="text" name="name" placeholder="Your name" class="border-2 border-white px-4 py-2 outline-none focus:border-pink-500" style="background-color: #111; color: #fff;">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-bold text-white">Email</label>
                        <input type="email" name="email" placeholder="your@email.com" class="border-2 border-white px-4 py-2 outline-none focus:border-pink-500" style="background-color: #111; color: #fff;">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-bold text-white">Message</label>
                        <textarea name="message" rows="5" placeholder="Your message..." class="border-2 border-white px-4 py-2 outline-none focus:border-pink-500 resize-none" style="background-color: #111; color: #fff;"></textarea>
                    </div>
                    <button type="submit" class="text-white text-2xl px-8 py-4 transition-all duration-200 shadow-lg" style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif;" onmouseover="this.style.backgroundColor='#e0359e'" onmouseout="this.style.backgroundColor='#ff40b4'">SEND MESSAGE</button>
                </form>
            </div>

            <!-- Contact info -->
            <div class="flex flex-col gap-6 justify-center px-6 md:px-8 py-6 md:py-8" style="background-color: #ff40b4;">
                <div>
                    <p class="text-3xl md:text-5xl mb-2 text-white flex items-center gap-3" style="font-family: 'Bebas Neue', sans-serif;"><i class="fa-solid fa-envelope"></i> Email</p>
                    <p class="text-white">GrytsjeSuze@hotmail.com</p>
                </div>
                <a href="https://www.instagram.com/grytsjesuze/" target="_blank" class="block hover:opacity-80 transition-opacity">
                    <p class="text-3xl md:text-5xl mb-2 text-white flex items-center gap-3" style="font-family: 'Bebas Neue', sans-serif;"><i class="fa-brands fa-instagram"></i> Instagram</p>
                    <p class="text-white hover:underline">@grytsjesuze</p>
                </a>
                <div>
                    <p class="text-3xl md:text-5xl mb-2 text-white flex items-center gap-3" style="font-family: 'Bebas Neue', sans-serif;"><i class="fa-brands fa-facebook"></i> Facebook</p>
                    <p class="text-white">@grytsjesuze</p>
                </div>
                <div>
                    <p class="text-3xl md:text-5xl mb-2 text-white flex items-center gap-3" style="font-family: 'Bebas Neue', sans-serif;"><i class="fa-solid fa-location-dot"></i> Location</p>
                    <p class="text-white">The Netherlands</p>
                </div>
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

</body>
</html>