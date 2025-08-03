<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Register extends Controller
{
    protected $userModel;
    protected $session;
    protected $helpers = ['form', 'url', 'session'];

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    // Menampilkan halaman pendaftaran
    public function index()
    {
        // Jika sudah login, arahkan ke halaman utama
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to(base_url('buku'));
        }

        // Tampilkan view register
        echo view('auth/register');
    }

    // Memproses data formulir pendaftaran
    public function process()
    {
        $request = service('request');
        $rules = [
            'username' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
        ];

        // Jalankan validasi
        if (! $this->validate($rules)) {
            $this->session->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        // Ambil data dari formulir
        $data = [
            'username' => $request->getPost('username'),
            'email'    => $request->getPost('email'),
            'password' => $request->getPost('password'),
        ];

        // Simpan data ke database melalui UserModel
        $this->userModel->insert($data);
        
        // Atur pesan sukses
        $this->session->setFlashdata('success', 'Pendaftaran berhasil! Silakan login.');

        // Arahkan ke halaman login
        return redirect()->to(base_url('login'));
    }
}
