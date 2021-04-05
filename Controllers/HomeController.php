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
            // Table de test, "Fatal error" si l'utilisateur n'a pas accès à celle-ci
            $ads = new AdsModel();
            $table = $ads->getTableName();
            $columns = $ads->getColumnsNames();
            $raw_data = $ads->findAll();

            $data = [];
            for ($i = 0; $i < count($raw_data); $i++) {
                $values = array_values((array) $raw_data[$i]);
                array_pop($values);
                $data[$i] = $values;
            }

            $this->render(name_file: 'home', params: [
                'table' => $table,
                'columns' => $columns,
                'data' => $data
            ]);
        };
    }

}
