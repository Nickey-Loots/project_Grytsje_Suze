<?php
// Userstory #4: Verwerkt het formulier voor het toevoegen van een nieuw product en slaat het op in de database
include 'auth.php';
$host = 'localhost';
$db = 'grytsje suze';
$user = 'bitacademy';
$pass = 'bitacademy';
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if (isset($_POST['submit'])) {
    $naam = $_POST['naam'];
    $beschrijving = $_POST['beschrijving'];
    $kleurcode = $_POST['kleurcode'];

    // Foto
    $foto_naam = time() . '_' . basename($_FILES['afbeelding']['name']);
    move_uploaded_file($_FILES['afbeelding']['tmp_name'], "../uploads/" . $foto_naam);
    $foto_db = "uploads/" . $foto_naam;

    $sql = "INSERT INTO tassen (naam, beschrijving, afbeelding, kleurcode) VALUES (?, ?, ?, ?)";
    $pdo->prepare($sql)->execute([$naam, $beschrijving, $foto_db, $kleurcode]);
    header("Location: index.php");
}
