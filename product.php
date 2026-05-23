<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Product</title>
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

</body>

</html>
