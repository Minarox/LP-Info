<?php

use App\Core\Autoloader\Autoloader;
use App\Core\Routes\Router;
use App\Core\Config\Config;

// Check the PHP version
if (phpversion() <= 8.0) die("Upgrade your PHP version to 8.0 !");

require_once dirname(__DIR__) . '/Core/Autoloader/Autoloader.php';
require_once dirname(__DIR__) . '/Core/Config/Config.php';

// Charger le fichier de config
Config::loadConfig();

// Charger le chargement auto des classes
Autoloader::register();

// Afficher les erreurs si le DEBUG est activé
switch (DEBUG) {
    case true:
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        break;
    default:
        error_reporting(0);
        ini_set("display_errors", 0);
}

$router = new Router($_GET['url']);

// Path Route
$router->add('/', 'HomeController');
$router->add('/settings', 'SettingsController', ['GET', 'POST']);
$router->add('/account', 'ProfileController', ['GET', 'POST']);
$router->add('/account/edit', 'ProfileController::edit', ['GET', 'POST']);
$router->add('/account/edit/password', 'ProfileController::password', 'POST');
$router->add('/login', 'LoginController', ['GET', 'POST']);
$router->add('/register', 'RegisterController', ['GET', 'POST']);
$router->add('/help', 'HelpController');
$router->add('/recovery', 'RecoveryController', ['GET', 'POST']);
$router->add('/logout', 'LogoutController');
$router->add('/email/register', 'EmailRegisterController', ['GET', 'POST']);
$router->add('/cgu', 'HomeController::cgu');
$router->add('/mentions-legales', 'HomeController::mentions_legales');
$router->add('/settings/download', 'SettingsController::download');

// Ajax path route ( Google )
$router->add('/ajax/googleRegister', 'RegisterController::google',['GET', 'POST']);
$router->add('/ajax/googleLogin', 'LoginController::google', 'POST');

// Ajax path route ( settings )
$router->add('/ajax/alertSensor', 'SettingsController::alertSensor', 'POST');

// Sync Path
$router->add('/sync', 'SensorsController');

$router->run();