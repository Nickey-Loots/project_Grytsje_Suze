<?php
namespace App\Controllers;

use App\Core\Controller;

class CollaborationsController extends Controller
{
    public function index(): void
    {
        $capabilities = [
            'Prop and costume design for film, theatre and performance',
            'Custom editorial and campaign pieces',
            'Brand activations and experiential installations',
            'Styling for commercial productions and creative shoots',
            'Workshop facilitation and brand experiences',
        ];

        $this->render('collaborations', ['capabilities' => $capabilities]);
    }
}
