<?php

include 'auth.php';

// 1. Database verbinding (Zorg dat dit overeenkomt met je instellingen)
$host = 'localhost';
$db = 'grytsje suze';
$user = 'bitacademy';
$pass = 'bitacademy';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database verbinding mislukt: " . $e->getMessage());
}

// 2. Controleren of er een ID is meegegeven in de URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 3. Eerst de bestandsnaam van de afbeelding ophalen voordat we de rij verwijderen
    $stmt = $pdo->prepare("SELECT afbeelding FROM tassen WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $tas = $stmt->fetch();

    if ($tas) {
        $imagePath = "../" . $tas['afbeelding']; // We gaan één map omhoog vanuit /admin

        // 4. Verwijder het bestand fysiek van de server
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // 5. Verwijder de rij uit de database
        $deleteStmt = $pdo->prepare("DELETE FROM tassen WHERE id = :id");
        $deleteStmt->execute([':id' => $id]);
    }
}

// 6. Altijd terugsturen naar het overzicht
header("Location: index.php");
exit;
