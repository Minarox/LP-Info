<?php


namespace App\Controllers;


use App\Controllers\SensorsController;
use App\Core\System\Controller;

final class HomeController extends Controller
{
    public function index()
    {
        SensorsController::get($_SESSION['nb_values_comparison'] ??= SENSORS_DEFAULT_NB_VALUE_COMPARISON);
        SensorsController::crontab();

        $this->render(name_file: 'home');
    }

    public function cgu()
    {
        $this->render(name_file: 'other/cgu', title: "Conditions Générales d'Utilisation (CGU)");
    }
}