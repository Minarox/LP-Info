<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\Classes\Validator;
use App\Core\System\Controller;
use App\Models\DocumentationModel;
use App\Models\UsersModel;
use JBBCode\DefaultCodeDefinitionSet;
use JBBCode\Parser;

final class HelpController extends Controller {

    #[Route('/help', 'help')] public function index() {
        $this->render(name_file: 'other/help', title: 'Documentation Utilisateur');
    }

    #[Route('/help/framework', 'framework')] public function framework() {
        if (!$this->isAuthenticated()) {
            $this->addFlash('error', 'Vous devez être connecté pour pouvoir accéder à cette page !');
            $this->redirect(self::reverse('login'));
        } else {
            $this->render(name_file: 'other/framework', title: "Documentation Framework");
        }
    }

    #[Route('/help/edition', 'edition', ['GET', 'POST'])] public function edition(Request $request) {
        require_once dirname(__DIR__) . '/Core/Classes/lib/JBBCode/Parser.php';
        require_once dirname(__DIR__) . '/Core/Classes/lib/JBBCode/DefaultCodeDefinitionSet.php';

        $validator = new Validator($_POST);
        $documentations = new DocumentationModel();
        $users = new UsersModel();
        $parser = new Parser();

        if ($validator->isSubmitted('remove-edition')) {
            $documentations->delete($request->post->get('id'));

            $this->addFlash('success', "Votre message à bien été supprimé.");
        }

        $parser->addCodeDefinitionSet(new DefaultCodeDefinitionSET());

        $documentations = $documentations->findAll();

        $data = [];

        foreach ($documentations as $documentation) {
            $parse = $parser->parse($documentation->getContent());
            $user = $users->findOneBy([
                'id' => $documentation->getUserId()
            ]);
            if(!empty($parse->getAsHTML())) {
                $data[] = [
                    'id' => $documentation->getId(),
                    'user_id' => $documentation->getUserId(),
                    'username' => $user->getFirstName(),
                    'title' => $documentation->getTitle(),
                    'content' => $parse->getAsHTML(),
                    'date' => $documentation->getCreatedAt()
                ];
            }
        }

        $this->render(name_file: 'other/edition', params: [
            'documentations'=> $data
        ], title: "Édition", caching: false);
    }

    #[Route('/help/editor', 'editor', ['GET', 'POST'])] public function editor(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->addFlash('error', 'Vous devez être connecté pour pouvoir accéder à cette page !');
            $this->redirect(self::reverse('login'));
        }

        $validator = new Validator($_POST);

        if ($validator->isSubmitted('documentation')) {
            $new_documentation = new DocumentationModel();

            $new_documentation->setUserId($_SESSION['id'])
                ->setTitle($_POST['title'])
                ->setContent($_POST['documentation'])
                ->create();

            $this->addFlash('success', "Votre message à été ajouté.");
            $this->redirect(self::reverse('edition'));
        } else {
            $this->render(name_file: 'other/editor', title: "Éditeur");
        }

    }

    #[Route('/cgu', 'cgu')] public function gcu() {
        $this->render(name_file: 'other/gcu', title: "Conditions Générales d'Utilisation (CGU)");
    }

    #[Route('/mentions-legales', 'mentions-legales')] public function legal_notices() {
        $this->render(name_file: 'other/legal-notices', title: "Mentions légales");
    }
}
