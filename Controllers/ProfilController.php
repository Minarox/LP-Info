<?php


namespace App\Controllers;



final class ProfilController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'hothothot/pages/profil');
    }
}