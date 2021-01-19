<?php


namespace App\Controllers;



final class DocumentationController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'hothothot/pages/documentation');
    }
}