<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $data = [
            'role' => session()->get('role'),
            'user_name' => session()->get('email') // Bisa ganti dengan full_name jika ada di session
        ];

        return view('dashboard', $data);
    }
}