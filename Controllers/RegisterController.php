<?php


namespace App\Controllers;



use App\Core\System\Controller;
use App\Core\Classes\{Session, Token, Validator};
use App\Models\{RolesModel, UsersModel};

final class RegisterController extends Controller
{
    public function index()
    {
        $user = new UsersModel();
        $role = new RolesModel();
        $validator = new Validator($_POST);
        $session = new Session();

        if ($validator->isSubmitted()) {
            $information = $user->findOneBy([
                'email' => $_POST['email'] ??= null
            ]);

            $loginRole = $role->findById(1);

            $validator->validate([
                'last_name' => ['required'],
                'first_name' => ['required'],
                'email' => ['email', 'required'],
                'password' => ['required', "equal:{$_POST['password_verify']}"],
                'password_verify' => ['required']
            ]);

            $matchValue = $validator->matchValue([
                'email' => $information['email'] ??= null,
            ]);

            if ($validator->isSuccess() && !$matchValue) {
                $token = Token::generate(15);

                $user->setLastName(Validator::filterInput($_POST['last_name']));
                $user->setfirstName(Validator::filterInput($_POST['first_name']));
                $user->setEmail(Validator::filterInput($_POST['email']));
                $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT));
                $user->setRoleId($loginRole['id']);
                $user->setToken(hash('sha512', $token));
                $user->create();

                $header = "From : noreply@hothothot.fr\n";
                $header .= "X-Priority : 1\n";
                $header .= "Content-type: text/html; charset=utf-8\n";
                $header .= "Content-Transfer-Encoding: 8bit\n";

                $content = file_get_contents(__DIR__ . '/../Views/email/register.php');

                if (!mail(Validator::filterInput($_POST['email']), 'Votre Inscription chez HotHotHot !', $content, $header)) {
                    $session->set('error', "L'e-mail n'a pas pu être envoyé !");
                } else {
                    $session->set('success', "Un email de confirmation vous a été envoyé à l'adresse e-mail : {$_POST['email']}");
                    $this->redirect('/login');
                }

//                foreach ($_POST as $k => $v) $session->set($k, $v);
//                $session->set('token', $token);
//                $this->redirect('/');

            } else {
                $error_message = $validator->displayErrors();
            }
        }

        $this->render(name_file: 'account/register', params: ['error_message'=>$error_message ??= null], title: 'Inscription');
    }
}