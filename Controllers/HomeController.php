<?php


namespace App\Controllers;



final class HomeController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'hothothot/index');
    }
}