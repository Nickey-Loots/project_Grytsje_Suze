<?php

include 'auth.php';
include '../includes/db.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Veiligheid: zorg dat we geen owners verwijderen via de URL
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id AND rol != 'owner'");
    $stmt->execute([':id' => $id]);
}

header("Location: gebruikers.php");
exit;
