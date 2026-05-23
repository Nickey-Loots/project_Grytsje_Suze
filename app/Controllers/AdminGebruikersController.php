<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AdminGebruikersController extends Controller
{
    public function index(): void
    {
        $this->requireAuth();
        $users = User::getAll();
        $this->render('admin/gebruikers', ['users' => $users]);
    }

    public function store(): void
    {
        $this->requireAuth();
        User::create($_POST['email'] ?? '', $_POST['wachtwoord'] ?? '');
        $this->redirect('/admin/gebruikers');
    }

    public function delete(int $id): void
    {
        $this->requireAuth();
        User::delete($id);
        $this->redirect('/admin/gebruikers');
    }
}
