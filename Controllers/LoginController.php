<?php


namespace App\Controllers;


use App\Core\System\Controller;
use App\Core\Classes\{Token, Validator};
use App\Models\UsersModel;

final class LoginController extends Controller
{
    public function index()
    {
        $this->render(name_file: 'account/login', title: 'Connexion');
    }

    public function loginSystem()
    {
        $user = new UsersModel();
        $validator = new Validator($_POST);

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

            $message = [
                'success' => true
            ];
        } else {
            $message = [
                'message' => $validator->displayErrors(['Votre email ou votre mot de passe est invalide !']),
                'success' => false
            ];
        }

        $this->json($message);
    }
}