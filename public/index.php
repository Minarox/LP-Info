<?php

// Afficher les erreurs sur le serveur de prod
error_reporting(E_ALL);
ini_set("display_errors", 1);

use App\Core\Autoloader\Autoloader;
use App\Core\Exceptions\RouterException;
use App\Core\Routes\Router;
use App\Core\Config\Config;

file_exists(dirname(__DIR__) . '/Core/Autoloader/Autoloader.php') ? require_once dirname(__DIR__) . '/Core/Autoloader/Autoloader.php' : die('Autoloader class doesn\'t exists !');
file_exists(dirname(__DIR__) . '/Core/Config/Config.php') ? require_once dirname(__DIR__) . '/Core/Config/Config.php' : die('config file doesn\'t exists !');

new Config();

Autoloader::register();

$router = new Router($_GET['url']);

$router->add('/', 'HomeController');
$router->add('/parametrage', 'ParamController');
$router->add('/profil', 'ProfilController');
$router->add('/connexion', 'ConnexionController');
$router->add('/inscription', 'InscriptionController');
$router->add('/documentation', 'DocumentationController');
$router->add('/recuperation', 'RecuperationController');
$router->add('/admin', 'AdminController');

$router->run();