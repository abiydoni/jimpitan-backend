<?php

namespace App\Controllers;

class Villages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Desa'
        ];
        return view('villages/index', $data);
    }
}
