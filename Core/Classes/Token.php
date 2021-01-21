<?php


namespace App\Core\Classes;


class Token
{
    public static function generate(int $number = 15): string
    {
        return bin2hex(random_bytes($number));
    }
}