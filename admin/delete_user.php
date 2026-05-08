<?php
// Database verbinding (pas je gegevens aan)
$host = 'localhost';
$db = 'grytsje suze';
$user = 'bit_academy';
$pass = 'bit_academy';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database verbinding mislukt: " . $e->getMessage());
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Veiligheid: zorg dat we geen owners verwijderen via de URL
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id AND rol != 'owner'");
    $stmt->execute([':id' => $id]);
}

header("Location: gebruikers.php");
exit;