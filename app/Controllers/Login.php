<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    protected $userModel;
    protected $session;
    protected $helpers = ['form', 'url', 'session'];

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function index()
    {

        if ($this->session->get('isLoggedIn')) {
            return redirect()->to(base_url('buku'));
        }

        echo view('auth/login');
    }

    public function process()
    {
        $request = service('request');
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            $this->session->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $username = $request->getPost('username');
        $password = $request->getPost('password');

        $user = $this->userModel->where('username', $username)->first();

        if (!$user) {
            $this->session->setFlashdata('errors', ['username' => 'Username tidak ditemukan.']);
            return redirect()->back()->withInput();
        }

        if (!password_verify($password, $user->password)) {
            $this->session->setFlashdata('errors', ['password' => 'Password salah.']);
            return redirect()->back()->withInput();
        }

        $userData = [
            'id'         => $user->id,
            'username'   => $user->username,
            'isLoggedIn' => true,
            'role'       => $user->role, 
        ];
        $this->session->set($userData);

        return redirect()->to(base_url('buku'));
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login'));
    }
}
