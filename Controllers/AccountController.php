<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\System\Controller;
use App\Core\Classes\Validator;
use App\Core\System\Model;
use App\Models\UserModel;
use JetBrains\PhpStorm\NoReturn;

class AccountController extends Controller {

    #[Route('/login', 'login', ['GET', 'POST'])] public function login(Request $request) {
        if ($this->isAuthenticated()) ErrorController::error404();
        $mysql_user = new UserModel();
        $validator = new Validator($_POST);

        if ($validator->isSubmitted()) {
            $validator->validate([
                'username' => ['required'],
                'password' => ['required']
            ]);

            $user = $mysql_user->findUser($request->post->get('username'));

            if ($user) {
                $query = $mysql_user->connect($request->post->get('username'), $request->post->get('password'));

                if ($query != 1) {
                    $request->session->set('authenticated', 1);
                    $request->session->set('username', $request->post->get('username'));
                    $this->addFlash('success', "Vous êtes à présent connecté.");
                    $this->redirect(self::reverse('home'));
                }
                exit();
            } else {
                $this->addFlash('error', 'Les identifiants sont invalides.');
            }
        }
        $this->render(name_file: 'account/login', params: [
            'error' => $error ??= null
        ], title: 'Connexion');
    }

    #[NoReturn] #[Route('/logout', 'logout')] public function logout(Request $request) {
        if (!$this->isAuthenticated()) {
            ErrorController::error404();
        } else {
            $request->session->delete('authenticated');
            setcookie('authenticated', '', time() - INACTIVITY_TIME, '/');
            $request->session->delete(restart_session: true);

            $this->addFlash('success', "Vous avez été déconnecté avec succès !");
            $this->redirect(self::reverse('login'));
        }
    }

}