<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm(): void
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/admin');
        }
        $this->render('admin/login', ['error' => '']);
    }

    public function login(): void
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/admin');
        }

        $user = User::findByCredentials($_POST['email'] ?? '', $_POST['password'] ?? '');

        if ($user) {
            $_SESSION['user_id']    = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_rol']   = $user['rol'];
            $this->redirect('/admin');
        }

        $this->render('admin/login', ['error' => 'Onjuist e-mailadres of wachtwoord.']);
    }

    public function logout(): void
    {
        session_destroy();
        $this->redirect('/admin/login');
    }
}
