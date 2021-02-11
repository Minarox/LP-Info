<?php


namespace App\Controllers;



use App\Core\System\Controller;
use App\Core\Classes\{Token, Validator};
use App\Models\{RolesModel, UsersModel};

final class RegisterController extends Controller
{
    public function index()
    {
        $user = new UsersModel();
        $role = new RolesModel();
        $validator = new Validator($_POST);

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

                $user->setLastName($_POST['last_name']);
                $user->setfirstName($_POST['first_name']);
                $user->setEmail($_POST['email']);
                $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT));
                $user->setRoleId($loginRole['id']);
                $user->setToken(hash('sha512', $token));
                $user->create();

                foreach ($_POST as $k => $v) $_SESSION[$k] = $v;
                $_SESSION['token'] = $token;
                $this->redirect('/');

            } else {
                $error_message = $validator->displayErrors();
            }
        }

        $this->render(name_file: 'account/register', params: ['error_message'=>$error_message ??= null], title: 'Inscription');
    }
}