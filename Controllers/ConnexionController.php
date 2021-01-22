<?php


namespace App\Controllers;


final class ConnexionController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'hothothot/pages/connexion');
    }
}