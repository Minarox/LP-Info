<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\System\Controller;
use JetBrains\PhpStorm\NoReturn;

class LogoutController extends Controller {

    #[NoReturn] #[Route('/logout', 'logout')] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            ErrorController::error404();
        } else {
            $request->cookie->delete('authenticated');
            setcookie('authenticated', '', time() - INACTIVITY_TIME, '/');
            $request->session->delete(restart_session: true);

            $config = parse_ini_file(dirname(__DIR__,2) . '/config.ini');
            define('DB_NAME', $config['db_name']);
            define('DB_USER', $config['db_user']);
            define('DB_PASS', $config['db_pass']);

            $this->addFlash('success', "Vous avez été déconnecté avec succès !");
            $this->redirect(self::reverse('login'));
        }
    }

}
