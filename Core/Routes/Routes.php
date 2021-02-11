<?php


namespace App\Core\Routes;


final class Routes
{
    public function __construct($router)
    {
        $controllers = scandir(APP . '/Controllers');

        foreach ($controllers as $controller) {
            if(preg_match('/Controller.php/', $controller)) {
                $path =  strtolower(str_replace('Controller.php', '', $controller));
                var_dump($path);
                $router->add('/'.$path, $controller);
            }
        }

        // Intern Ajax system
        $router->add('/ajax/loginSystem', 'LoginController::loginSystem', 'POST');
        $router->add('/ajax/signUpSystem', 'RegisterController::signUpSystem', 'POST');
    }
}