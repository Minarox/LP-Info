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

            $data = [];

            // Pages system
            $nb_items = $players->countAll()->nb_items;
            $last_page = ceil($nb_items/NB_PER_PAGE);

            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'];
            if(isset($_POST['page'])) {
                $input_page = $_POST['page'];
                if($input_page < 1) $current_page = 1;
                else if($input_page > $last_page) $current_page = $last_page;
                else $current_page = $_POST['page'];
            }

            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $players = $players->findPageRange($first_of_page, NB_PER_PAGE);
            $i = 0;

            foreach ($players as $player) {
                $data[$i]['id'] = $player->getId();
                $data[$i]['nickname'] = $player->getNickname();
                $data[$i]['mail'] = $player->getMail();
                $data[$i]['logInDateTime'] = $player->getLogInDatetime();
                $i++;
            }

            $this->render(name_file: 'players/index', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
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

            $data = [];

            // Pages system
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'];

            $nb_items = $player_horses->countAll()->nb_items;
            $last_page = ceil($nb_items/NB_PER_PAGE);

            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $player_horses = $player_horses->findPageRange($first_of_page, NB_PER_PAGE);
            $i = 0;

            foreach ($player_horses as $player_horse) {
                $data[$i]['playerid'] = $player_horse->getPlayerId();
                $data[$i]['horseid'] = $player_horse->getHorseId();
                $i++;
            }

            $this->render(name_file: 'players/player_horses', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
            ], title: 'Players horses');
        };
    }
}
