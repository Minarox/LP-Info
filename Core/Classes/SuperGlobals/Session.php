<?php


namespace App\Core\Classes\SuperGlobals;


use JetBrains\PhpStorm\Pure;

class Session implements StoreData
{
    #[Pure] public static function get(string $key): string|bool
    {
        if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];
        return false;
    }

    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function delete(string $key = null): void
    {
        if ($key !== null) {
            unset($_SESSION[$key]);
        } else {
            if (session_status() == PHP_SESSION_ACTIVE) session_destroy();
        }
    }
}