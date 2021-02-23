<?php


namespace App\Core\Classes\SuperGlobals;


interface StoreData
{
    public function get(string $key);
    public function set(string $key, mixed $value, int $time);
    public function delete(string $key);
    public function exists(string $key);
}