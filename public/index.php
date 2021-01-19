<?php

use App\Core\Autoloader\Autoloader;
use App\Core\Exceptions\RouterException;
use App\Core\Routes\Router;

file_exists(__DIR__ . '/../Core/Autoloader/Autoloader.php') ? require_once __DIR__ . '/../Core/Autoloader/Autoloader.php' : die("Can't find Autoload class file !");
file_exists(__DIR__ . '/../config.php') ? require_once __DIR__ . '/../config.php' : die("Can't find config.php file !");

Autoloader::register();

$router = new Router($_GET['url']);

$router->add('/', 'HomeController');
$router->add('/parametrage', 'ParamController');
$router->add('/profil', 'ProfilController');
$router->add('/connexion', 'ConnexionController');
$router->add('/inscription', 'InscriptionController');

$router->run();

