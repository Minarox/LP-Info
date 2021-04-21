<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\System\Controller;
use App\Models\Stable_BuildingsModel;
use App\Models\StablesModel;

final class StablesController extends Controller {

    #[Route('/stables', 'stables', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("stables", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            }

            $stables = new StablesModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $stables->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'stables');
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($stables->countLike($search_string, ["id", "player_id", "building_limit"]));
            } else $nb_items = $stables->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $stables = $stables->find($search_string, ["id", "player_id", "building_limit"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($stables as $stable) {
                $data[$i]['id'] = $stable->getId();
                $data[$i]['player_id'] = $stable->getPlayerId();
                $data[$i]['building_limit'] = $stable->getBuildingsLimit();
                $i++;
            }

            $this->render(name_file: 'stables/index', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Stables');
        };
    }

    #[Route('/stable/buildings', 'stable_buildings', ['GET', 'POST'])] public function stableBuildings(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("stable_buildings", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            }

            $stable_buildings = new Stable_BuildingsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $ids = explode("-", $row);
                        $stableid = $ids[0];
                        $buildingid = $ids[1];
                        $stable_buildings->query("DELETE FROM {$stable_buildings->getTableName()} WHERE stable_id = $stableid AND building_id = $buildingid");
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'stable/buildings');
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($stable_buildings->countLike($search_string, ["stable_id", "building_id"]));
            } else $nb_items = $stable_buildings->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $stable_buildings = $stable_buildings->find($search_string, ["stable_id", "building_id"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($stable_buildings as $stable_building) {
                $data[$i]['stable_id'] = $stable_building->getStableId();
                $data[$i]['building_id'] = $stable_building->getBuildingId();
                $i++;
            }

            $this->render(name_file: 'stables/stable_buildings', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Stable buildings');
        };
    }
}
