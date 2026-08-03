<?php

namespace App\Controllers;

class MasterMenu extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Master Menu'
        ];
        return view('master_menu/index', $data);
    }
}