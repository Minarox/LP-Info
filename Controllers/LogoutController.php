<?php


namespace App\Controllers;


use App\Core\Classes\SuperGlobals\Cookie;
use App\Core\Classes\SuperGlobals\Session;
use App\Core\System\Controller;
use JetBrains\PhpStorm\NoReturn;

class LogoutController extends Controller
{
    #[NoReturn] public function index()
    {
        if (!isset($_COOKIE['token'])) {
            ErrorController::error404();
        } else {
            Cookie::delete();
            Session::delete();

            $this->addFlash('success', "Vous avez été déconnecté avec succès !");
            $this->redirect(header: '/login', response_code: 301);
        }
    }
}