<?php


namespace App\Core\Config;


abstract class Config
{
    public static function loadConfig()
    {
        $config = match ($_SERVER['REMOTE_ADDR']) {
            '127.0.0.1', '::1' => parse_ini_file(dirname(__DIR__,2) . '/config.dev.ini'),
            default => parse_ini_file(dirname(__DIR__,2) . '/config.prod.ini')
        };

        // Public sources path
        define('VIEWS', dirname(__DIR__,2) . '/Views/');
        define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . '/assets/');

        // SSH params
        define('SSH_HOST', $config['ssh_host']);
        define('SSH_PORT', $config['ssh_port']);
        define('SSH_USER', $config['ssh_user']);
        define('SSH_PASS', $config['ssh_pass']);

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

        // Cookies time
        define('INACTIVITY_TIME', $config['inactivity_time']);
        define('PASSWORD_RECOVERY_TIME', $config['password_recovery_time']);

        // Sensors
        define('SENSORS_SYNC_TIME', $config['sync_time']);
        define('SENSORS_LINK', explode(', ', $config['links']));
    }
}