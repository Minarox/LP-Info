<?php


namespace App\Core\Config;


final class Config
{
    public function __construct() {
        // Initialisation config file
        $config = parse_ini_file(dirname(__DIR__,2). DIRECTORY_SEPARATOR . 'config.ini');

        // Public sources path
        define('VIEWS', dirname(__DIR__,2) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR);
        define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR);

        // Database params
        $config['db_host'] = define('DB_HOST', $config['db_host']);
        $config['db_name'] = define('DB_NAME', $config['db_name']);
        $config['db_user'] = define('DB_USER', $config['db_user']);
        $config['db_pass'] = define('DB_PASS', $config['db_pass']);

        // Root Path
        $config['db_pass'] = define('ROOT', $config['root_path']);

        // Debug
        $config['debug'] = define('DEBUG', $config['debug'] ? true : false);
    }
}