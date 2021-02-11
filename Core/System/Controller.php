<?php


namespace App\Core\System;


use JetBrains\PhpStorm\NoReturn;

abstract class Controller
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) session_start();
    }

    protected function render(string $name_file, array $params = [], string $template = 'base', string $title = 'Accueil')
    {
        extract($params);

        $this->startBuffer();

        require_once VIEWS . "$name_file.php";

        isset($content) ?: $content = $this->endBuffer();

        require_once VIEWS . "$template.php";
    }

    private function startBuffer(): bool
    {
        return ob_start();
    }

    private function endBuffer(): bool|string
    {
        return ob_get_clean();
    }

    #[NoReturn] protected function redirect(string $url)
    {
        header("Location: $url");
        die();
    }

    protected function json(array $json)
    {
        echo json_encode($json);
    }

    protected  function sessionDestroy()
    {
        if (session_status() == PHP_SESSION_ACTIVE) session_destroy();
    }
}