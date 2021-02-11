<?php


namespace App\Controllers;



use App\Core\System\Controller;

final class HelpController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'other/help', title: 'Documentation');
    }
}