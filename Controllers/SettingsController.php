<?php


namespace App\Controllers;



use App\Core\System\Controller;

final class SettingsController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'other/settings', title: 'Paramétrages');
    }
}