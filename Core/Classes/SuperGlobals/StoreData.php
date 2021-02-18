<?php


namespace App\Core\Classes\SuperGlobals;


interface StoreData
{
    public static function get(string $key);
    public static function set(string $key, mixed $value, int $time);
    public static function delete(string $key);
    public static function exists(string $key);
}