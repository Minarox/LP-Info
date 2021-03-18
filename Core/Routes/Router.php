<?php

namespace App\Core\Routes;

use JetBrains\PhpStorm\Pure;
use App\Core\Exceptions\RouterException;

final class Router {

    private string $url;
    private array $routes = [];
    private array $method = array(
        'GET', 'POST', 'HEAD', 'PUT', 'DELETE'
    );

    #[Pure] public function __construct(string $url) {
        $this->url = self::cleanUrl($url);
    }

    public function add(string $path, string $action, string|array $method = 'GET'): void {
        if (is_array($method)) {
            foreach ($method as $value) {
                $method = strtoupper($value);

                if (in_array($value, $this->method)) $this->routes[$method][] = new Route($path, 'App\\Controllers\\' . $action);
            }
        }

        $method = strtoupper($method);

        if (in_array($method, $this->method) && is_string($method)) $this->routes[$method][] = new Route($path, 'App\\Controllers\\' . $action);
    }

    /**
     * @throws RouterException
     */
    private function prepare() {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) return $route->execute();
        }

        throw new RouterException("No matching routes !", 2);
    }

    public function run() {
        try {
            $this->prepare();
        } catch (RouterException $e) {
            if (DEBUG) echo 'Error : ' . $e->getMessage();
            $e->error404();
        }
    }

    #[Pure] public static function cleanUrl(string $url): string {
        $url = trim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return $url;
    }

}
