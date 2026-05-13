<?php

session_start();

// Als de gebruiker al is ingelogd, stuur ze direct door naar het dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Database verbinding
$host = 'localhost';
$db = 'grytsje suze';
$user = 'bitacademy';
$pass = 'bitacademy';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (\PDOException $e) {
    die("Verbinding mislukt.");
}


$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['wachtwoord'])) {
        // Sessie variabelen instellen
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_rol'] = $user['rol'];

        header("Location: index.php");
        exit;
    } else {
        $error = "Onjuist e-mailadres of wachtwoord.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Login - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-2xl w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Admin Login</h1>
            <p class="text-gray-500">Log in om tassen te beheren</p>
        </div>

        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700">E-mailadres</label>
                <input type="email" name="email" required
                    class="w-full mt-1 border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700">Wachtwoord</label>
                <input type="password" name="password" required
                    class="w-full mt-1 border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-md transition">
                Inloggen
            </button>
        </form>
    </div>
</body>

</html>