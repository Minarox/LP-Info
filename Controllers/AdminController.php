<?php


namespace App\Controllers;


final class AdminController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'hothothot/pages/admin');
    }
}