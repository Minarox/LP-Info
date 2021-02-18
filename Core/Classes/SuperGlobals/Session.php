<?php


namespace App\Core\Classes\SuperGlobals;


use JetBrains\PhpStorm\Pure;

class Session implements StoreData
{
    #[Pure] public static function get(string $key): string|bool
    {
        return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : false;
    }

    public static function set(string $key, $value, int $time = null): void
    {
        $_SESSION[$key] = $value;
    }

    public static function delete(string $key = null): void
    {
        if (is_null($key)) {
            if (session_status() == PHP_SESSION_ACTIVE) session_destroy();
        } else {
            unset($_SESSION[$key]);
        }
    }

    public static function exists(string $key): bool
    {
        return isset($_SESSION[$key]);
    }
}