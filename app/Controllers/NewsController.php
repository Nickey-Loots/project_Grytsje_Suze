<?php
namespace App\Controllers;

use App\Core\Controller;

class NewsController extends Controller
{
    public function index(): void
    {
        $this->render('news');
    }
}
