<?php


namespace App\Controllers;



final class ConnexionController extends Controller
{
    public function index()
    {
        if (isset($_POST['login']))
            header('Location: https://youtube.com');

        $this->render(name_file: 'hothothot/pages/connexion');
    }
}