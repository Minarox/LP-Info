<?php


namespace App\Controllers;



use App\Core\System\Controller;

final class RecoveryController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'account/recovery', title: 'Récupération mot de passe');
    }
}