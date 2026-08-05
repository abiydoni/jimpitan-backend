<?php

namespace App\Controllers;

class Security extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Keamanan & Backup'
        ];
        return view('security/index', $data);
    }
}
