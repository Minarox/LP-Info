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

        // Database params
        define('DB_TYPE', $config['db_type']);
        define('DB_HOST', $config['db_host']);
        define('DB_NAME', $config['db_name']);
        define('DB_USER', $config['db_user']);
        define('DB_PASS', $config['db_pass']);

        // Root Path
        define('ROOT', $config['root_path']);

        // Debug
        define('DEBUG', $config['debug'] ? true : false);

        // Synchro time
        define('SENSOR_TIME', $config['sync_time']);

        // Sensor links
        define('SENSOR_LINKS', explode(', ', $config['links']));
    }
}