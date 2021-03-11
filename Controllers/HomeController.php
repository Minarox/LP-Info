<?php


namespace App\Controllers;


use App\Core\System\Controller;

final class HomeController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'home');
    }
}