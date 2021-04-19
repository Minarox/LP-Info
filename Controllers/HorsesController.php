<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\Classes\Validator;
use App\Core\System\Controller;
use App\Models\Horse_BreedsModel;
use App\Models\Horse_ItemsModel;
use App\Models\Horse_StatusModel;
use App\Models\HorsesModel;
use App\Models\Player_HorsesModel;
use App\Models\PlayersModel;
use App\Models\StatusesModel;

final class HorsesController extends Controller {

    #[Route('/horses', 'horses', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $horses = new HorsesModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $horses->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'horses', response_code: 301);
                }
            }

            $data = [];

            // Pages system
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'];

            $nb_items = $horses->countAll()->nb_items;
            $last_page = ceil($nb_items/NB_PER_PAGE);

            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $horses = $horses->findPageRange($first_of_page, NB_PER_PAGE);
            $i = 0;

            foreach ($horses as $horse) {
                $data[$i]['id'] = $horse->getId();
                $data[$i]['name'] = $horse->getName();
                $data[$i]['breed_id'] = $horse->getBreedId();
                $data[$i]['global_condition'] = $horse->getGlobalCondition();
                $data[$i]['experience'] = $horse->getExperience();
                $data[$i]['level'] = $horse->getLevel();
                $i++;
            }

            $this->render(name_file: 'horses/index', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page
            ], title: 'Horses');
        };
    }

    #[Route('/horse/breeds', 'horse_breeds', ['GET', 'POST'])] public function horseBreeds(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $horse_breeds = new Horse_BreedsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $horse_breeds->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'horse/breeds', response_code: 301);
                }
            }

            $data = [];

            // Pages system
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'];

            $nb_items = $horse_breeds->countAll()->nb_items;
            $last_page = ceil($nb_items/NB_PER_PAGE);

            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $horse_breeds = $horse_breeds->findPageRange($first_of_page, NB_PER_PAGE);
            $i = 0;

            foreach ($horse_breeds as $horse_breed) {
                $data[$i]['id'] = $horse_breed->getId();
                $data[$i]['name'] = $horse_breed->getName();
                $i++;
            }

            $this->render(name_file: 'horses/horse_breeds', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page
            ], title: 'Horse breeds');
        };
    }

    #[Route('/horse/items', 'horse_items', ['GET', 'POST'])] public function horseItems(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $horse_items = new Horse_ItemsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $ids = explode("-", $row);
                        $horseid = $ids[0];
                        $itemid = $ids[1];
                        $horse_items->query("DELETE FROM {$horse_items->getTableName()} WHERE horse_id = $horseid AND item_id = $itemid");
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'horse/items', response_code: 301);
                }
            }

            $data = [];

            // Pages system
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'];

            $nb_items = $horse_items->countAll()->nb_items;
            $last_page = ceil($nb_items/NB_PER_PAGE);

            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $horse_items = $horse_items->findPageRange($first_of_page, NB_PER_PAGE);
            $i = 0;

            foreach ($horse_items as $horse_item) {
                $data[$i]['horse_id'] = $horse_item->getHorseId();
                $data[$i]['item_id'] = $horse_item->getItemId();
                $data[$i]['quantity'] = $horse_item->getQuantity();
                $i++;
            }

            $this->render(name_file: 'horses/horse_items', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page
            ], title: 'Horse items');
        };
    }

    #[Route('/horse/status', 'horse_status', ['GET', 'POST'])] public function horseStatus(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $horse_status = new Horse_StatusModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $ids = explode("-", $row);
                        $horseid = $ids[0];
                        $statusid = $ids[1];
                        $horse_status->query("DELETE FROM {$horse_status->getTableName()} WHERE horse_id = $horseid AND status_id = $statusid");
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'horse/status', response_code: 301);
                }
            }

            $data = [];

            // Pages system
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'];

            $nb_items = $horse_status->countAll()->nb_items;
            $last_page = ceil($nb_items/NB_PER_PAGE);

            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $horse_status = $horse_status->findPageRange($first_of_page, NB_PER_PAGE);
            $i = 0;

            foreach ($horse_status as $row) {
                $data[$i]['horse_id'] = $row->getHorseId();
                $data[$i]['status_id'] = $row->getStatusId();
                $data[$i]['onset_date'] = $row->getOnsetDate();
                $i++;
            }

            $this->render(name_file: 'horses/horse_status', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page
            ], title: 'Horse status');
        }
    }

    #[Route('/statuses', 'statuses', ['GET', 'POST'])] public function statuses(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $statuses = new StatusesModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $statuses->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'statuses', response_code: 301);
                }
            }

            $data = [];

            // Pages system
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'];

            $nb_items = $statuses->countAll()->nb_items;
            $last_page = ceil($nb_items/NB_PER_PAGE);

            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $statuses = $statuses->findPageRange($first_of_page, NB_PER_PAGE);
            $i = 0;

            foreach ($statuses as $status) {
                $data[$i]['id'] = $status->getId();
                $data[$i]['name'] = $status->getName();
                $i++;
            }

            $this->render(name_file: 'horses/statuses', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page
            ], title: 'Statuses');
        }
    }
}
