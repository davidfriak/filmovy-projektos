<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function loginForm()
    {
        return view('auth/login');
    }

    public function login()
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        if ($username !== 'admin' || $password !== 'admin123') {
            return redirect()->to(site_url('login'))->with('error', 'Špatné jméno nebo heslo.');
        }

        session()->set([
            'isLoggedIn' => true,
            'username' => 'admin',
        ]);

        return redirect()->to(site_url('movies'))->with('success', 'Byl jsi přihlášen.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('/'))->with('success', 'Byl jsi odhlášen.');
    }
}
