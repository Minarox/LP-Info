<?php


namespace App\Controllers;



use App\Core\Classes\SuperGlobals\Cookie;
use App\Core\System\Controller;
use App\Core\Classes\SuperGlobals\Session;
use App\Core\Classes\Validator;
use App\Core\Classes\Token;
use App\Models\UsersModel;
use App\Models\RolesModel;

final class RegisterController extends Controller
{
    public function index()
    {
        if (Cookie::exists('token')) ErrorController::error404();

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
                $user->setLastName(Validator::filter($_POST['last_name']));
                $user->setfirstName(Validator::filter($_POST['first_name']));
                $user->setEmail(Validator::filter($_POST['email']));
                $user->setPassword(password_hash($_POST['password'], PASSWORD_ARGON2I));
                $user->setRoleId($loginRole['id']);
                $user->setToken($token);
                $user->create();

                $header = "From : noreply@hothothot.fr\n";
                $header .= "X-Priority : 1\n";
                $header .= "Content-type: text/html; charset=utf-8\n";
                $header .= "Content-Transfer-Encoding: 8bit\n";

                ob_start();
                include_once __DIR__ . '/../Views/email/register.php';
                $content = ob_get_clean();

                if (!mail(Validator::filter($_POST['email']), 'Votre Inscription chez HotHotHot !', $content, $header)) {
                    $this->addFlash('error', "L'e-mail de confirmation du compte pas pu être envoyé !");
                } else {
                    $this->addFlash('success', "Un email de confirmation vous a été envoyé à l'adresse e-mail : {$_POST['email']}");
                    $this->redirect(header: '/login', response_code: 301);
                }
            } else {
                $error = $validator->displayErrors();
            }
        }

        $this->render(name_file: 'account/register', params: [
            'error'=> $error ??= null
        ], title: 'Inscription');
    }
}