<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\System\Controller;
use App\Models\Horse_BreedsModel;
use App\Models\Horse_ItemsModel;
use App\Models\Horse_StatusModel;
use App\Models\HorsesModel;
use App\Models\StatusesModel;

final class HorsesController extends Controller {

    #[Route('/horses', 'horses', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("horses", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("horses", $tables)) {
                    $position = array_search("horses", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

            $horses = new HorsesModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $horses->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'horses');
                }
            }

            $data = [];

            $search_string = "";
            $filter = "";
            $order = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($horses->countLike($search_string, ["id", "name", "breed_id", "global_condition", "experience", "level"]));
            } else $nb_items = $horses->countAll()->nb_items;
            if(isset($_GET['filter'])) $filter = $_GET['filter'];
            if(isset($_GET['order'])) $order = $_GET['order'];

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $horses = $horses->find($search_string, ["id", "name", "breed_id", "global_condition", "experience", "level"], $first_of_page, NB_PER_PAGE, $filter, $order);

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
                'last_page'=> $last_page,
                'search'=> $search_string,
                'permissions'=> $permissions,
                'filter'=> $filter,
                'order'=> $order,
            ], title: 'Horses');
        };
    }

    #[Route('/horse/breeds', 'horse_breeds', ['GET', 'POST'])] public function horseBreeds(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("horse_breeds", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("horse_breeds", $tables)) {
                    $position = array_search("horse_breeds", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

            $horse_breeds = new Horse_BreedsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $horse_breeds->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'horse/breeds');
                }
            }

            $data = [];

            $search_string = "";
            $filter = "";
            $order = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($horse_breeds->countLike($search_string, ["id", "name"]));
            } else $nb_items = $horse_breeds->countAll()->nb_items;
            if(isset($_GET['filter'])) $filter = $_GET['filter'];
            if(isset($_GET['order'])) $order = $_GET['order'];

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $horse_breeds = $horse_breeds->find($search_string, ["id", "name"], $first_of_page, NB_PER_PAGE, $filter, $order);

            $i = 0;

            foreach ($horse_breeds as $horse_breed) {
                $data[$i]['id'] = $horse_breed->getId();
                $data[$i]['name'] = $horse_breed->getName();
                $i++;
            }

            $this->render(name_file: 'horses/horse_breeds', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
                'permissions'=> $permissions,
                'filter'=> $filter,
                'order'=> $order,
            ], title: 'Horse breeds');
        };
    }

    #[Route('/horse/items', 'horse_items', ['GET', 'POST'])] public function horseItems(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("horse_items", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("horse_items", $tables)) {
                    $position = array_search("horse_items", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

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
                    $this->redirect(header: 'horse/items');
                }
            }

            $data = [];

            $search_string = "";
            $filter = "";
            $order = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($horse_items->countLike($search_string, ["horse_id", "item_id", "quantity"]));
            } else $nb_items = $horse_items->countAll()->nb_items;
            if(isset($_GET['filter'])) $filter = $_GET['filter'];
            if(isset($_GET['order'])) $order = $_GET['order'];

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $horse_items = $horse_items->find($search_string, ["horse_id", "item_id", "quantity"], $first_of_page, NB_PER_PAGE, $filter, $order);

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
                'last_page'=> $last_page,
                'search'=> $search_string,
                'permissions'=> $permissions,
                'filter'=> $filter,
                'order'=> $order,
            ], title: 'Horse items');
        };
    }

    #[Route('/horse/status', 'horse_status', ['GET', 'POST'])] public function horseStatus(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("horse_status", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("horse_status", $tables)) {
                    $position = array_search("horse_status", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

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
                    $this->redirect(header: 'horse/status');
                }
            }

            $data = [];

            $search_string = "";
            $filter = "";
            $order = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($horse_status->countLike($search_string, ["horse_id", "status_id", "onset_date"]));
            } else $nb_items = $horse_status->countAll()->nb_items;
            if(isset($_GET['filter'])) $filter = $_GET['filter'];
            if(isset($_GET['order'])) $order = $_GET['order'];

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $horse_status = $horse_status->find($search_string, ["horse_id", "status_id", "onset_date"], $first_of_page, NB_PER_PAGE, $filter, $order);

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
                'last_page'=> $last_page,
                'search'=> $search_string,
                'permissions'=> $permissions,
                'filter'=> $filter,
                'order'=> $order,
            ], title: 'Horse status');
        }
    }

    #[Route('/statuses', 'statuses', ['GET', 'POST'])] public function statuses(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("statuses", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("statuses", $tables)) {
                    $position = array_search("statuses", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

            $statuses = new StatusesModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $statuses->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'statuses');
                }
            }

            $data = [];

            $search_string = "";
            $filter = "";
            $order = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($statuses->countLike($search_string, ["id", "name"]));
            } else $nb_items = $statuses->countAll()->nb_items;
            if(isset($_GET['filter'])) $filter = $_GET['filter'];
            if(isset($_GET['order'])) $order = $_GET['order'];

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $statuses = $statuses->find($search_string, ["id", "name"], $first_of_page, NB_PER_PAGE, $filter, $order);

            $i = 0;

            foreach ($statuses as $status) {
                $data[$i]['id'] = $status->getId();
                $data[$i]['name'] = $status->getName();
                $i++;
            }

            $this->render(name_file: 'horses/statuses', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
                'permissions'=> $permissions,
                'filter'=> $filter,
                'order'=> $order,
            ], title: 'Statuses');
        }
    }
}
