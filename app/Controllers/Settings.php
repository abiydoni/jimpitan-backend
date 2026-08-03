<?php

namespace App\Controllers;

class Settings extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Pengaturan Versi Aplikasi'
        ];
        return view('settings/index', $data);
    }
}
