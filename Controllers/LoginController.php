<?php


namespace App\Controllers;


use App\Core\System\Controller;
use App\Core\Classes\{Session, Token, Validator};
use App\Models\UsersModel;

final class LoginController extends Controller
{

    public function index()
    {
        $user = new UsersModel();
        $validator = new Validator($_POST);
        $session = new Session();

        if (isset($_SESSION['success'])) {
            $message_success = $session->get('success');
            $session->delete('success');
        }

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
                    $error_message = 'Veuillez vérifier votre compte !';
                } else {
                    $token = Token::generate(15);

                    $user->setId($information['id']);
                    $user->setToken(hash('sha512', $token));
                    $user->update();

                    foreach ($information as $k => $v) $session->set($k, $v);
                    $session->set('token', $token);
                    $this->redirect('/');
                }
            } else {
                $error_message = $validator->displayErrors(['Votre email ou votre mot de passe est invalide !']);
            }
        }
        $this->render(name_file: 'account/login', params: [
            'error_message' => $error_message ??= null,
            'message_success' => $message_success ??= null,
        ], title: 'Connexion');
    }
}