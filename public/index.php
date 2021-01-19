<?php

use App\Autoloader;
use App\Core\Exceptions\RouterException;
use App\Core\Routes\Router;

if (file_exists(__DIR__ . '/../Autoloader.php'))
    require_once __DIR__ . '/../Autoloader.php';

Autoloader::register();

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR);

// Database params
define('DB_NAME', 'mvc');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');

// Root Path
define('ROOT', '/');

// Debug
define('DEBUG', false);

$router = new Router($_GET['url']);

$router->add([
    '/' => ['App\Controllers', 'HomeController::index'],
    '/parametrage' => ['App\Controllers', 'ParamController::index'],
    '/profil' => ['App\Controllers', 'ProfilController::index'],
    '/connexion' => ['App\Controllers', 'ConnexionController::index'],
    '/inscription' => ['App\Controllers', 'InscriptionController::index'],
]);

try {
    $router->run();
} catch (RouterException $e) {
    if (DEBUG)
        echo $e->getMessage();
    return $e->error404();
}
