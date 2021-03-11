<?php


namespace App\Controllers;


use App\Core\Classes\SuperGlobals\Request;
use App\Core\Classes\Token;
use App\Core\System\Controller;
use App\Models\UsersModel;
use JetBrains\PhpStorm\NoReturn;

class EmailRegisterController extends Controller
{
    #[NoReturn] public function index(Request $request)
    {
        if (!$request->get->exists('token_email')) ErrorController::error404();

        $user = new UsersModel();

        $data = $user->findOneBy([
            'token' => $request->get->get('token_email')
        ]);

        if (!empty($data)) {

            $token = Token::generate();

            $user->setIsVerified(1)
                ->setToken($token)
                ->update($data->getId());

            $this->addFlash('success', "Votre compte a bien été vérifié ! Veuillez vous connecter avec vos identifiant :)");
            $this->redirect(header: 'login', response_code: 301);
        }

        $this->addFlash('error', "Le lien a déjà été utilisé ou est expiré !");
        $this->redirect(header: 'login', response_code: 301);
    }
}