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
    public function index(Request $request)
    {
        if ($this->isAuthenticated()) ErrorController::error404();

        $user = new UsersModel();
        $role = new RolesModel();
        $validator = new Validator($_POST);

        if ($validator->isSubmitted()) {

            $email_post = $request->post->get('email');

            $data = $user->findOneBy([
                'email' => $email_post ??= null
            ]);

            $validator->validate([
                'anti_bot' => ['empty'],
                'last_name' => ['required', 'alpha'],
                'first_name' => ['required'],
                'email' => ['email', 'required'],
                'password' => ['required', "equal:{$request->post->get('password_verify')}"],
                'password_verify' => ['required']
            ]);

            if (!empty($data)) $email = $data->getEmail();

            $matchValue = $validator->matchValue([
                'email' => $email ??= null,
            ]);

            if ($validator->isSuccess() && !$matchValue) {
                $header = "From : no-reply@hothothot.fr\n";
                $header .= "X-Priority : 1\n";
                $header .= "Content-type: text/html; charset=utf-8\n";
                $header .= "Content-Transfer-Encoding: 8bit\n";

                $port = empty($_SERVER['HTTPS']) ? 'http' : 'https';
                $uri = $port . '://' . $_SERVER['HTTP_HOST'] . ROOT . "email/register";

                $token = Token::generate();

                ob_start();
                include_once __DIR__ . '/../Views/email/register.php';
                $content = ob_get_clean();

                if (!mail(Validator::filter($email_post), 'Votre Inscription chez HotHotHot !', $content, $header)) {
                    $this->addFlash('error', "L'e-mail de confirmation du compte n'a pas pu être envoyé !");
                    $this->redirect(header: 'register', response_code: 301);
                }

                $user->setLastName(Validator::filter($request->post->get('last_name')))
                    ->setfirstName(Validator::filter($request->post->get('first_name')))
                    ->setEmail(Validator::filter($email_post))
                    ->setPassword(password_hash($request->post->get('password'), PASSWORD_ARGON2I))
                    ->setRoleId($role->findById(1)->getId())
                    ->setToken($token)
                    ->create();

                $this->addFlash('success', "Un email de confirmation vous a été envoyé à l'adresse e-mail : {$email_post}");
                $this->redirect(header: 'login', response_code: 301);
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

        $payload = $this->googleData($request->post->get('id_token'));

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
                    ->setLastConnexion(date('Y-m-d h:i:s', time()))
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