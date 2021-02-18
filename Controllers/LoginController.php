<?php


namespace App\Controllers;


use App\Core\Classes\SuperGlobals\Cookie;
use App\Core\Classes\SuperGlobals\Session;
use App\Core\System\Controller;
use App\Core\Classes\Validator;
use App\Core\Classes\Token;
use App\Models\UsersModel;

final class LoginController extends Controller
{
    public function index()
    {
        if (isset($_COOKIE['token'])) ErrorController::error404();

        $user = new UsersModel();
        $validator = new Validator($_POST);

        if ($validator->isSubmitted()) {

            $information = $user->findOneBy([
                'email' => $_POST['email']
            ]);

            $validator->validate([
                'email' => ['email', 'required'],
                'password' => ['required']
            ]);

            $validator->customErrors([
                'email.0' => 'Vous devez informer un email valide !'
            ]);

            $matchValue = $validator->matchValue([
                'email' => $information['email'] ??= null,
                'password' => $information['password'] ??= null
            ]);

            if ($validator->isSuccess() && $matchValue && password_verify($_POST['password'], $information['password'])) {
                if ($information['is_verified'] == 0) {
                    $error = 'Veuillez vérifier votre compte !';
                } else {
                    $token = Token::generate(15);

                    $user->setToken($token);
                    $user->update($information['id']);

                    foreach ($information as $k => $v) Session::set($k, $v);
                    Cookie::set('token', $token);

                    $this->addFlash('success', "Bienvenue {$information['first_name']} {$information['last_name']} !");
                    $this->redirect(header: '/', response_code: 301);
                }
            } else {
                $error = $validator->displayErrors(['Votre email ou votre mot de passe est invalide !']);
            }
        }

        $this->render(name_file: 'account/login', params: [
            'error' => $error ??= null
        ], title: 'Connexion');
    }
}