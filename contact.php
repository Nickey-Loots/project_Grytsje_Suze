<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="./public/css/output.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen" style="font-family: 'Helvetica World', Helvetica, Arial, sans-serif;">

    <!-- Navbar -->
    <header class="px-8 py-4 flex items-center justify-between">
        <nav class="text-gray-700 flex-1 flex justify-end pr-100 text-5xl" style="font-family: 'Bebas Neue', sans-serif;"><a href="portfolio.php">Portfolio</a></nav>
        <div class="flex-shrink-0 flex items-center justify-center">
            <a href="index.php"><img src="./images/GS Grytsje Suze Logo goed-01.png" alt="GS Grytsje Suze Logo" class="h-28 w-auto"></a>
        </div>
        <nav class="text-gray-700 flex-1 flex justify-start pl-100 text-5xl" style="font-family: 'Bebas Neue', sans-serif;"><a href="contact.php">Contact Me</a></nav>
    </header>

    <!-- Main -->
    <main class="flex-1 px-8 py-8">

        <!-- Heading banner -->
        <div class="mb-8 flex justify-start items-center max-w-7xl mx-auto">
            <div class="flex items-center px-6 pt-6 pb-3" style="background-color: #ff40b4; font-family: 'Bebas Neue', sans-serif; letter-spacing: 0.05em;">
                <span class="text-white" style="font-size: 4.5rem; line-height: 1;">GET IN TOUCH</span>
            </div>
        </div>

        <!-- Contact section -->
        <div class="max-w-7xl mx-auto grid grid-cols-2 gap-8">

            <!-- Contact form -->
            <div class="p-8" style="background-color: #000;">
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
            <div class="flex flex-col gap-6 justify-center px-8 py-8" style="background-color: #ff40b4;">
                <div>
                    <p class="text-5xl mb-2 text-white" style="font-family: 'Bebas Neue', sans-serif;">Email</p>
                    <p class="text-white">GrytsjeSuze@hotmail.com</p>
                </div>
                <div>
                    <p class="text-5xl mb-2 text-white" style="font-family: 'Bebas Neue', sans-serif;">Instagram</p>
                    <p class="text-white">@grytsjesuze</p>
                </div>
                <div>
                    <p class="text-5xl mb-2 text-white" style="font-family: 'Bebas Neue', sans-serif;">Facebook</p>
                    <p class="text-white">@grytsjesuze</p>
                </div>
                <div>
                    <p class="text-5xl mb-2 text-white" style="font-family: 'Bebas Neue', sans-serif;">Location</p>
                    <p class="text-white">The Netherlands</p>
                </div>
            </div>

        </div>
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