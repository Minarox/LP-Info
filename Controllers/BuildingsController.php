<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\Classes\Validator;
use App\Core\System\Controller;
use App\Models\AdsModel;
use App\Models\Automatic_Task_ActionsModel;
use App\Models\Automatic_TasksModel;
use App\Models\Building_FamiliesModel;
use App\Models\Building_ItemsModel;
use App\Models\Building_TypesModel;
use App\Models\BuildingsModel;
use App\Models\HorsesModel;
use App\Models\NewsModel;
use App\Models\Newspaper_AdsModel;
use App\Models\NewspapersModel;
use App\Models\Player_HorsesModel;
use App\Models\PlayersModel;
use App\Models\Upcoming_EventsModel;
use App\Models\WeathersModel;

final class BuildingsController extends Controller {

    #[Route('/buildings', 'buildings', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $buildings = new BuildingsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $buildings->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'buildings', response_code: 301);
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($buildings->countLike($search_string, ["id", "building_type_id", "description", "level"]));
            } else $nb_items = $buildings->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $buildings = $buildings->find($search_string, ["id", "building_type_id", "description", "level"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($buildings as $building) {
                $data[$i]['id'] = $building->getId();
                $data[$i]['building_type_id'] = $building->getBuildingTypeId();
                $data[$i]['description'] = $building->getDescription();
                $data[$i]['level'] = $building->getLevel();
                $i++;
            }

            $this->render(name_file: 'buildings/index', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Buildings');
        };
    }

    #[Route('/building/families', 'building_families', ['GET', 'POST'])] public function buildingFamilies(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $building_families = new Building_FamiliesModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $building_families->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'building/families', response_code: 301);
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($building_families->countLike($search_string, ["id", "name"]));
            } else $nb_items = $building_families->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $building_families = $building_families->find($search_string, ["id", "name"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($building_families as $building_family) {
                $data[$i]['id'] = $building_family->getId();
                $data[$i]['name'] = $building_family->getName();
                $i++;
            }

            $this->render(name_file: 'buildings/building_families', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Building families');
        };
    }

    #[Route('/building/items', 'building_items', ['GET', 'POST'])] public function buildingItems(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $building_items = new Building_ItemsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $ids = explode("-", $row);
                        $buildingid = $ids[0];
                        $itemid = $ids[1];
                        $building_items->query("DELETE FROM {$building_items->get()} WHERE building_id = $buildingid AND item_id = $itemid");
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'building/items', response_code: 301);
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($building_items->countLike($search_string, ["building_id", "item_id", "quantity"]));
            } else $nb_items = $building_items->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $building_items = $building_items->find($search_string, ["building_id", "item_id", "quantity"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($building_items as $row) {
                $data[$i]['building_id'] = $row->getBuildingId();
                $data[$i]['item_id'] = $row->getItemId();
                $data[$i]['quantity'] = $row->getQuantity();
                $i++;
            }

            $this->render(name_file: 'buildings/building_items', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Building items');
        };
    }

    #[Route('/building/types', 'building_types', ['GET', 'POST'])] public function buildingTypes(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $building_types = new Building_TypesModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $building_types->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'building/types', response_code: 301);
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($building_types->countLike($search_string, ["id", "name", "items_limit", "horses_limit"]));
            } else $nb_items = $building_types->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $building_types = $building_types->find($search_string, ["id", "name", "items_limit", "horses_limit"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($building_types as $building_type) {
                $data[$i]['id'] = $building_type->getId();
                $data[$i]['name'] = $building_type->getName();
                $data[$i]['items_limit'] = $building_type->getItemsLimit();
                $data[$i]['horses_limit'] = $building_type->getHorsesLimit();
                $i++;
            }

            $this->render(name_file: 'buildings/building_types', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Building types');
        };
    }

    #[Route('/automatic', 'automatic_tasks', ['GET', 'POST'])] public function automaticTasks(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $automatic_tasks = new Automatic_TasksModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $automatic_tasks->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'automatic', response_code: 301);
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($automatic_tasks->countLike($search_string, ["id", "automatic_task_action_id", "stable_building_id", "item_id", "frequency"]));
            } else $nb_items = $automatic_tasks->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $automatic_tasks = $automatic_tasks->find($search_string, ["id", "automatic_task_action_id", "stable_building_id", "item_id", "frequency"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($automatic_tasks as $automatic_task) {
                $data[$i]['id'] = $automatic_task->getId();
                $data[$i]['automatic_task_action_id'] = $automatic_task->getAutomaticTaskActionId();
                $data[$i]['stable_building_id'] = $automatic_task->getStableBuildingId();
                $data[$i]['item_id'] = $automatic_task->getItemId();
                $data[$i]['frequency'] = $automatic_task->getFrequency();
                $i++;
            }

            $this->render(name_file: 'buildings/automatic_tasks', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Building automatic tasks');
        };
    }

    #[Route('/automatic/actions', 'automatic_task_actions', ['GET', 'POST'])] public function automaticTaskAction(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $automatic_task_actions = new Automatic_Task_ActionsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $automatic_task_actions->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'automatic/actions', response_code: 301);
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($automatic_task_actions->countLike($search_string, ["id", "name"]));
            } else $nb_items = $automatic_task_actions->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $automatic_task_actions = $automatic_task_actions->find($search_string, ["id", "name"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($automatic_task_actions as $automatic_task_action) {
                $data[$i]['id'] = $automatic_task_action->getId();
                $data[$i]['name'] = $automatic_task_action->getName();
                $i++;
            }

            $this->render(name_file: 'buildings/automatic_task_actions', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Building automatic task actions');
        };
    }
}
