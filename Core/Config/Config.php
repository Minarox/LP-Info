<?php


namespace App\Core\Config;


abstract class Config
{
    public static function loadConfig()
    {
        // Initialisation config file
        $config = parse_ini_file(dirname(__DIR__,2) . '/config.ini');

        // Public sources path
        define('VIEWS', dirname(__DIR__,2) . '/Views/');
        define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . '/assets/');
        define('APP', dirname(__DIR__,2));

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