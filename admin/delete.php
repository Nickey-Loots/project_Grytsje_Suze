<?php
include 'auth.php';
include '../includes/db.php';
include 'functions.php';

if (isset($_GET['id'])) {
    $afbeelding = deleteTas($pdo, (int) $_GET['id']);

    if ($afbeelding !== null) {
        $imagePath = "../" . $afbeelding;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}

header("Location: index.php");
exit;