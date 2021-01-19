<?php


namespace App\Controllers;



final class RecuperationController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'hothothot/pages/recuperation');
    }
}