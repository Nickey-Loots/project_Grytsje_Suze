<?php
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $imgDir = ROOT_PATH . '/public/images/';
        $excluded = ['groot logo wit.png', 'GS Grytsje Suze Logo goed-01.png', 'GS Grytsje Suze Logo goed-02.png', 'GSLOGOWIT'];
        $extensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $images = [];

        foreach (scandir($imgDir) as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, $extensions) && !in_array($file, $excluded)) {
                $images[] = $file;
            }
        }
        shuffle($images);

        $this->render('home', ['images' => $images]);
    }
}
