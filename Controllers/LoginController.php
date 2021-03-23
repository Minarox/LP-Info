<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\System\Controller;
use App\Core\Classes\Validator;
use App\Models\UserModel;

final class LoginController extends Controller {

    #[Route('/login', 'login', ['GET', 'POST'])] public function index(Request $request) {

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

                define('DB_NAME', 'horse_sim');
                define('DB_USER', $request->post->get('username'));
                define('DB_PASS', $request->post->get('password'));

                $user = $mysql_user->findUser($request->post->get('username'));
                var_dump($user);
                exit();

                $request->cookie->set('authenticated', 1);
                $request->cookie->set('username', $request->post->get('username'));

                $this->addFlash('success', "Vous êtes à présent connecté.");
                $this->redirect(self::reverse('home'));
            } else {
                $this->addFlash('error', 'Les identifiants sont invalides.');
            }
    }
        $this->render(name_file: 'account/login', params: [
            'error' => $error ??= null
        ], title: 'Connexion');
    }

}
