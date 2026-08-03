<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Pengguna'
        ];
        return view('users/index', $data);
    }
}
