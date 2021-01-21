<?php


namespace App\Controllers;


abstract class Controller
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    protected function render(string $name_file, array $params = [], string $template = 'base')
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

    public function redirect(string $url)
    {
        header("Location: $url");
        die();
    }
}