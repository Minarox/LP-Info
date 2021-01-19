<?php

// Public sources path
define('VIEWS', __DIR__ . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR);
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