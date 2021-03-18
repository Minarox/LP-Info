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
        SettingsController::getAlert();

        $this->render(name_file: 'home', caching: false);
    }

    public function gcu()
    {
        $this->render(name_file: 'other/gcu', title: "Conditions Générales d'Utilisation (CGU)");
    }

    public function legal_notices()
    {
        $this->render(name_file: 'other/legal-notices', title: "Mentions légales");
    }
}