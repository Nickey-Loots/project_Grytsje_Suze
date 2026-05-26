<?php
// Naamruimte en afhankelijkheden
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Tas;

// Controller voor het beheren van tassen in het admin-gedeelte
class AdminTassenController extends Controller
{
    // create(): toont het formulier voor het toevoegen van een nieuwe tas
    public function create(): void
    {
        $this->requireAuth();
        $this->render('admin/tassen-toevoegen');
    }

    // store(): verwerkt het toevoegformulier, uploadt bestanden en slaat de tas op in de database
    public function store(): void
    {
        $this->requireAuth();

        // Controleer of er een afbeelding is geüpload
        if (empty($_FILES['afbeelding']['tmp_name'])) {
            $this->redirect('/admin/tassen/toevoegen');
            return;
        }

        // Sla de afbeelding op in de uploads-map
        $fotoNaam = time() . '_' . basename($_FILES['afbeelding']['name']);
        move_uploaded_file($_FILES['afbeelding']['tmp_name'], ROOT_PATH . '/public/uploads/' . $fotoNaam);
        $fotoDB = 'uploads/' . $fotoNaam;

        // Sla het 3D-model op als dat is meegegeven
        $modelDB = '';
        if (!empty($_FILES['model_3d']['tmp_name']) && $_FILES['model_3d']['error'] === 0) {
            $modelNaam = time() . '_' . basename($_FILES['model_3d']['name']);
            move_uploaded_file($_FILES['model_3d']['tmp_name'], ROOT_PATH . '/public/uploads/' . $modelNaam);
            $modelDB = 'uploads/' . $modelNaam;
        }

        // Maak de tas aan in de database en stuur door naar het admin-overzicht
        Tas::create(
            null,
            $_POST['naam'],
            $_POST['beschrijving'],
            $fotoDB,
            $_POST['kleurcode'],
            $modelDB,
            $_POST['tekstkleur'] ?? '#000000',
            $_POST['titelkleur'] ?? '#000000'
        );

        $this->redirect('/admin');
    }

    // edit(): haalt een tas op en toont het bewerkingsformulier
    public function edit(int $id): void
    {
        $this->requireAuth();
        $tas = Tas::getById($id);
        if (!$tas) {
            $this->redirect('/admin');
            return;
        }
        $this->render('admin/tassen-edit', ['tas' => $tas]);
    }

    // update(): verwerkt het bewerkingsformulier en slaat de gewijzigde tas op
    public function update(int $id): void
    {
        $this->requireAuth();
        $tas = Tas::getById($id);
        if (!$tas) {
            $this->redirect('/admin');
            return;
        }

        // Gebruik bestaande paden als standaard, vervang bij nieuwe uploads
        $fotoPath  = $tas['afbeelding'];
        $modelPath = $tas['model_3d'];

        // Vervang de afbeelding als een nieuw bestand is geüpload
        if (!empty($_FILES['afbeelding']['tmp_name']) && $_FILES['afbeelding']['error'] === 0) {
            $n = time() . '_' . basename($_FILES['afbeelding']['name']);
            move_uploaded_file($_FILES['afbeelding']['tmp_name'], ROOT_PATH . '/public/uploads/' . $n);
            $fotoPath = 'uploads/' . $n;
        }

        // Vervang het 3D-model als een nieuw bestand is geüpload
        if (!empty($_FILES['model_3d']['tmp_name']) && $_FILES['model_3d']['error'] === 0) {
            $m = time() . '_' . basename($_FILES['model_3d']['name']);
            move_uploaded_file($_FILES['model_3d']['tmp_name'], ROOT_PATH . '/public/uploads/' . $m);
            $modelPath = 'uploads/' . $m;
        }

        // Sla de bijgewerkte tas op en stuur door naar het admin-overzicht
        Tas::update(
            null,
            $id,
            $_POST['naam'],
            $_POST['beschrijving'],
            $fotoPath,
            $_POST['kleurcode'],
            $modelPath,
            $_POST['tekst_kleur'] ?? '#000000',
            $_POST['titel_kleur'] ?? '#000000'
        );

        $this->redirect('/admin');
    }

    // delete(): verwijdert een tas uit de database en wist de bijbehorende afbeelding van de server
    public function delete(int $id): void
    {
        $this->requireAuth();
        $afbeelding = Tas::delete($id);

        // Verwijder het afbeeldingsbestand van de server als het bestaat
        if ($afbeelding !== null) {
            $imagePath = ROOT_PATH . '/public/' . $afbeelding;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $this->redirect('/admin');
    }
}
