<?php


namespace App\Controllers;



use App\Core\Classes\SuperGlobals\Cookie;
use App\Core\Classes\Token;
use App\Core\Classes\Validator;
use App\Core\System\Controller;
use App\Models\RolesModel;
use App\Models\UsersModel;

final class ProfileController extends Controller
{
    public function index()
    {
        if (!$this->isAuthenticated()) ErrorController::error404();
        $this->render(name_file: 'account/profile', title: 'Profil');
    }

    public function edit()
    {
        if (!$this->isAuthenticated()) ErrorController::error404();
        $this->render(name_file: 'account/edit-profile', title: 'Profil');
    }
}