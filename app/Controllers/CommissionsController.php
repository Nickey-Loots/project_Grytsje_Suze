<?php
namespace App\Controllers;

use App\Core\Controller;

class CommissionsController extends Controller
{
    public function index(): void
    {
        $this->render('commissions');
    }
}
