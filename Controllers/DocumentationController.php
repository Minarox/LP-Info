<?php


namespace App\Controllers;



use App\Core\System\Controller;

final class DocumentationController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'hothothot/pages/documentation');
    }
}