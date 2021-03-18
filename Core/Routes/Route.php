<?php

namespace App\Core\Routes;

use App\Core\Classes\SuperGlobals\Request;
use App\Core\Exceptions\RouterException;
use JetBrains\PhpStorm\Pure;

final class Route {

    private string $path, $action;
    private array $matches;
    private array $pattern = array(
        '#{(int)}#' => '([\d]+)',
        '#{(str)}#' => '([\D]+)',
        '#{(all)}#' => '([\w]+)'
    );

    #[Pure] public function __construct(string $path, string $action) {
        $this->path = Router::cleanUrl($path);
        $this->action = $action;
    }

    public function match(string $url): bool {
        $path = preg_replace(array_keys($this->pattern), $this->pattern, $this->path);
        $regex = "#^$path$#";

        if (!preg_match($regex, $url, $matches)) return false;

        $this->matches = $matches;
        return true;
    }

    /**
     * @throws RouterException
     */
    public function execute() {
        if (!preg_match('#{(::)}#', $this->action)) $this->action = $this->action . '::index';

        $params = explode('::', $this->action);

        $controller = new $params[0]();
        $method = $params[1];

        if (!method_exists($controller, $method)) throw new RouterException("This method doesn't exist !", 1);

        isset($this->matches[1]) ? $controller->$method($this->matches[1], new Request()) : $controller->$method(new Request());
    }

}
