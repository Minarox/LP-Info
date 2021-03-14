<?php


namespace App\Controllers;


use App\Controllers\SensorsController;
use App\Core\System\Controller;

final class HomeController extends Controller
{
    public function index()
    {
        SensorsController::get();
        // SensorsController::crontab();

        $this->render(name_file: 'home');
    }
}