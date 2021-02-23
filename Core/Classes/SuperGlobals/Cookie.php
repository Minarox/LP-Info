<?php


namespace App\Core\Classes\SuperGlobals;


use JetBrains\PhpStorm\Pure;

class Cookie implements StoreData
{
    private int $time;

    #[Pure] public function get(string $key)
    {
        return array_key_exists($key, $_COOKIE) ? $_COOKIE[$key] : false;
    }

    public function set(string $key, mixed $value, int $time = 15): void
    {
        $this->time = $time;
        setcookie($key, $value, time() + $this->time, null, null, false, true);
    }

    public function delete(string $key = null): void
    {
        if (is_null($key)) {
            foreach ($_COOKIE as $k => $v) setcookie($k, $v, time() - $this->time, null, null, false, true);
        } else {
            setcookie($key);
            unset($_COOKIE[$key]);
        }
    }

    public function exists(string $key): bool
    {
        return isset($_COOKIE[$key]);
    }
}