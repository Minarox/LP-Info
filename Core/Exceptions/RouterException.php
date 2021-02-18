<?php


namespace App\Core\Exceptions;


use App\Controllers\ErrorController;
use Exception;

final class RouterException extends Exception
{
    public function error404()
    {
        ErrorController::error404();
    }
}