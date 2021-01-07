<?php


namespace App\Core\Routes;


use JetBrains\PhpStorm\Pure;
use App\Core\Exceptions\RouterException;

final class Router
{
    private string $url;
    private array $routes = [];
    private array $method = array(
        'GET', 'POST', 'HEAD', 'PUT', 'DELETE'
    );

    #[Pure] public function __construct(string $url)
    {
        $this->url = self::cleanUrl($url);
    }

    public function add(array $routes)
    {
        foreach ($routes as $path => $controller) {
            $method = isset($controller[2]) ? strtoupper($controller[2]) : 'GET';
            $action = $controller[0] . '\\' . $controller[1];

            if (in_array($method, $this->method))
                $this->routes[$method][] = new Route($path, $action);
        }
    }

    /**
     * @throws RouterException
     */
    public function run()
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url))
                return $route->execute();
        }

        throw new RouterException("No matching routes !");
    }

    #[Pure] public static function cleanUrl(string $url): string
    {
        $url = trim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return $url;
    }
}