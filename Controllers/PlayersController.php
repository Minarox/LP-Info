<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\Classes\Validator;
use App\Core\System\Controller;
use App\Models\HorsesModel;
use App\Models\Player_HorsesModel;
use App\Models\PlayersModel;

final class PlayersController extends Controller {

    #[Route('/players', 'players', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $players = new PlayersModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $players->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'players', response_code: 301);
                }
            }

            $players = $players->findAll();
            $data = [];
            $i = 0;

            foreach ($players as $player) {
                $data[$i]['id'] = $player->getId();
                $data[$i]['nickname'] = $player->getNickname();
                $data[$i]['mail'] = $player->getMail();
                $data[$i]['logInDateTime'] = $player->getLogInDatetime();
                $i++;
            }

            $this->render(name_file: 'players/index', params: [
                'data'=> $data
            ], title: 'Players');
        };
    }

    #[Route('/player/horses', 'player_horses', ['GET', 'POST'])] public function playerHorses(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $player_horses = new Player_HorsesModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $ids = explode("-", $row);
                        $playerid = $ids[0];
                        $horseid = $ids[1];
                        $player_horses->query("DELETE FROM {$player_horses->getTableName()} WHERE player_id = $playerid AND horse_id = $horseid");
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'player/horses', response_code: 301);
                }
            }

            $player_horses = $player_horses->findAll();
            $data = [];
            $i = 0;

            foreach ($player_horses as $player_horse) {
                $data[$i]['playerid'] = $player_horse->getPlayerId();
                $data[$i]['horseid'] = $player_horse->getHorseId();
                $i++;
            }

            $this->render(name_file: 'players/player_horses', params: [
                'data'=> $data
            ], title: 'Players horses');
        };
    }
}
