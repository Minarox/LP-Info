<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\Classes\Validator;
use App\Core\System\Controller;
use App\Core\System\Model;
use App\Models\Automatic_Task_ActionsModel;
use App\Models\Automatic_TasksModel;
use App\Models\Building_FamiliesModel;
use App\Models\Building_ItemsModel;
use App\Models\Building_TypesModel;
use App\Models\BuildingsModel;

final class BuildingsController extends Controller {

    #[Route('/buildings', 'buildings', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("buildings", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("buildings", $tables)) {
                    $position = array_search("buildings", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

            $buildings = new BuildingsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $buildings->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'buildings');
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
                'permissions'=> $permissions,
            ], title: 'Buildings');
        };
    }

    #[Route('/buildings/form', 'buildings_form', ['GET', 'POST'])] public function indexForm(Request $request)
    {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("buildings", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("buildings", $tables)) {
                    $position = array_search("buildings", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
                if (!$this->permissions("INSERT", $permissions)) {
                    $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour ajouter des données à cette table.");
                    $this->redirect(self::reverse('buildings'));
                } else {
                    $validator = new Validator($_POST);
                    $buildings = new BuildingsModel();

                    if ($request->get->get('id')) {
                        $account = $buildings->findById($request->get->get('id'));

                        if (!$account) {
                            $this->addFlash('error', "Cet ID n'existe pas.");
                            $this->redirect(self::reverse('buildings'));
                        } else {
                            if($validator->isSubmitted('update')) {
                                $validator->validate([
                                    'bank_account_id' => ['required'],
                                    'action' => ['required'],
                                    'amount' => ['required'],
                                    'label' => ['required'],
                                    'date' => ['required'],
                                ]);

                                if (!$bank_accounts->findById($request->post->get('bank_account_id'))) {
                                    $this->addFlash('error', "Ce Bank Account ID n'existe pas.");
                                    $this->redirect("/bank/history/form?id=".$request->get->get('id'));
                                } else {
                                    $bank_accounts_history->setBankAccountId($request->post->get('bank_account_id'))
                                        ->setAction($request->post->get('action'))
                                        ->setAmount($request->post->get('amount'))
                                        ->setLabel($request->post->get('label'))
                                        ->setDate($request->post->get('date'))
                                        ->update($request->get->get('id'));

                                    $this->addFlash('success', "Les données ont été modifiées.");
                                    $this->redirect(self::reverse('buildings'));
                                }
                            }

                            $data[] = $account->getBankAccountId();
                            $data[] = $account->getAction();
                            $data[] = $account->getAmount();
                            $data[] = $account->getLabel();
                            $data[] = $account->getDate();

                            $this->render(name_file: 'buildings/index_form', params: [
                                "data"=> $data,
                            ], title: 'Bank accounts');
                        }
                    } else {
                        if($validator->isSubmitted('insert')) {
                            $validator->validate([
                                'bank_account_id' => ['required'],
                                'action' => ['required'],
                                'amount' => ['required'],
                                'label' => ['required'],
                                'date' => ['required'],
                            ]);

                            if (!$bank_accounts->findById($request->post->get('bank_account_id'))) {
                                $this->addFlash('error', "Ce Bank Account ID n'existe pas.");
                                $this->redirect(self::reverse('buildings_form'));
                            } else {
                                $bank_accounts_history->setBankAccountId($request->post->get('bank_account_id'))
                                    ->setAction($request->post->get('action'))
                                    ->setAmount($request->post->get('amount'))
                                    ->setLabel($request->post->get('label'))
                                    ->setDate($request->post->get('date'))
                                    ->create();

                                $this->addFlash('success', "Les données ont été ajouté dans la table.");
                                $this->redirect(self::reverse('buildings'));
                            }
                        }

                        $this->render(name_file: 'buildings/index_form', title: 'Bank account history');
                    }
                }
            }
        }
    }

    #[Route('/building/families', 'building_families', ['GET', 'POST'])] public function buildingFamilies(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("building_families", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("building_families", $tables)) {
                    $position = array_search("building_families", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

            $building_families = new Building_FamiliesModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $building_families->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'building/families');
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
                'permissions'=> $permissions,
            ], title: 'Building families');
        };
    }

    #[Route('/building/items', 'building_items', ['GET', 'POST'])] public function buildingItems(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("building_items", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("building_items", $tables)) {
                    $position = array_search("building_items", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

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
                    $this->redirect(header: 'building/items');
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
                'permissions'=> $permissions,
            ], title: 'Building items');
        };
    }

    #[Route('/building/types', 'building_types', ['GET', 'POST'])] public function buildingTypes(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("building_types", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("building_types", $tables)) {
                    $position = array_search("building_types", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

            $building_types = new Building_TypesModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $building_types->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'building/types');
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
                'permissions'=> $permissions,
            ], title: 'Building types');
        };
    }

    #[Route('/automatic', 'automatic_tasks', ['GET', 'POST'])] public function automaticTasks(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("automatic_tasks", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("automatic_tasks", $tables)) {
                    $position = array_search("automatic_tasks", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

            $automatic_tasks = new Automatic_TasksModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $automatic_tasks->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'automatic');
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
                'permissions'=> $permissions,
            ], title: 'Building automatic tasks');
        };
    }

    #[Route('/automatic/actions', 'automatic_task_actions', ['GET', 'POST'])] public function automaticTaskAction(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("automatic_task_actions", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            } else {
                if (in_array("automatic_task_actions", $tables)) {
                    $position = array_search("automatic_task_actions", $tables);
                } elseif (in_array("*", $tables)) {
                    $position = array_search("*", $tables);
                }
                $permissions = $_SESSION["authorizations"][$position]["permissions"];
            }

            $automatic_task_actions = new Automatic_Task_ActionsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $automatic_task_actions->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'automatic/actions');
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
                'permissions'=> $permissions,
            ], title: 'Building automatic task actions');
        };
    }
}
