<?php


namespace App\Controllers;



use App\Core\System\Controller;

final class ErrorController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'error/404', title: 'Erreur');
    }
}