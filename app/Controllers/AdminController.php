<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Tas;

class AdminController extends Controller
{
    public function index(): void
    {
        $this->requireAuth();
        $tassen = Tas::getAll();
        $this->render('admin/tassen', ['tassen' => $tassen]);
    }
}
