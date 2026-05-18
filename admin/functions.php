<?php
// =============================================================================
// functions.php — Alle herbruikbare logica voor het admin panel
// =============================================================================
// Elke functie accepteert een $pdo parameter zodat ze testbaar zijn met
// een aparte (SQLite) testdatabase, zonder de echte DB aan te raken.
// =============================================================================


// -----------------------------------------------------------------------------
// TASSEN
// -----------------------------------------------------------------------------

/**
 * Haal alle tassen op, gesorteerd op aanmaakdatum (nieuwste eerst).
 *
 * @param  PDO   $pdo
 * @return array
 */
function getAllTassen(PDO $pdo): array
{
    $stmt = $pdo->query("SELECT * FROM tassen ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Haal één tas op via ID. Geeft null terug als de tas niet bestaat.
 *
 * @param  PDO $pdo
 * @param  int $id
 * @return array|null
 */
function getTasById(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare("SELECT * FROM tassen WHERE id = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: null;
}

/**
 * Voeg een nieuwe tas toe aan de database.
 *
 * @param  PDO    $pdo
 * @param  string $naam
 * @param  string $beschrijving
 * @param  string $afbeelding    Relatief pad, bijv. "uploads/foto.jpg"
 * @param  string $kleurcode     Hex kleurcode, bijv. "#ff40b4"
 * @param  string $model3d       Relatief pad naar .glb bestand
 * @param  string $tekstKleur    Hex kleurcode voor tekst
 * @param  string $titelKleur    Hex kleurcode voor titel
 * @return int                   Het ID van de nieuw aangemaakte tas
 */
function createTas(
    PDO    $pdo,
    string $naam,
    string $beschrijving,
    string $afbeelding,
    string $kleurcode,
    string $model3d     = '',
    string $tekstKleur  = '#000000',
    string $titelKleur  = '#000000'
): int {
    $stmt = $pdo->prepare("
        INSERT INTO tassen (naam, beschrijving, afbeelding, kleurcode, model_3d, tekst_kleur, titel_kleur)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$naam, $beschrijving, $afbeelding, $kleurcode, $model3d, $tekstKleur, $titelKleur]);
    return (int) $pdo->lastInsertId();
}

/**
 * Pas een bestaande tas aan.
 *
 * @param  PDO    $pdo
 * @param  int    $id
 * @param  string $naam
 * @param  string $beschrijving
 * @param  string $afbeelding
 * @param  string $kleurcode
 * @param  string $model3d
 * @param  string $tekstKleur
 * @param  string $titelKleur
 * @return bool                  True als er minstens 1 rij gewijzigd is
 */
function updateTas(
    PDO    $pdo,
    int    $id,
    string $naam,
    string $beschrijving,
    string $afbeelding,
    string $kleurcode,
    string $model3d     = '',
    string $tekstKleur  = '#000000',
    string $titelKleur  = '#000000'
): bool {
    $stmt = $pdo->prepare("
        UPDATE tassen
        SET naam        = ?,
            beschrijving = ?,
            afbeelding   = ?,
            kleurcode    = ?,
            model_3d     = ?,
            tekst_kleur  = ?,
            titel_kleur  = ?
        WHERE id = ?
    ");
    $stmt->execute([$naam, $beschrijving, $afbeelding, $kleurcode, $model3d, $tekstKleur, $titelKleur, $id]);
    return $stmt->rowCount() > 0;
}

/**
 * Verwijder een tas uit de database.
 * Geeft het afbeeldingspad terug zodat de aanroeper het bestand kan verwijderen.
 *
 * @param  PDO $pdo
 * @param  int $id
 * @return string|null  Pad naar de afbeelding, of null als de tas niet bestond
 */
function deleteTas(PDO $pdo, int $id): ?string
{
    // Haal het pad op vóór het verwijderen
    $stmt = $pdo->prepare("SELECT afbeelding FROM tassen WHERE id = ?");
    $stmt->execute([$id]);
    $tas = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$tas) {
        return null;
    }

    $pdo->prepare("DELETE FROM tassen WHERE id = ?")->execute([$id]);
    return $tas['afbeelding'];
}


// -----------------------------------------------------------------------------
// GEBRUIKERS
// -----------------------------------------------------------------------------

/**
 * Haal alle gebruikers op, gesorteerd op rol (owner bovenaan).
 *
 * @param  PDO   $pdo
 * @return array
 */
function getAllUsers(PDO $pdo): array
{
    $stmt = $pdo->query("SELECT id, email, rol, created_at FROM users ORDER BY rol DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Maak een nieuwe admin-gebruiker aan.
 * Het wachtwoord wordt gehasht opgeslagen.
 *
 * @param  PDO    $pdo
 * @param  string $email
 * @param  string $wachtwoord  Plaintext wachtwoord — wordt intern gehasht
 * @return int                 Het ID van de nieuwe gebruiker
 */
function createAdmin(PDO $pdo, string $email, string $wachtwoord): int
{
    $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (email, wachtwoord, rol) VALUES (?, ?, 'admin')");
    $stmt->execute([$email, $hash]);
    return (int) $pdo->lastInsertId();
}

/**
 * Verwijder een gebruiker op ID, maar nooit een owner.
 *
 * @param  PDO $pdo
 * @param  int $id
 * @return bool  True als de gebruiker verwijderd is, false als het een owner was of niet bestond
 */
function deleteUser(PDO $pdo, int $id): bool
{
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ? AND rol != 'owner'");
    $stmt->execute([$id]);
    return $stmt->rowCount() > 0;
}

/**
 * Controleer logingegevens en geef de gebruiker terug bij succes.
 *
 * @param  PDO    $pdo
 * @param  string $email
 * @param  string $wachtwoord  Plaintext wachtwoord om te verifiëren
 * @return array|null          Gebruikersrij bij succes, null bij mislukking
 */
function loginUser(PDO $pdo, string $email, string $wachtwoord): ?array
{
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($wachtwoord, $user['wachtwoord'])) {
        return $user;
    }

    return null;
}


// -----------------------------------------------------------------------------
// HULPFUNCTIES (geen database nodig — makkelijkst te testen)
// -----------------------------------------------------------------------------

/**
 * Geef een Tailwind tekstkleur-class terug die leesbaar is op de achtergrondkleur.
 * Gebruikt de YIQ-helderheidsformule.
 *
 * @param  string $hexColor  Hex kleurcode met of zonder '#'
 * @return string            'text-black' of 'text-white'
 */
function getContrastColor(string $hexColor): string
{
    $hex = ltrim($hexColor, '#');
    $r   = hexdec(substr($hex, 0, 2));
    $g   = hexdec(substr($hex, 2, 2));
    $b   = hexdec(substr($hex, 4, 2));
    $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
    return ($yiq >= 128) ? 'text-black' : 'text-white';
}