<?php

namespace App\Controllers;

class Chat extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Pusat Pesan (Chat)',
            'noPadding' => true // Agar layout content tidak memiliki padding, cocok untuk chat UI yang full-height
        ];
        return view('chat/index', $data);
    }
}
