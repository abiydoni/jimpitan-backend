<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        // Tampilkan halaman login
        return view('auth/login');
    }

    public function logout()
    {
        // Logout hanya membersihkan localStorage di sisi client (dilakukan via JS)
        // Redirect ke halaman login
        return redirect()->to('/login');
    }
}
