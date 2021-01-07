<?php


namespace App\Controllers;


use App\Models\RandomGroup;

final class GroupController extends Controller
{
    public function index()
    {
        $random_group = new RandomGroup();
        $this->render(name_file: 'group/index', params: [
            'class' => $random_group->makeGroup()
        ]);
    }

    public function random(int $number)
    {
        $random_group = new RandomGroup();
        $params = compact('number');

        $this->render(name_file: 'group/group', params: [
            'params' => $params,
            'group' => $random_group->makeGroup($params['number'])
        ]);
    }
}