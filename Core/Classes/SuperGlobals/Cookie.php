<?php


namespace App\Core\Classes\SuperGlobals;


use JetBrains\PhpStorm\Pure;

class Cookie implements StoreData
{
    private static int $time;

    #[Pure] public static function get(string $key)
    {
        return array_key_exists($key, $_COOKIE) ? $_COOKIE[$key] : false;
    }

    public static function set(string $key, mixed $value, int $time = 15): void
    {
        self::$time = $time;
        setcookie($key, $value, time() + self::$time, null, null, false, true);
    }

    public static function delete(string $key = null): void
    {
        if (is_null($key)) {
            foreach ($_COOKIE as $k => $v) setcookie($k, $v, time() - self::$time, null, null, false, true);
        } else {
            setcookie($key);
            unset($_COOKIE[$key]);
        }
    }

    public static function exists(string $key): bool
    {
        return isset($_COOKIE[$key]);
    }
}