<?php

use App\Controllers\SensorsController;
use App\Core\Autoloader\Autoloader;
use App\Core\Exceptions\RouterException;
use App\Core\Routes\Router;
use App\Core\Config\Config;
//use App\Core\Routes\Routes;

// Check the PHP version
if (phpversion() <= 8.0) die("Upgrade your PHP version to 8.0 !");

// Afficher les erreurs sur le serveur de prod
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once dirname(__DIR__) . '/Core/Autoloader/Autoloader.php';
require_once dirname(__DIR__) . '/Core/Config/Config.php';

// Charger le fichier de config
Config::loadConfig();

// Charger le chargement auto des classes
Autoloader::register();

// Création / mise à jour de la crontab
SensorsController::crontab();

$router = new Router($_GET['url']);

//new Routes($router);

// Path Route
$router->add('/', 'HomeController');
$router->add('/settings', 'SettingsController');
$router->add('/account', 'ProfileController');
$router->add('/account/edit', 'ProfileController::edit');
$router->add('/login', 'LoginController', ['GET', 'POST']);
$router->add('/register', 'RegisterController', ['GET', 'POST']);
$router->add('/help', 'HelpController');
$router->add('/recovery', 'RecoveryController', ['GET', 'POST']);
$router->add('/logout', 'LogoutController');
$router->add('/email/register', 'EmailRegisterController', ['GET', 'POST']);

// Ajax path route ( Google )
$router->add('/ajax/googleRegister', 'RegisterController::google', 'POST');
$router->add('/ajax/googleLogin', 'LoginController::google', 'POST');

// Sync Path
$router->add('/sync', 'SensorsController');
$router->add('/test', 'SensorsController::crontab');

try {
    $router->run();
} catch (RouterException $e) {
    echo $e->getMessage();
}