<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\System\Controller;
use App\Models\Club_BuildingsModel;
use App\Models\Club_ItemsModel;
use App\Models\Club_MembersModel;
use App\Models\Club_Tournament_RegistrantsModel;
use App\Models\Club_Tournament_RewardsModel;
use App\Models\Club_TournamentsModel;
use App\Models\ClubsModel;

final class ClubsController extends Controller {

    #[Route('/clubs', 'clubs', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("clubs", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("clubs", $tables)) {
                    $position = array_search("clubs", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

            $clubs = new ClubsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $clubs->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'clubs');
                }
            }

            $data = [];

            $search_string = "";
            $filter = "";
            $order = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($clubs->countLike($search_string, ["id", "player_id", "buildings_limit", "membership_fee"]));
            } else $nb_items = $clubs->countAll()->nb_items;
            if(isset($_GET['filter'])) $filter = $_GET['filter'];
            if(isset($_GET['order'])) $order = $_GET['order'];

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $clubs = $clubs->find($search_string, ["id", "player_id", "buildings_limit", "membership_fee"], $first_of_page, NB_PER_PAGE, $filter, $order);

            $i = 0;

            foreach ($clubs as $club) {
                $data[$i]['id'] = $club->getId();
                $data[$i]['player_id'] = $club->getPlayerId();
                $data[$i]['buildings_limit'] = $club->getBuildingsLimit();
                $data[$i]['membership_fee'] = $club->getMembershipFee();
                $i++;
            }

            $this->render(name_file: 'clubs/index', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
                'permissions'=> $permissions,
                'filter'=> $filter,
                'order'=> $order,
            ], title: 'Clubs');
        };
    }

    #[Route('/club/buildings', 'club_buildings', ['GET', 'POST'])] public function clubBuildings(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("club_buildings", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("club_buildings", $tables)) {
                    $position = array_search("club_buildings", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

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
                    $this->redirect(header: 'club/buildings');
                }
            }

            $data = [];

            $search_string = "";
            $filter = "";
            $order = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($club_buildings->countLike($search_string, ["club_id", "building_id", "quantity"]));
            } else $nb_items = $club_buildings->countAll()->nb_items;
            if(isset($_GET['filter'])) $filter = $_GET['filter'];
            if(isset($_GET['order'])) $order = $_GET['order'];

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $club_buildings = $club_buildings->find($search_string, ["club_id", "building_id", "quantity"], $first_of_page, NB_PER_PAGE, $filter, $order);

            $i = 0;

            foreach ($club_buildings as $club_building) {
                $data[$i]['club_id'] = $club_building->getClubId();
                $data[$i]['building_id'] = $club_building->getBuildingId();
                $data[$i]['quantity'] = $club_building->getQuantity();
                $i++;
            }

            $this->render(name_file: 'clubs/club_buildings', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
                'permissions'=> $permissions,
                'filter'=> $filter,
                'order'=> $order,
            ], title: 'Club buildings');
        };
    }

    #[Route('/club/items', 'club_items', ['GET', 'POST'])] public function clubItems(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("club_items", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("club_items", $tables)) {
                    $position = array_search("club_items", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

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
                    $this->redirect(header: 'club/items');
                }
            }

            $data = [];

            $search_string = "";
            $filter = "";
            $order = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($club_items->countLike($search_string, ["club_id", "item_id", "quantity"]));
            } else $nb_items = $club_items->countAll()->nb_items;
            if(isset($_GET['filter'])) $filter = $_GET['filter'];
            if(isset($_GET['order'])) $order = $_GET['order'];

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $club_items = $club_items->find($search_string, ["club_id", "item_id", "quantity"], $first_of_page, NB_PER_PAGE, $filter, $order);

            $i = 0;

            foreach ($club_items as $club_item) {
                $data[$i]['club_id'] = $club_item->getClubId();
                $data[$i]['item_id'] = $club_item->getItemId();
                $data[$i]['quantity'] = $club_item->getQuantity();
                $i++;
            }

            $this->render(name_file: 'clubs/club_items', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
                'permissions'=> $permissions,
                'filter'=> $filter,
                'order'=> $order,
            ], title: 'Club items');
        };
    }

    #[Route('/club/members', 'club_members', ['GET', 'POST'])] public function clubMembers(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("club_members", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("club_members", $tables)) {
                    $position = array_search("club_members", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

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
                    $this->redirect(header: 'club/members');
                }
            }

            $data = [];

            $search_string = "";
            $filter = "";
            $order = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($club_members->countLike($search_string, ["club_id", "player_id"]));
            } else $nb_items = $club_members->countAll()->nb_items;
            if(isset($_GET['filter'])) $filter = $_GET['filter'];
            if(isset($_GET['order'])) $order = $_GET['order'];

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $club_members = $club_members->find($search_string, ["club_id", "player_id"], $first_of_page, NB_PER_PAGE, $filter, $order);

            $i = 0;

            foreach ($club_members as $club_item) {
                $data[$i]['club_id'] = $club_item->getClubId();
                $data[$i]['player_id'] = $club_item->getPlayerId();
                $i++;
            }

            $this->render(name_file: 'clubs/club_members', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
                'permissions'=> $permissions,
                'filter'=> $filter,
                'order'=> $order,
            ], title: 'Club members');
        };
    }

    #[Route('/club/tournaments', 'club_tournaments', ['GET', 'POST'])] public function clubTournaments(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("club_tournaments", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("club_tournaments", $tables)) {
                    $position = array_search("club_tournaments", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

            $club_tournaments = new Club_TournamentsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $club_tournaments->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'clubs/tournaments');
                }
            }

            $data = [];

            $search_string = "";
            $filter = "";
            $order = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($club_tournaments->countLike($search_string, ["id", "club_id", "name"]));
            } else $nb_items = $club_tournaments->countAll()->nb_items;
            if(isset($_GET['filter'])) $filter = $_GET['filter'];
            if(isset($_GET['order'])) $order = $_GET['order'];

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $club_tournaments = $club_tournaments->find($search_string, ["id", "club_id", "name"], $first_of_page, NB_PER_PAGE, $filter, $order);

            $i = 0;

            foreach ($club_tournaments as $club_tournament) {
                $data[$i]['id'] = $club_tournament->getId();
                $data[$i]['club_id'] = $club_tournament->getClubId();
                $data[$i]['name'] = $club_tournament->getName();
                $i++;
            }

            $this->render(name_file: 'clubs/club_tournaments', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
                'permissions'=> $permissions,
                'filter'=> $filter,
                'order'=> $order,
            ], title: 'Club tournaments');
        }
    }

    #[Route('/club/tournament/registrations', 'club_tournament_registrations', ['GET', 'POST'])] public function clubTournamentRegistrations(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("club_tournament_registrants", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("club_tournament_registrants", $tables)) {
                    $position = array_search("club_tournament_registrants", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

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
                    $this->redirect(header: 'club/tournament/registrations');
                }
            }

            $data = [];

            $search_string = "";
            $filter = "";
            $order = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($club_tournament_registrations->countLike($search_string, ["club_tournament_id", "player_id", "rank"]));
            } else $nb_items = $club_tournament_registrations->countAll()->nb_items;
            if(isset($_GET['filter'])) $filter = $_GET['filter'];
            if(isset($_GET['order'])) $order = $_GET['order'];

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $club_tournament_registrations = $club_tournament_registrations->find($search_string, ["club_tournament_id", "player_id", "rank"], $first_of_page, NB_PER_PAGE, $filter, $order);

            $i = 0;

            foreach ($club_tournament_registrations as $club_tournament_registration) {
                $data[$i]['club_tournament_id'] = $club_tournament_registration->getClubTournamentId();
                $data[$i]['player_id'] = $club_tournament_registration->getPlayerId();
                $data[$i]['rank'] = $club_tournament_registration->getRank();
                $i++;
            }

            $this->render(name_file: 'clubs/club_tournament_registrations', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
                'permissions'=> $permissions,
                'filter'=> $filter,
                'order'=> $order,
            ], title: 'Club tournament registrations');
        }
    }

    #[Route('/club/tournament/rewards', 'club_tournament_rewards', ['GET', 'POST'])] public function clubTournamentRewards(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("club_tournament_rewards", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("club_tournament_rewards", $tables)) {
                    $position = array_search("club_tournament_rewards", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

            $club_tournament_rewards = new Club_Tournament_RewardsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $club_tournament_rewards->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'club/tournament/rewards');
                }
            }

            $data = [];

            $search_string = "";
            $filter = "";
            $order = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($club_tournament_rewards->countLike($search_string, ["id", "club_tournament_id", "item_id", "quantity", "obtention_rank"]));
            } else $nb_items = $club_tournament_rewards->countAll()->nb_items;
            if(isset($_GET['filter'])) $filter = $_GET['filter'];
            if(isset($_GET['order'])) $order = $_GET['order'];

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $club_tournament_rewards = $club_tournament_rewards->find($search_string, ["id", "club_tournament_id", "item_id", "quantity", "obtention_rank"], $first_of_page, NB_PER_PAGE, $filter, $order);

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
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
                'permissions'=> $permissions,
                'filter'=> $filter,
                'order'=> $order,
            ], title: 'Club tournament rewards');
        }
    }
}
