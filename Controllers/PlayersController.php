<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\System\Controller;
use App\Models\Player_HorsesModel;
use App\Models\PlayersModel;

final class PlayersController extends Controller {

    #[Route('/players', 'players', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("players", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("players", $tables)) {
                    $position = array_search("players", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

            $players = new PlayersModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $players->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'players');
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($players->countLike($search_string, ["id", "nickname", "mail"]));
            } else $nb_items = $players->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $players = $players->find($search_string, ["id", "nickname", "mail"], $first_of_page, NB_PER_PAGE);

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
                'search'=> $search_string,
                'permissions'=> $permissions,
            ], title: 'Players');
        };
    }

    #[Route('/player/horses', 'player_horses', ['GET', 'POST'])] public function playerHorses(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("player_horses", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("player_horses", $tables)) {
                    $position = array_search("player_horses", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

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
                    $this->redirect(header: 'player/horses');
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($player_horses->countLike($search_string, ["player_id", "horse_id"]));
            } else $nb_items = $player_horses->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $player_horses = $player_horses->find($search_string, ["player_id", "horse_id"], $first_of_page, NB_PER_PAGE);

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
                'search'=> $search_string,
                'permissions'=> $permissions,
            ], title: 'Players horses');
        };
    }
}
