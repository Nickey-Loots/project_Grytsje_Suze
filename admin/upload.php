<?php
include 'auth.php';
$host = 'localhost';
$db = 'grytsje suze';
$user = 'bit_academy';
$pass = 'bit_academy';
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if (isset($_POST['submit'])) {
    $naam = $_POST['naam'];
    $beschrijving = $_POST['beschrijving'];
    $kleurcode = $_POST['kleurcode'];
    $tekst_kleur = $_POST['tekst_kleur'];
    $titel_kleur = $_POST['titel_kleur'];

    // Foto
    $foto_naam = time() . '_' . basename($_FILES['afbeelding']['name']);
    move_uploaded_file($_FILES['afbeelding']['tmp_name'], "../uploads/" . $foto_naam);
    $foto_db = "uploads/" . $foto_naam;

    // 3D Model
    $model_db = null;
    if (isset($_FILES['model_3d']) && $_FILES['model_3d']['error'] === 0) {
        $model_naam = time() . '_' . basename($_FILES['model_3d']['name']);
        move_uploaded_file($_FILES['model_3d']['tmp_name'], "../uploads/" . $model_naam);
        $model_db = "uploads/" . $model_naam;
    }

    $sql = "INSERT INTO tassen (naam, beschrijving, afbeelding, kleurcode, model_3d, tekst_kleur, titel_kleur) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $pdo->prepare($sql)->execute([$naam, $beschrijving, $foto_db, $kleurcode, $model_db, $tekst_kleur, $titel_kleur]);
    header("Location: index.php");
}