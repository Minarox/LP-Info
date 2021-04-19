<?php

namespace App\Controllers;

use App\Core\Attributes\Route;
use App\Core\Classes\SuperGlobals\Request;
use App\Core\Classes\Validator;
use App\Core\System\Controller;
use App\Models\AdsModel;
use App\Models\HorsesModel;
use App\Models\NewsModel;
use App\Models\Newspaper_AdsModel;
use App\Models\NewspapersModel;
use App\Models\Player_HorsesModel;
use App\Models\PlayersModel;
use App\Models\Upcoming_EventsModel;
use App\Models\WeathersModel;

final class NewspapersController extends Controller {

    #[Route('/newspapers', 'newspapers', ['GET', 'POST'])] public function index(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

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

            // Pages system
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'];

            $nb_items = $newspapers->countAll()->nb_items;
            $last_page = ceil($nb_items/NB_PER_PAGE);

            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $newspapers = $newspapers->findPageRange($first_of_page, NB_PER_PAGE);
            $i = 0;

            foreach ($newspapers as $newspaper) {
                $data[$i]['id'] = $newspaper->getId();
                $data[$i]['date'] = $newspaper->getDate();
                $i++;
            }

            $this->render(name_file: 'newspapers/index', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page
            ], title: 'Newspapers');
        };
    }

    #[Route('/newspapers/news', 'newspapers_news', ['GET', 'POST'])] public function newspapersNews(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

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

            // Pages system
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'];

            $nb_items = $news->countAll()->nb_items;
            $last_page = ceil($nb_items/NB_PER_PAGE);

            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $news = $news->findPageRange($first_of_page, NB_PER_PAGE);
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
                'last_page'=> $last_page
            ], title: 'News');
        };
    }

    #[Route('/newspapers/ads', 'newspapers_ads', ['GET', 'POST'])] public function newspapersAds(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

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

            // Pages system
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'];

            $nb_items = $newspaper_ads->countAll()->nb_items;
            $last_page = ceil($nb_items/NB_PER_PAGE);

            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $newspaper_ads = $newspaper_ads->findPageRange($first_of_page, NB_PER_PAGE);
            $i = 0;

            foreach ($newspaper_ads as $row) {
                $data[$i]['newspaper_id'] = $row->getNewspaperId();
                $data[$i]['ad_id'] = $row->getAdId();
                $i++;
            }

            $this->render(name_file: 'newspapers/newspaper_ads', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page
            ], title: 'Newspapers ads');
        };
    }

    #[Route('/newspapers/upcoming', 'newspapers_upcoming', ['GET', 'POST'])] public function newspapersUpcoming(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

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

            // Pages system
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'];

            $nb_items = $upcoming_events->countAll()->nb_items;
            $last_page = ceil($nb_items/NB_PER_PAGE);

            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $upcoming_events = $upcoming_events->findPageRange($first_of_page, NB_PER_PAGE);
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
                'last_page'=> $last_page
            ], title: 'Upcoming events');
        };
    }

    #[Route('/ads', 'ads', ['GET', 'POST'])] public function ads(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

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

            // Pages system
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'];

            $nb_items = $ads->countAll()->nb_items;
            $last_page = ceil($nb_items/NB_PER_PAGE);

            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $ads = $ads->findPageRange($first_of_page, NB_PER_PAGE);
            $i = 0;

            foreach ($ads as $ad) {
                $data[$i]['id'] = $ad->getId();
                $data[$i]['name'] = $ad->getName();
                $i++;
            }

            $this->render(name_file: 'newspapers/ads', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page
            ], title: 'Ads');
        };
    }

    #[Route('/weathers', 'weathers', ['GET', 'POST'])] public function weathers(Request $request) {
        if (!$this->isAuthenticated()) {
            $this->redirect(self::reverse('login'));
        } else {

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

            // Pages system
            $current_page = 1;
            if(isset($_GET['page'])) $current_page = $_GET['page'];

            $nb_items = $weathers->countAll()->nb_items;
            $last_page = ceil($nb_items/NB_PER_PAGE);

            $first_of_page = ($current_page * NB_PER_PAGE) - NB_PER_PAGE;
            $weathers = $weathers->findPageRange($first_of_page, NB_PER_PAGE);
            $i = 0;

            foreach ($weathers as $weather) {
                $data[$i]['id'] = $weather->getId();
                $data[$i]['name'] = $weather->getName();
                $i++;
            }

            $this->render(name_file: 'newspapers/weathers', params: [
                'data'=> $data,
                'current_page'=> $current_page,
                'last_page'=> $last_page
            ], title: 'Weathers');
        };
    }
}
