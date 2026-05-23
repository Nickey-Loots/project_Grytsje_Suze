<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Tas;

class PortfolioController extends Controller
{
    public function index(): void
    {
        $tassen = Tas::getAll();
        $this->render('portfolio', ['tassen' => $tassen]);
    }

    public function show(int $id): void
    {
        $tas = Tas::getById($id);
        if (!$tas) {
            http_response_code(404);
            echo '<h1>404 - Tas niet gevonden</h1>';
            return;
        }

        $imgDir = ROOT_PATH . '/public/uploads/';
        $extensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $galerij = [];

        if (is_dir($imgDir)) {
            foreach (scandir($imgDir) as $file) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, $extensions)) {
                    $galerij[] = 'uploads/' . $file;
                }
            }
        }

        $bgColor = $tas['kleurcode'] ?? '#ffffff';
        $hex = ltrim($bgColor, '#');
        $r   = hexdec(substr($hex, 0, 2));
        $g   = hexdec(substr($hex, 2, 2));
        $b   = hexdec(substr($hex, 4, 2));
        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
        $isDark     = $yiq < 128;
        $overlayRgb = "$r, $g, $b";

        $this->render('portfolio-show', [
            'tas'        => $tas,
            'galerij'    => $galerij,
            'bgColor'    => $bgColor,
            'isDark'     => $isDark,
            'overlayRgb' => $overlayRgb,
        ]);
    }
}
