<?php

namespace App\Controllers;

use App\Core\Classes\SuperGlobals\Request;
use App\Core\Classes\Token;
use App\Core\Classes\Validator;
use App\Core\System\Controller;
use App\Models\UsersModel;
use JetBrains\PhpStorm\NoReturn;

final class RecoveryController extends Controller {

    #[NoReturn] public function index(Request $request) {
        $validator = new Validator($_POST);
        $timestamp = $request->get->get('timestamp') ?: $request->post->get('timestamp');
        $user_id = $request->get->get('user_id') ?: $request->post->get('user_id');

        if ($timestamp && $user_id) {
            $current_time = time();
            $timestamp = $request->get->get('timestamp');

            if ($current_time - $timestamp > PASSWORD_RECOVERY_TIME) {
                $this->addFlash('error', "Le lien de récupération de mot de passe a expiré");
                $this->redirect(header: 'login', response_code: 301);
            }

            $user = new UsersModel();
            $user = $user->findOneBy([
                'id' => $user_id
            ]);

            if(!$user) {
                $this->addFlash('error', "Une erreur est survenue avec l'utilisateur !");
                $this->redirect(header: 'login', response_code: 301);
            }

            if ($validator->isSubmitted()) {
                if(!$_POST['password'] || !$_POST['password-verif']) {
                    $this->addFlash('error', "Une erreur est survenue dans le formulaire !");
                    $this->redirect(header: 'login', response_code: 301);
                }

                $matchValue = $validator->matchValue([
                    'password' => $_POST['password-verif'],
                ]);

                if(!$matchValue) {
                    $this->addFlash('error', "Les deux mots de passe ne correspondent pas !");
                    $this->redirect(header: 'recovery?timestamp=' . $timestamp . '&user_id=' . $user_id, response_code: 301);
                }

                $passwords_match = password_verify($request->post->get('password'), $user->getPassword());

                if($passwords_match) {
                    $this->addFlash('error', "Vous avez entré votre ancien mot de passe, essayer de l'utiliser pour vous connecter !");
                    $this->redirect(header: 'login', response_code: 301);
                }

                $token = Token::generate();
                $user->setPassword(password_hash($request->post->get('password'), PASSWORD_ARGON2I))
                    ->setToken($token)
                    ->update($user_id);

                $this->addFlash('success', "Votre mot de passe a bien été modifié !");
                $this->redirect(header: 'login', response_code: 301);
            }

            $this->render(name_file: 'account/recovery', params: [
                'timestamp' => $timestamp,
                'user_id' => $user_id
            ], title: 'Récupération mot de passe');
        }

        ErrorController::error404();
    }

}
