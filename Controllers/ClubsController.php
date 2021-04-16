<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\Classes\Validator;
use App\Core\System\Controller;
use App\Models\Club_BuildingsModel;
use App\Models\Club_ItemsModel;
use App\Models\Club_MembersModel;
use App\Models\Club_Tournament_RegistrantsModel;
use App\Models\Club_Tournament_RewardsModel;
use App\Models\Club_TournamentsModel;
use App\Models\ClubsModel;
use App\Models\Horse_BreedsModel;
use App\Models\Horse_ItemsModel;
use App\Models\Horse_StatusModel;
use App\Models\HorsesModel;
use App\Models\Player_HorsesModel;
use App\Models\PlayersModel;
use App\Models\StatusesModel;

final class ClubsController extends Controller {

    #[Route('/clubs', 'clubs', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $clubs = new ClubsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $clubs->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'clubs', response_code: 301);
                }
            }

            $clubs = $clubs->findAll();
            $data = [];
            $i = 0;

            foreach ($clubs as $club) {
                $data[$i]['id'] = $club->getId();
                $data[$i]['player_id'] = $club->getPlayerId();
                $data[$i]['buildings_limit'] = $club->getBuildingsLimit();
                $data[$i]['membership_fee'] = $club->getMembershipFee();
                $i++;
            }

            $this->render(name_file: 'clubs/index', params: [
                'data'=> $data
            ], title: 'Clubs');
        };
    }

    #[Route('/club/buildings', 'club_buildings', ['GET', 'POST'])] public function clubBuildings(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $club_buildings = new Club_BuildingsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $ids = explode("-", $row);
                        $clubid = $ids[0];
                        $buildingid = $ids[1];
                        $club_buildings->query("DELETE FROM {$club_buildings->getTableName()} WHERE club_id = $clubid AND building_id = $buildingid");
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'club/buildings', response_code: 301);
                }
            }

            $club_buildings = $club_buildings->findAll();
            $data = [];
            $i = 0;

            foreach ($club_buildings as $club_building) {
                $data[$i]['club_id'] = $club_building->getClubId();
                $data[$i]['building_id'] = $club_building->getBuildingId();
                $data[$i]['quantity'] = $club_building->getQuantity();
                $i++;
            }

            $this->render(name_file: 'clubs/club_buildings', params: [
                'data'=> $data
            ], title: 'Club buildings');
        };
    }

    #[Route('/club/items', 'club_items', ['GET', 'POST'])] public function clubItems(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $club_items = new Club_ItemsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $ids = explode("-", $row);
                        $clubid = $ids[0];
                        $itemid = $ids[1];
                        $club_items->query("DELETE FROM {$club_items->getTableName()} WHERE club_id = $clubid AND item_id = $itemid");
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'club/items', response_code: 301);
                }
            }

            $club_items = $club_items->findAll();
            $data = [];
            $i = 0;

            foreach ($club_items as $club_item) {
                $data[$i]['club_id'] = $club_item->getClubId();
                $data[$i]['item_id'] = $club_item->getItemId();
                $data[$i]['quantity'] = $club_item->getQuantity();
                $i++;
            }

            $this->render(name_file: 'clubs/club_items', params: [
                'data'=> $data
            ], title: 'Club items');
        };
    }

    #[Route('/club/members', 'club_members', ['GET', 'POST'])] public function clubMembers(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $club_members = new Club_MembersModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $ids = explode("-", $row);
                        $clubid = $ids[0];
                        $playerid = $ids[1];
                        $club_members->query("DELETE FROM {$club_members->getTableName()} WHERE club_id = $clubid AND player_id = $playerid");
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'club/members', response_code: 301);
                }
            }

            $club_members = $club_members->findAll();
            $data = [];
            $i = 0;

            foreach ($club_members as $club_item) {
                $data[$i]['club_id'] = $club_item->getClubId();
                $data[$i]['player_id'] = $club_item->getMemberId();
                $i++;
            }

            $this->render(name_file: 'clubs/club_members', params: [
                'data'=> $data
            ], title: 'Club members');
        };
    }

    #[Route('/club/tournaments', 'club_tournaments', ['GET', 'POST'])] public function clubTournaments(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $club_tournaments = new Club_TournamentsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $club_tournaments->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'clubs/tournaments', response_code: 301);
                }
            }

            $club_tournaments = $club_tournaments->findAll();
            $data = [];
            $i = 0;

            foreach ($club_tournaments as $club_tournament) {
                $data[$i]['id'] = $club_tournament->getId();
                $data[$i]['club_id'] = $club_tournament->getClubId();
                $data[$i]['name'] = $club_tournament->getName();
                $i++;
            }

            $this->render(name_file: 'clubs/club_tournaments', params: [
                'data'=> $data
            ], title: 'Club tournaments');
        }
    }

    #[Route('/club/tournament/registrations', 'club_tournament_registrations', ['GET', 'POST'])] public function clubTournamentRegistrations(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $club_tournament_registrations = new Club_Tournament_RegistrantsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $ids = explode("-", $row);
                        $clubtournamentid = $ids[0];
                        $playerid = $ids[1];
                        $club_tournament_registrations->query("DELETE FROM {$club_tournament_registrations->getTableName()} WHERE club_tournament_id = $clubtournamentid AND player_id = $playerid");
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'club/tournament/registrations', response_code: 301);
                }
            }

            $club_tournament_registrations = $club_tournament_registrations->findAll();
            $data = [];
            $i = 0;

            foreach ($club_tournament_registrations as $club_tournament_registration) {
                $data[$i]['club_tournament_id'] = $club_tournament_registration->getClubTournamentId();
                $data[$i]['player_id'] = $club_tournament_registration->getPlayerId();
                $data[$i]['rank'] = $club_tournament_registration->getRank();
                $i++;
            }

            $this->render(name_file: 'clubs/club_tournament_registrations', params: [
                'data'=> $data
            ], title: 'Club tournament registrations');
        }
    }

    #[Route('/club/tournament/rewards', 'club_tournament_rewards', ['GET', 'POST'])] public function clubTournamentRewards(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

            $club_tournament_rewards = new Club_Tournament_RewardsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $club_tournament_rewards->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'club/tournament/rewards', response_code: 301);
                }
            }

            $club_tournament_rewards = $club_tournament_rewards->findAll();
            $data = [];
            $i = 0;

            foreach ($club_tournament_rewards as $club_tournament_reward) {
                $data[$i]['id'] = $club_tournament_reward->getId();
                $data[$i]['club_tournament_id'] = $club_tournament_reward->getClubTournamentId();
                $data[$i]['item_id'] = $club_tournament_reward->getItemId();
                $data[$i]['quantity'] = $club_tournament_reward->getQuantity();
                $data[$i]['obtention_rank'] = $club_tournament_reward->getObtentionRank();
                $i++;
            }

            $this->render(name_file: 'clubs/club_tournament_rewards', params: [
                'data'=> $data
            ], title: 'Club tournament rewards');
        }
    }
}
