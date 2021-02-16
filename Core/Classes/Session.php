<?php


namespace App\Core\Classes;


use JetBrains\PhpStorm\Pure;

class Session
{
    #[Pure] public function get(string $key, $default = null)
    {
        if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];
        return $default;
    }

    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function delete(string $key): void
    {
        unset($_SESSION[$key]);
    }
}