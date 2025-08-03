<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    protected $session;
    protected $helpers = ['form', 'url', 'session'];

    public function __construct()
    {
        
        $this->session = \Config\Services::session();
    }

    
    public function login()
    {
        
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to(base_url('buku'));
        }
        
        echo view('auth/login');
    }

    public function loginProcess()
    {
        $request = service('request');
        $model = new UserModel();
        
        $rules = [
            'username_or_email' => 'required|min_length[3]',
            'password'          => 'required|min_length[8]',
        ];

        if (!$this->validate($rules)) {
            $this->session->setFlashdata('errors', $this->validator->getErrors());
            $this->session->setFlashdata('old_input', $request->getPost());
            return redirect()->back()->withInput();
        }

        $usernameOrEmail = $request->getPost('username_or_email');
        $password        = $request->getPost('password');

        $user = $model->where('username', $usernameOrEmail)
                      ->orWhere('email', $usernameOrEmail)
                      ->first();

        if ($user) {
            if (password_verify($password, $user->password)) {
                
                $sessData = [
                    'id'         => $user->id,
                    'username'   => $user->username,
                    'email'      => $user->email,
                    'role'       => $user->role,
                    'isLoggedIn' => true,
                ];
                $this->session->set($sessData);
                $this->session->setFlashdata('success', 'Selamat datang, ' . $user->username . '!');
                return redirect()->to(base_url('buku'));
            }
        }

        $this->session->setFlashdata('errors', ['kredensial' => 'Username/Email atau Password salah.']);
        $this->session->setFlashdata('old_input', ['username_or_email' => $usernameOrEmail]);
        return redirect()->back()->withInput();
    }

    public function register()
    {
        
        echo view('auth/register');
    }

    public function registerProcess()
    {
        $request = service('request');
        $model = new UserModel();

        $rules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'email'    => 'required|min_length[6]|max_length[255]|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]|matches[confirm_password]',
            'confirm_password' => 'required|min_length[8]'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $data = [
            'username' => $request->getPost('username'),
            'email'    => $request->getPost('email'),
            'password' => $request->getPost('password'),
            'role'     => 'user' 
        ];

        $model->save($data);
        session()->setFlashdata('success', 'Pendaftaran berhasil! Silakan login.');
        return redirect()->to(base_url('login'));
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login'));
    }
}
