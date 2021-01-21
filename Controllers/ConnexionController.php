<?php


namespace App\Controllers;



use App\Core\Classes\Token;
use App\Core\Classes\Validator;
use App\Models\UsersModel;

final class ConnexionController extends Controller
{
    public function index()
    {
        $user = new UsersModel();


        if (isset($_POST['login'])) {

            $information = $user->findOneBy([
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ]);

            var_dump($information);

            $validator = new Validator([
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ]);

            if (!empty($information)) {
                $validator->validate([
                    'email' => [
                        'required', 'email', 'equal:' . $information['email']
                    ],
                    'password' => [
                        'required', 'equal:' . $information['password']
                    ]
                ]);

                if ($validator->isSuccess()) {
                    $token = Token::generate(15);
                    $_SESSION['user']['token'] = $token;
                    $_SESSION['user']['id'] = $information['id'];
                    header('Location: /');
                    die();
                }
            } else {
                $_SESSION['error'] = 'Votre email ou votre mot de passe est invalide !';
            }
        }

        $this->render(name_file: 'hothothot/pages/connexion');
    }
}