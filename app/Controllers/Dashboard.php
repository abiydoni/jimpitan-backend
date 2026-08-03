<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Utama'
        ];
        return view('dashboard/index', $data);
    }
}
