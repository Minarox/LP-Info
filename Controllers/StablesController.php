<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\Classes\Validator;
use App\Core\System\Controller;
use App\Models\Stable_BuildingsModel;
use App\Models\StablesModel;

final class StablesController extends Controller {

    #[Route('/stables', 'stables', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $stables = new StablesModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $stables->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'stables', response_code: 301);
                }
            }

            $stables = $stables->findAll();
            $data = [];
            $i = 0;

            foreach ($stables as $stable) {
                $data[$i]['id'] = $stable->getId();
                $data[$i]['player_id'] = $stable->getPlayerId();
                $data[$i]['building_limit'] = $stable->getBuildingsLimit();
                $i++;
            }

            $this->render(name_file: 'stables/index', params: [
                'data'=> $data
            ], title: 'Stables');
        };
    }

    #[Route('/stable/buildings', 'stable_buildings', ['GET', 'POST'])] public function stableBuildings(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

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
                    $this->redirect(header: 'stable/buildings', response_code: 301);
                }
            }

            $stable_buildings = $stable_buildings->findAll();
            $data = [];
            $i = 0;

            foreach ($stable_buildings as $stable_building) {
                $data[$i]['stable_id'] = $stable_building->getStableId();
                $data[$i]['building_id'] = $stable_building->getBuildingId();
                $i++;
            }

            $this->render(name_file: 'stables/stable_buildings', params: [
                'data'=> $data
            ], title: 'Stable buildings');
        };
    }
}
