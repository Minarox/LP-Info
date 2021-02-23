<?php


namespace App\Core\System;


use App\Core\Classes\SuperGlobals\Request;
use JetBrains\PhpStorm\NoReturn;
use JetBrains\PhpStorm\Pure;

abstract class Controller
{
    protected Request $request;

    public function __construct()
    {
        $this->request = new Request();

        if (session_status() == PHP_SESSION_NONE) session_start();

        if ($this->isAuthenticated()) $this->request->session->set('token', $this->request->session->get('token'));

        if (!$this->isAuthenticated() && $this->request->session->exists('token')) {
            $this->addFlash('error', 'Vous avez été déconnectée pour inactivité !');
            $this->request->session->delete();
        }
    }

    protected function render(string $name_file, array $params = [], string $template = 'base', string $title = 'Accueil')
    {
        extract($params);

        ob_start();

        $user_is_auth = $this->isAuthenticated();

        require_once VIEWS . "$name_file.php";

        isset($content) ?: $content = ob_get_clean();

        require_once VIEWS . "$template.php";
    }

    #[NoReturn] protected function redirect(string $header, bool $replace = false, int $response_code = 0)
    {
        header('Location: ' . ROOT . $header, $replace, $response_code);
        die();
    }

    protected function addFlash(string $alert_type, string $message)
    {
        $this->request->session->set($alert_type, $message);
    }

    #[Pure] protected function isAuthenticated(): bool
    {
        return $this->request->cookie->exists('token');
    }
}