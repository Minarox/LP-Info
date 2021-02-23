<?php


namespace App\Controllers;


use App\Core\Classes\SuperGlobals\Request;
use App\Core\System\Controller;
use App\Core\Classes\Validator;
use App\Core\Classes\Token;
use App\Models\UsersModel;

final class LoginController extends Controller
{
    public function index(Request $request)
    {
        if ($this->isAuthenticated()) ErrorController::error404();

        $user = new UsersModel();
        $validator = new Validator($_POST);

        if ($validator->isSubmitted()) {

            $data = $user->findOneBy([
                'email' => $_POST['email']
            ]);

            $validator->validate([
                'email' => ['email', 'required'],
                'password' => ['required']
            ]);

            $validator->customErrors([
                'email.0' => 'Vous devez informer un email valide !'
            ]);

            if (!empty($data)) {
                $email = $data->getEmail();
                $password = $data->getPassword();
            }

            $matchValue = $validator->matchValue([
                'email' => $email ??= null,
                'password' => $password ??= null
            ]);

            if ($validator->isSuccess() && $matchValue && password_verify($_POST['password'], $password)) {
                if ($data->isIsVerified() == 0) {
                    $error = 'Veuillez vérifier votre compte !';
                } else {
                    $token = Token::generate(15);

                    $user->setToken($token)
                        ->update($data->getId());

                    $request->cookie->set('token', $token);

                    $list_method = [];

                    foreach (get_class_methods($data) as $method) {
                        if (str_starts_with($method, 'get')) {
                            $list_method[
                                strtolower(preg_replace('#([A-Z])#', '_$1', lcfirst(str_replace("get", "", $method))))
                            ] = call_user_func_array([$data, $method], []);
                        }
                    }

                    foreach ($list_method as $k => $v) $request->session->set($k, $v);

                    $this->addFlash('success', "Bienvenue {$data->getFirstName()} {$data->getLastName()} !");
                    $this->redirect(header: '', response_code: 301);
                }
            } else {
                $error = $validator->displayErrors(['Votre email ou votre mot de passe est invalide !']);
            }
        }

        $this->render(name_file: 'account/login', params: [
            'error' => $error ??= null
        ], title: 'Connexion');
    }
}