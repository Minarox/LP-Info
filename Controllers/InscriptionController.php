<?php


namespace App\Controllers;



final class InscriptionController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'hothothot/pages/inscription');
    }
}