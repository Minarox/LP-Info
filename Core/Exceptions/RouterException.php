<?php


namespace App\Core\Exceptions;


use Exception;

final class RouterException extends Exception
{
    public function error404()
    {
        http_response_code(404);
        require_once VIEWS . 'error/404.php';
    }
}