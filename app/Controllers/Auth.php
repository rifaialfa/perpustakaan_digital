<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
{
    echo view('login'); 
}

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($username === 'admin' && $password === 'admin123') {
            session()->set([
                'username' => $username,
                'logged_in' => true
            ]);
            return redirect()->to(base_url('dashboard'));
        } else {
            return redirect()->to(base_url('login'))->with('error', 'Login gagal! Username/password salah.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
