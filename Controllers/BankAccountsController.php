<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\System\Controller;
use App\Models\Bank_Account_HistoryModel;
use App\Models\Bank_AccountsModel;

final class BankAccountsController extends Controller {

    #[Route('/bank', 'bank_accounts', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("bank_accounts", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            }

            $bank_accounts = new Bank_AccountsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $bank_accounts->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'bank');
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($bank_accounts->countLike($search_string, ["id", "player_id", "balance"]));
            } else $nb_items = $bank_accounts->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $bank_accounts = $bank_accounts->find($search_string, ["id", "player_id", "balance"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($bank_accounts as $bank_account) {
                $data[$i]['id'] = $bank_account->getId();
                $data[$i]['player_id'] = $bank_account->getPlayerId();
                $data[$i]['balance'] = $bank_account->getBalance();
                $i++;
            }

            $this->render(name_file: 'bank/index', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Bank accounts');
        };
    }

    #[Route('/bank/history', 'bank_account_history', ['GET', 'POST'])] public function bankAccountHistory(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("bank_account_history", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            }

            $bank_account_history = new Bank_Account_HistoryModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $bank_account_history->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'bank');
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($bank_account_history->countLike($search_string, ["id", "bank_account_id", "action", "amount", "label", "date"]));
            } else $nb_items = $bank_account_history->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $bank_account_history = $bank_account_history->find($search_string, ["id", "bank_account_id", "action", "amount", "label", "date"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($bank_account_history as $row) {
                $data[$i]['id'] = $row->getId();
                $data[$i]['bank_account_id'] = $row->getBankAccountId();
                $data[$i]['action'] = $row->getAction();
                $data[$i]['amount'] = $row->getAmount();
                $data[$i]['label'] = $row->getLabel();
                $data[$i]['date'] = $row->getDate();
                $i++;
            }

            $this->render(name_file: 'bank/bank_history', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Bank account history');
        };
    }
}
