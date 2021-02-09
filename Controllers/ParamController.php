<?php


namespace App\Controllers;



use App\Core\System\Controller;

final class ParamController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'hothothot/pages/parametrage');
    }
}