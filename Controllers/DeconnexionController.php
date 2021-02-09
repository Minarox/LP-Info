<?php


namespace App\Controllers;


use App\Core\System\Controller;
use JetBrains\PhpStorm\NoReturn;

class DeconnexionController extends Controller
{
    #[NoReturn] public function index()
    {
        $this->sessionDestroy();
        $this->redirect('/connexion');
    }
}