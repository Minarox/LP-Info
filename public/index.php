<?php

use App\Core\Autoloader\Autoloader;
use App\Core\Exceptions\RouterException;
use App\Core\Routes\Router;

file_exists(__DIR__ . '/../Core/Autoloader/Autoloader.php') ? require_once __DIR__ . '/../Core/Autoloader/Autoloader.php' : die("Can't find Autoload class file !");
file_exists(__DIR__ . '/../config.php') ? require_once __DIR__ . '/../config.php' : die("Can't find config.php file !");

Autoloader::register();

$router = new Router($_GET['url']);

$router->add([
    '/' => ['App\Controllers', 'HomeController::index'],
    '/parametrage' => ['App\Controllers', 'ParamController::index'],
    '/profil' => ['App\Controllers', 'ProfilController::index'],
    '/connexion' => ['App\Controllers', 'ConnexionController::index'],
    '/inscription' => ['App\Controllers', 'InscriptionController::index'],
]);

$router->run();

