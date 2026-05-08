<?php
include 'auth.php';

$host = 'localhost';
$db = 'grytsje suze';
$user = 'bit_academy';
$pass = 'bit_academy';
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (\PDOException $e) {
    die("Database verbinding mislukt: " . $e->getMessage());
}

if (isset($_POST['submit'])) {
    $naam = $_POST['naam'];
    $beschrijving = $_POST['beschrijving'];
    $kleurcode = $_POST['kleurcode'];

    $unieke_naam = time() . '_' . basename($_FILES['afbeelding']['name']);
    $doel_pad = "../uploads/" . $unieke_naam;

    if (move_uploaded_file($_FILES['afbeelding']['tmp_name'], $doel_pad)) {
        $db_pad = "uploads/" . $unieke_naam;
        $sql = "INSERT INTO tassen (naam, beschrijving, afbeelding, kleurcode) VALUES (:naam, :beschrijving, :afbeelding, :kleurcode)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':naam' => $naam, ':beschrijving' => $beschrijving, ':afbeelding' => $db_pad, ':kleurcode' => $kleurcode]);
        header("Location: index.php");
        exit;
    }
}
?>