<?php


namespace App\Controllers;



use App\Core\System\Controller;

final class ProfileController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'account/profile', title: 'Profil');
    }
}