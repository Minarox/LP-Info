<?php


namespace App\Controllers;



use App\Core\Classes\SuperGlobals\Request;
use App\Core\Classes\Validator;
use App\Core\System\Controller;
use App\Models\UsersModel;

final class ProfileController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->isAuthenticated()) ErrorController::error404();

        $validator = new Validator($_POST);

        if ($validator->isSubmitted()) {
            $validator->validate([
                'delete_confirm' => ['required']
            ]);

            $matchValue = $validator->matchValue([
                'delete_confirm' => 'delete ' . $request->session->get('email')
            ]);

            var_dump($matchValue);

            if ($validator->isSuccess() && $matchValue) {
                (new UsersModel())->delete($request->session->get('id'));

                $request->cookie->delete('token');
                setcookie('token', '', time() - INACTIVITY_TIME, '/');
                $request->session->delete(restart_session: true);

                $this->addFlash('success', "Votre compte a bien été supprimée ! Au revoir {$request->session->get('first_name')} {$request->session->get('last_name')}");
                $this->redirect(header: 'login', response_code: 301);
            } else {
                $this->addFlash('error', 'Le texte que vous avez saisi pour supprimer votre compte ne correspond pas !');
                $this->redirect(header: 'account', response_code: 301);
            }
        }
        $this->render(name_file: 'account/profile', title: 'Profil');
    }

    public function edit(Request $request)
    {
        if (!$this->isAuthenticated()) ErrorController::error404();

        $validator = new Validator($_POST);
        $user = new UsersModel();

        if ($validator->isSubmitted()) {
            $validator->validate([
                'email' => ['required', 'email'],
                'first_name' => ['required'],
                'last_name' => ['required']
            ]);

            if ($validator->isSuccess()) {

                $password = trim($request->post->get('password'));
                $password_verify = trim($request->post->get('password_verify'));

                if (!empty($password) || !empty($password_verify)) {
                    $validator->validate([
                        'password' => ['required', "equal:$password_verify"],
                        'password_verify' => ['required']
                    ]);

                    $password_new = password_hash($password, PASSWORD_ARGON2I);

                    if (!$validator->isSuccess()) {
                        $this->addFlash('error', 'Vos mots de passe doivent correspondre !');
                        $this->redirect(header: 'account/edit', response_code: 301);
                    }

                    if (password_verify($password, $request->session->get('password'))) {
                        $this->addFlash('error', 'Soyez original ! Votre ancien mot de passe est le même !');
                        $this->redirect(header: 'account/edit', response_code: 301);
                    }

                    $user->setPassword($password_new)
                        ->update($request->session->get('id'));

                    $request->session->set('password', $password_new);
                }

                $user->setEmail(Validator::filter($request->post->get('email')))
                    ->setFirstName(Validator::filter($request->post->get('first_name')))
                    ->setLastName(Validator::filter($request->post->get('last_name')))
                    ->update($request->session->get('id'));

                // On met à jours les sessions pour afficher les modifications visuellement
                $request->session->set('email', $request->post->get('email'));
                $request->session->set('first_name', $request->post->get('first_name'));
                $request->session->set('last_name', $request->post->get('last_name'));

                $this->addFlash('success', 'Vos informations ont bien été modifiée !');
                $this->redirect(header: 'account/edit', response_code: 301);
            } else {
                $error = $validator->displayErrors();
            }
        }
        $this->render(name_file: 'account/edit-profile', params: [
            'error' => $error ??= null
        ], title: 'Profil');
    }
}