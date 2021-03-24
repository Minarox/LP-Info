<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\System\Controller;
use App\Models\UserModel;

final class HomeController extends Controller {

    #[Route('/', 'home')] public function index() {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            $query = (new UserModel())->query('SHOW GRANTS FOR CURRENT_USER();')->fetch();
            $permissions = array_values(get_object_vars($query));
            $this->render(name_file: 'home', params: [
                'permissions' => $permissions
            ]);
        };
    }

}
