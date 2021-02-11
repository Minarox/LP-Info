<?php

// Afficher les erreurs sur le serveur de prod
error_reporting(E_ALL);
ini_set("display_errors", 1);

use App\Core\Autoloader\Autoloader;
use App\Core\Exceptions\RouterException;
use App\Core\Routes\Router;
use App\Core\Config\Config;
//use App\Core\Routes\Routes;

file_exists(dirname(__DIR__) . '/Core/Autoloader/Autoloader.php') ? require_once dirname(__DIR__) . '/Core/Autoloader/Autoloader.php' : die('Autoloader class doesn\'t exists !');
file_exists(dirname(__DIR__) . '/Core/Config/Config.php') ? require_once dirname(__DIR__) . '/Core/Config/Config.php' : die('config file doesn\'t exists !');

// Charger le fichier de config
Config::loadConfig();

// Charger le chargement auto des classes
Autoloader::register();

$router = new Router($_GET['url']);

//new Routes($router);

// Path Route
$router->add('/', 'HomeController');
$router->add('/settings', 'SettingsController');
$router->add('/account', 'ProfileController');
$router->add('/login', 'LoginController', ['GET', 'POST']);
$router->add('/register', 'RegisterController', ['GET', 'POST']);
$router->add('/help', 'HelpController');
$router->add('/recovery', 'RecoveryController');
$router->add('/logout', 'LogoutController');

// Ajax path route
//$router->add('/ajax/loginSystem', 'LoginController::loginSystem', 'POST');
//$router->add('/ajax/signUpSystem', 'RegisterController::signUpSystem', 'POST');

try {
    $router->run();
} catch (RouterException $e) {
    echo $e->getMessage();
}