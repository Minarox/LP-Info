<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\System\Controller;

final class TemplateController extends Controller {

    #[Route('/template', 'template', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            $this->render(name_file: 'template/template', title: 'Template');
        };
    }
}
