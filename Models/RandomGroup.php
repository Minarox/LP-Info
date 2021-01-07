<?php


namespace App\Models;


use App\Core\Classes\Parser;

final class RandomGroup
{
    public function makeGroup(int $number = null): string|array
    {
        if ($xlsx = Parser::parse('documents/studentList.xlsx')) {
            $var[] = $xlsx->rows();
            unset($var[0][0]);
            if ($number !== null) {
                if ($number === 0)
                    return "<h2>Vous ne pouvez pas créer un groupe possédant 0 personne à l'intérieur !</h2>";

                if ($number > count($var[0]))
                    return "<h2>La classe LP DEV WEB ne contient pas plus de " . count($var[0]) . " personnes !</h2>";

                shuffle($var[0]);
                $var = array_chunk($var[0], $number);
            }
        }

        return $var = $var ?? Parser::parseError();
    }
}