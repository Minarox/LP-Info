<?php


namespace App\Controllers;



use App\Core\System\Controller;

final class ProfileController extends Controller
{
    public function index()
    {
        if (!isset($_COOKIE['token'])) ErrorController::error404();
        $this->render(name_file: 'account/profile', title: 'Profil');
    }
}