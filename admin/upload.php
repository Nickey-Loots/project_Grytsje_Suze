<?php

include 'auth.php';

// Database instellingen
$host = 'localhost';
$db = 'grytsje suze';
$user = 'bit_academy';
$pass = 'bit_academy';
$charset = 'utf8mb4';

// Data Source Name (DSN) instellen
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Goede standaard opties voor PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Gooit exceptions bij fouten
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Haalt data standaard op als associatieve array
    PDO::ATTR_EMULATE_PREPARES => false,                  // Gebruikt echte prepared statements van de database
];

// Verbinding maken
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Stop het script als de databaseverbinding mislukt
    die("Database verbinding mislukt: " . $e->getMessage());
}

// Controleren of het formulier is verzonden
if (isset($_POST['submit'])) {
    $naam = $_POST['naam'];
    $beschrijving = $_POST['beschrijving'];

    // Afbeelding informatie
    $bestandsnaam = $_FILES['afbeelding']['name'];
    $tijdelijke_locatie = $_FILES['afbeelding']['tmp_name'];
    $doel_map = "../uploads/";

    // Unieke naam maken voor de afbeelding om overschrijven te voorkomen (en veiliger te maken met basename)
    $unieke_naam = time() . '_' . basename($bestandsnaam);
    $volledige_pad = $doel_map . $unieke_naam;

    // 1. Verplaats de afbeelding naar de map 'uploads/'
    if (move_uploaded_file($tijdelijke_locatie, $volledige_pad)) {

        // 2. Sla de gegevens op in de database via PDO
        $sql = "INSERT INTO tassen (naam, beschrijving, afbeelding) VALUES (:naam, :beschrijving, :afbeelding)";
        $stmt = $pdo->prepare($sql);

        try {
            // Execute de query met named parameters om SQL injection te voorkomen
            $stmt->execute([
                ':naam' => $naam,
                ':beschrijving' => $beschrijving,
                ':afbeelding' => $volledige_pad
            ]);

            // Succes, stuur de gebruiker terug naar het overzicht
            header("Location: index.php");
            exit; // Belangrijk: stop verdere uitvoering van dit script na een redirect

        } catch (PDOException $e) {
            echo "Fout bij opslaan in database: " . $e->getMessage();
        }

    } else {
        echo "Fout bij het uploaden van de afbeelding. Controleer of de map 'uploads' bestaat en schrijfbaar is.";
    }
}
?>