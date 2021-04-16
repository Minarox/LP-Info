<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\System\Controller;
use App\Models\AdsModel;
use App\Models\UserModel;

final class HomeController extends Controller {

    #[Route('/', 'home')] public function index() {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            $this->render(name_file: 'home', title: 'Accueil');
        };
    }

}
