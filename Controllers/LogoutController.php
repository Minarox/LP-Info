<?php

namespace App\Controllers;

use App\Core\Classes\SuperGlobals\Request;
use App\Core\System\Controller;
use JetBrains\PhpStorm\NoReturn;

class LogoutController extends Controller {

    #[NoReturn] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            ErrorController::error404();
        } else {
            $request->cookie->delete('token');
            setcookie('token', '', time() - INACTIVITY_TIME, '/');
            $request->session->delete(restart_session: true);

            $this->addFlash('success', "Vous avez été déconnecté avec succès !");
            $this->redirect(header: 'login', response_code: 301);
        }
    }

}
