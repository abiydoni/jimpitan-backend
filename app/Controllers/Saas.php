<?php

namespace App\Controllers;

class Saas extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'SaaS & Kendali APK'
        ];
        return view('saas/index', $data);
    }
}