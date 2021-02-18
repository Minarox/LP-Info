<?php


namespace App\Core\System;


use App\Core\Classes\SuperGlobals\Cookie;
use App\Core\Classes\SuperGlobals\Session;
use JetBrains\PhpStorm\NoReturn;

abstract class Controller
{

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) session_start();

        if (Cookie::exists('token')) Cookie::set('token', Session::get('token'));

        if (!Cookie::exists('token') && Session::exists('token')) {
            $this->addFlash('error', 'Vous avez été déconnectée pour inactivité !');
            Session::delete();
        }
    }

    protected function render(string $name_file, array $params = [], string $template = 'base', string $title = 'Accueil')
    {
        extract($params);

        ob_start();

        require_once VIEWS . "$name_file.php";

        isset($content) ?: $content = ob_get_clean();

        require_once VIEWS . "$template.php";
    }

    #[NoReturn] protected function redirect(string $header, bool $replace = false, int $response_code = 0)
    {
        header("Location: $header", $replace, $response_code);
        die();
    }

    protected function json(array $json)
    {
        echo json_encode($json);
    }

    protected function addFlash(string $alert_type, string $message)
    {
        Session::set($alert_type, $message);
    }
}