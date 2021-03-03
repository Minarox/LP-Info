<?php


namespace App\Controllers;



use App\Core\Classes\SuperGlobals\Request;
use App\Core\System\Controller;
use App\Core\Classes\Validator;
use App\Core\Classes\Token;
use App\Models\UsersModel;
use App\Models\RolesModel;

final class RegisterController extends Controller
{
    public function index()
    {
        if ($this->isAuthenticated()) ErrorController::error404();

        $user = new UsersModel();
        $role = new RolesModel();
        $validator = new Validator($_POST);

        if ($validator->isSubmitted()) {

            $data = $user->findOneBy([
                'email' => $_POST['email'] ??= null
            ]);

            $data_role = $role->findById(1);

            $validator->validate([
                'anti_bot' => ['empty'],
                'last_name' => ['required', 'alpha'],
                'first_name' => ['required'],
                'email' => ['email', 'required'],
                'password' => ['required', "equal:{$_POST['password_verify']}"],
                'password_verify' => ['required']
            ]);

            if (!empty($data)) $email = $data->getEmail();

            $matchValue = $validator->matchValue([
                'email' => $email ??= null,
            ]);

            if ($validator->isSuccess() && !$matchValue) {
                $token = Token::generate();

                $user->setLastName(Validator::filter($_POST['last_name']))
                    ->setfirstName(Validator::filter($_POST['first_name']))
                    ->setEmail(Validator::filter($_POST['email']))
                    ->setPassword(password_hash($_POST['password'], PASSWORD_ARGON2I))
                    ->setRoleId($data_role->getId())
                    ->setToken($token)
                    ->create();

                $header = "From : no-reply@hothothot.fr\n";
                $header .= "X-Priority : 1\n";
                $header .= "Content-type: text/html; charset=utf-8\n";
                $header .= "Content-Transfer-Encoding: 8bit\n";

                $port = empty($_SERVER['HTTPS']) ? 'http' : 'https';
                $uri = $port . '://' . $_SERVER['HTTP_HOST'] . ROOT . "email/register";

                ob_start();
                include_once __DIR__ . '/../Views/email/register.php';
                $content = ob_get_clean();

                if (!mail(Validator::filter($_POST['email']), 'Votre Inscription chez HotHotHot !', $content, $header)) {
                    $this->addFlash('error', "L'e-mail de confirmation du compte n'a pas pu être envoyé !");
                } else {
                    $this->addFlash('success', "Un email de confirmation vous a été envoyé à l'adresse e-mail : {$_POST['email']}");
                    $this->redirect(header: 'login', response_code: 301);
                }
            } else {
                $error = $matchValue ? $validator->displayErrors(['Cette e-mail est déjà utilisé !']) : $validator->displayErrors();
            }
        }

        $this->render(name_file: 'account/register', params: [
            'error'=> $error ??= null
        ], title: 'Inscription');
    }

    public function google(Request $request)
    {
        $user = new UsersModel();
        $role = new RolesModel();

        $payload = $this->googleData($_POST['id_token']);

        if ($payload) {
            $data_role = $role->findById(1);

            $data = $user->findOneBy([
                'email' => $payload['email'] ??= null
            ]);

            if (!empty($data)) {
                $this->addFlash('error', 'Cette adresse e-mail a déjà été utilisé pour se connecter à ce site !');
            } else {
                $token = Token::generate();

                $user->setIdGoogle((int) $payload['sub'])
                    ->setLastName($payload['family_name'])
                    ->setfirstName($payload['given_name'])
                    ->setEmail($payload['email'])
                    ->setIsVerified(1)
                    ->setAvatar($payload['picture'])
                    ->setRoleId($data_role->getId())
                    ->setToken($token)
                    ->create();

                $request->session->set('last_name', $payload['family_name']);
                $request->session->set('first_name', $payload['given_name']);
                $request->session->set('email', $payload['email']);
                $request->session->set('avatar', $payload['picture']);
                $request->session->set('token', $token);
                $request->session->set('created_at', date("Y-m-d H:i:s"));

                $request->cookie->set('token', $token, '/');

                $this->addFlash('success', "Bienvenue {$payload['given_name']} {$payload['family_name']} !");
            }
        } else {
            $this->addFlash('error', "Erreur lors de l'inscription avec Google !");
        }
    }
}