<?php


namespace App\Controllers;


use App\Core\System\Controller;

final class HomeController extends Controller
{
    public function index()
    {
        // TODO: Le titre de la page d'accueil ne s'affiche plus, même avec "title: 'Accueil'"
        $this->render(name_file: 'home');
    }
}