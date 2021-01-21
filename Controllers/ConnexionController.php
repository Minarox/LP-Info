<?php


namespace App\Controllers;



use App\Core\Classes\{Token, Validator};
use App\Models\UsersModel;

final class ConnexionController extends Controller
{
    public function index()
    {
        $user = new UsersModel();
        $validator = new Validator($_POST);

        if ($validator->isSubmitted()) {

            $information = $user->findOneBy([
                'email' => $_POST['email'],
                'password' => $_POST['password']
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

            if ($validator->isValid() && $matchValue) {
                $token = Token::generate(15);

                $user->setId($information['id']);
                $user->setToken(hash('sha512', $token));
                $user->update();

                $_SESSION['last_name'] = $information['last_name'];
                $_SESSION['first_name'] = $information['first_name'];
                $_SESSION['avatar'] = $information['avatar'];
                $_SESSION['id'] = $information['id'];
                $_SESSION['token'] = $token;

                $this->redirect('/');
            } else {
                $_SESSION['errors'] = $validator->displayErrors(['Votre email ou votre mot de passe est invalide !']);
            }
        }

        $this->render(name_file: 'hothothot/pages/connexion');
    }
}