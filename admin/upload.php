<?php
include 'auth.php';
include '../includes/db.php';
include 'functions.php';

if (isset($_POST['submit'])) {
    $foto_naam = time() . '_' . basename($_FILES['afbeelding']['name']);
    move_uploaded_file($_FILES['afbeelding']['tmp_name'], "../uploads/" . $foto_naam);
    $foto_db = "uploads/" . $foto_naam;

    $model_db = '';
    if (isset($_FILES['model_3d']) && $_FILES['model_3d']['error'] === 0) {
        $model_naam = time() . '_' . basename($_FILES['model_3d']['name']);
        move_uploaded_file($_FILES['model_3d']['tmp_name'], "../uploads/" . $model_naam);
        $model_db = "uploads/" . $model_naam;
    }

    createTas(
        $pdo,
        $_POST['naam'],
        $_POST['beschrijving'],
        $foto_db,
        $_POST['kleurcode'],
        $model_db,
        $_POST['tekstkleur'] ?? '#000000',
        $_POST['titelkleur'] ?? '#000000'
    );

    header("Location: index.php");
    exit;
}