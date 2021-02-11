<?php


namespace App\Controllers;


use App\Core\System\Controller;
use http\Exception\InvalidArgumentException;
use App\Core\Classes\{Token, Validator};
use App\Models\UsersModel;

final class LoginController extends Controller
{
    public function index()
    {
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
                $token = Token::generate(15);

                $user->setId($information['id']);
                $user->setToken(hash('sha512', $token));
                $user->update();

                foreach ($information as $k => $v) $_SESSION[$k] = $v;
                $_SESSION['token'] = $token;
                $this->redirect('/');

            } else {
                $error_message = $validator->displayErrors(['Votre email ou votre mot de passe est invalide !']);
            }
        }
        $this->render(name_file: 'account/login', params: ['error_message'=>$error_message ??= null], title: 'Connexion');
    }
}