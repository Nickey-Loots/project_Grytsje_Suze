<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Tas;

class AdminTassenController extends Controller
{
    public function create(): void
    {
        $this->requireAuth();
        $this->render('admin/tassen-toevoegen');
    }

    public function store(): void
    {
        $this->requireAuth();

        if (empty($_FILES['afbeelding']['tmp_name'])) {
            $this->redirect('/admin/tassen/toevoegen');
            return;
        }

        $fotoNaam = time() . '_' . basename($_FILES['afbeelding']['name']);
        move_uploaded_file($_FILES['afbeelding']['tmp_name'], ROOT_PATH . '/public/uploads/' . $fotoNaam);
        $fotoDB = 'uploads/' . $fotoNaam;

        $modelDB = '';
        if (!empty($_FILES['model_3d']['tmp_name']) && $_FILES['model_3d']['error'] === 0) {
            $modelNaam = time() . '_' . basename($_FILES['model_3d']['name']);
            move_uploaded_file($_FILES['model_3d']['tmp_name'], ROOT_PATH . '/public/uploads/' . $modelNaam);
            $modelDB = 'uploads/' . $modelNaam;
        }

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

    public function update(int $id): void
    {
        $this->requireAuth();
        $tas = Tas::getById($id);
        if (!$tas) {
            $this->redirect('/admin');
            return;
        }

        $fotoPath  = $tas['afbeelding'];
        $modelPath = $tas['model_3d'];

        if (!empty($_FILES['afbeelding']['tmp_name']) && $_FILES['afbeelding']['error'] === 0) {
            $n = time() . '_' . basename($_FILES['afbeelding']['name']);
            move_uploaded_file($_FILES['afbeelding']['tmp_name'], ROOT_PATH . '/public/uploads/' . $n);
            $fotoPath = 'uploads/' . $n;
        }

        if (!empty($_FILES['model_3d']['tmp_name']) && $_FILES['model_3d']['error'] === 0) {
            $m = time() . '_' . basename($_FILES['model_3d']['name']);
            move_uploaded_file($_FILES['model_3d']['tmp_name'], ROOT_PATH . '/public/uploads/' . $m);
            $modelPath = 'uploads/' . $m;
        }

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

    public function delete(int $id): void
    {
        $this->requireAuth();
        $afbeelding = Tas::delete($id);

        if ($afbeelding !== null) {
            $imagePath = ROOT_PATH . '/public/' . $afbeelding;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $this->redirect('/admin');
    }
}
