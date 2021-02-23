<?php


namespace App\Controllers;


use App\Core\Classes\Token;
use App\Core\Classes\Validator;
use App\Core\System\Controller;
use App\Models\UsersModel;

class EmailRegisterController extends Controller
{
    public function index()
    {
        $validator = new Validator($_POST);
        $user = new UsersModel();

        if ($validator->isSubmitted()) {

            $data = $user->findOneBy([
                'token' => $_POST['token_email']
            ]);

            if (!empty($data)) {

                $token = Token::generate(15);

                $user->setIsVerified(1)
                    ->setToken($token)
                    ->update($data->getId());

                $this->addFlash('success', "Votre compte a bien été vérifié ! Veuillez vous connecter avec vos identifiant :)");
                $this->redirect(header: 'login', response_code: 301);
            }

            $this->addFlash('error', "Le lien a déjà été utilisé ou a été expiré !");
            $this->redirect(header: 'login', response_code: 301);
        }
    }
}