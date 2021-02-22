<?php


namespace App\Controllers;



use App\Core\Classes\SuperGlobals\Cookie;
use App\Core\System\Controller;

final class ProfileController extends Controller
{
    public function index()
    {
        if (!$this->isAuthenticated()) ErrorController::error404();
        $this->render(name_file: 'account/profile', title: 'Profil');
    }
}