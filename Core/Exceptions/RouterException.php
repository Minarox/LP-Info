<?php


namespace App\Core\Exceptions;


use App\Controllers\ErrorController;
use Exception;

final class RouterException extends Exception
{
    public function error404()
    {
        http_response_code(404);

        $error = new ErrorController();
        $error->index();
    }
}