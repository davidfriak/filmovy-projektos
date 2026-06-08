<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function loginForm()
    {
        return view('auth/login');
    }

    public function login()
    {
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user->password)) {
            return redirect()->to('/login')->with('error', 'Špatné jméno nebo heslo.');
        }

        session()->set([
            'isLoggedIn' => true,
            'userId' => $user->pid_user,
            'username' => $user->username
        ]);

        return redirect()->to('/movies')->with('success', 'Byl jsi přihlášen.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/')->with('success', 'Byl jsi odhlášen.');
    }
}