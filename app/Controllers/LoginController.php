<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('login');
    }

    public function process()
{
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $model = new \App\Models\UserModel();
    $user = $model->where('email', $email)->first();

    if ($user && password_verify($password, $user['password'])) {
        $session = session();
        $session->set([
            'isLoggedIn' => true,
            'user_id' => $user['user_id'],
            'username' => $user['username'],
            'role' => $user['role']
        ]);
        return redirect()->to('/dashboard');
    } else {
        return redirect()->to('/login')->with('error', 'Username atau password salah.');
    }
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}