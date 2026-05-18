<?php
include 'auth.php';
include '../includes/db.php';
include 'functions.php';

if (isset($_GET['id'])) {
    deleteUser($pdo, (int) $_GET['id']);
}

header("Location: gebruikers.php");
exit;