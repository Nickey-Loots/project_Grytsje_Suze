<?php
session_start();

// Controleer of de sessie variabele bestaat
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
