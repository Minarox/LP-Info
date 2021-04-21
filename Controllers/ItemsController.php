<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\System\Controller;
use App\Models\Item_TypesModel;
use App\Models\ItemsModel;

final class ItemsController extends Controller {

    #[Route('/items', 'items', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("items", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            }

            $items = new ItemsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $items->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'items');
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($items->countLike($search_string, ["id", "item_type_id", "description", "level"]));
            } else $nb_items = $items->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $items = $items->find($search_string, ["id", "item_type_id", "description", "level"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($items as $item) {
                $data[$i]['id'] = $item->getId();
                $data[$i]['item_type_id'] = $item->getItemTypeId();
                $data[$i]['description'] = $item->getDescription();
                $data[$i]['level'] = $item->getLevel();
                $i++;
            }

            $this->render(name_file: 'items/index', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'items');
        };
    }

    #[Route('/items/types', 'items_types', ['GET', 'POST'])] public function itemsTypes(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("item_types", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            }

            $item_types = new Item_TypesModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $item_types->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'items/types');
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($item_types->countLike($search_string, ["item_type_id", "name"]));
            } else $nb_items = $item_types->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $item_types = $item_types->find($search_string, ["item_type_id", "name"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($item_types as $item_type) {
                $data[$i]['item_type_id'] = $item_type->getId();
                $data[$i]['name'] = $item_type->getName();
                $i++;
            }

            $this->render(name_file: 'items/items_types', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Items types');
        };
    }
}
