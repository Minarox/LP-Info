<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\System\Controller;
use App\Models\AdsModel;
use App\Models\NewsModel;
use App\Models\Newspaper_AdsModel;
use App\Models\NewspapersModel;
use App\Models\Upcoming_EventsModel;
use App\Models\WeathersModel;

final class NewspapersController extends Controller {

    #[Route('/newspapers', 'newspapers', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("newspapers", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            }

            $newspapers = new NewspapersModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $newspapers->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'newspapers', response_code: 301);
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($newspapers->countLike($search_string, ["id", "date"]));
            } else $nb_items = $newspapers->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $newspapers = $newspapers->find($search_string, ["id", "date"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($newspapers as $newspaper) {
                $data[$i]['id'] = $newspaper->getId();
                $data[$i]['date'] = $newspaper->getDate();
                $i++;
            }

            $this->render(name_file: 'newspapers/index', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Newspapers');
        };
    }

    #[Route('/newspapers/news', 'newspapers_news', ['GET', 'POST'])] public function newspapersNews(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("news", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            }

            $news = new NewsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $news->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'newspapers/news', response_code: 301);
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($news->countLike($search_string, ["id", "player_id", "date", "name"]));
            } else $nb_items = $news->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $news = $news->find($search_string, ["id", "player_id", "date", "name"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($news as $row) {
                $data[$i]['id'] = $row->getId();
                $data[$i]['player_id'] = $row->getPlayerId();
                $data[$i]['date'] = $row->getDate();
                $data[$i]['name'] = $row->getName();
                $i++;
            }

            $this->render(name_file: 'newspapers/news', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'News');
        };
    }

    #[Route('/newspapers/ads', 'ads', ['GET', 'POST'])] public function newspapersAds(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("ads", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            }

            $newspaper_ads = new Newspaper_AdsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $ids = explode("-", $row);
                        $newspaperid = $ids[0];
                        $adid = $ids[1];
                        $newspaper_ads->query("DELETE FROM {$newspaper_ads->get()} WHERE newspaper_id = $newspaperid AND ad_id = $adid");
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'newspapers/ads', response_code: 301);
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($newspaper_ads->countLike($search_string, ["newspaper_id", "ad_id"]));
            } else $nb_items = $newspaper_ads->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $newspaper_ads = $newspaper_ads->find($search_string, ["newspaper_id", "ad_id"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($newspaper_ads as $row) {
                $data[$i]['newspaper_id'] = $row->getNewspaperId();
                $data[$i]['ad_id'] = $row->getAdId();
                $i++;
            }

            $this->render(name_file: 'newspapers/newspaper_ads', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Newspapers ads');
        };
    }

    #[Route('/newspapers/upcoming', 'newspapers_upcoming', ['GET', 'POST'])] public function newspapersUpcoming(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("upcoming_events", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            }

            $upcoming_events = new Upcoming_EventsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $upcoming_events->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'newspapers/upcoming', response_code: 301);
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($upcoming_events->countLike($search_string, ["id", "newspaper_id", "name"]));
            } else $nb_items = $upcoming_events->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $upcoming_events = $upcoming_events->find($search_string, ["id", "newspaper_id", "name"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($upcoming_events as $upcoming_event) {
                $data[$i]['id'] = $upcoming_event->getId();
                $data[$i]['newspaper_id'] = $upcoming_event->getNewspaperId();
                $data[$i]['name'] = $upcoming_event->getName();
                $i++;
            }

            $this->render(name_file: 'newspapers/upcoming_events', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Upcoming events');
        };
    }

    #[Route('/ads', 'ads', ['GET', 'POST'])] public function ads(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("ads", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            }

            $ads = new AdsModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $ads->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'ads', response_code: 301);
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($ads->countLike($search_string, ["id", "name"]));
            } else $nb_items = $ads->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $ads = $ads->find($search_string, ["id", "name"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($ads as $ad) {
                $data[$i]['id'] = $ad->getId();
                $data[$i]['name'] = $ad->getName();
                $i++;
            }

            $this->render(name_file: 'newspapers/ads', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Ads');
        };
    }

    #[Route('/weathers', 'weathers', ['GET', 'POST'])] public function weathers(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {
            foreach ($_SESSION["authorizations"] as $authorizations) {
                $tables[] = $authorizations["table"];
            }
            if (!$this->permissions("weathers", $tables)) {
                $this->addFlash('error', "Vous n'avez pas les permissions suffisantes pour accéder à cette table.");
                $this->redirect(self::reverse('home'));
            }

            $weathers = new WeathersModel();

            if(isset($_POST['row'])) {
                if(isset($_POST['delete'])) {
                    $i = 0;
                    foreach ($_POST['row'] as $row) {
                        $i++;
                        $weathers->delete($row);
                    }
                    $this->addFlash('success', "{$i} entrées supprimées");
                    $this->redirect(header: 'weathers', response_code: 301);
                }
            }

            $data = [];

            $search_string = "";
            if(isset($_GET['search'])) {
                $search_string = $_GET['search'];
                $nb_items = count($weathers->countLike($search_string, ["id", "name"]));
            } else $nb_items = $weathers->countAll()->nb_items;

            $last_page = ceil($nb_items/NB_PER_PAGE);
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'] >= 1 && $_GET['page'] <= $last_page ? $_GET['page'] : 1;
            if(isset($_POST['page'])) $current_page = $_POST['page'] >= 1 && $_POST['page'] <= $last_page ? $_POST['page'] : 1;
            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $weathers = $weathers->find($search_string, ["id", "name"], $first_of_page, NB_PER_PAGE);

            $i = 0;

            foreach ($weathers as $weather) {
                $data[$i]['id'] = $weather->getId();
                $data[$i]['name'] = $weather->getName();
                $i++;
            }

            $this->render(name_file: 'newspapers/weathers', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page,
                'search'=> $search_string,
            ], title: 'Weathers');
        };
    }
}
