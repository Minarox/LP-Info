<?php


namespace App\Core\Classes\SuperGlobals;


use JetBrains\PhpStorm\Pure;

class Cookie implements StoreData
{
    private static int $time;

    #[Pure] public static function get(string $key)
    {
        if (array_key_exists($key, $_COOKIE)) return $_COOKIE[$key];
        return false;
    }

    public static function set(string $key, mixed $value, int $time = 15): void
    {
        self::$time = $time;
        setcookie($key, $value, time() + self::$time, null, null, false, true);
    }

    public static function delete(string $key = null): void
    {
        if ($key !== null) setcookie($key, time() - self::$time, null, null, false, true);

        foreach ($_COOKIE as $k => $v) {
            setcookie($k, $v, time() - self::$time, null, null, false, true);
        }
    }
}