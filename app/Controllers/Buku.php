<?php namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Buku extends Controller
{
    protected $bukuModel;
    protected $userModel;
    protected $helpers = ['form', 'url', 'session'];

    protected $filters = [
        'auth' => [
            'before' => ['tambah', 'simpan', 'edit', 'update', 'hapus'],
        ],
    ];

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $request = service('request');
        $session = session();
        
        $searchQuery = $request->getGet('q');
        $perPage = 10;
        $currentPage = $request->getGet('page') ?? 1;

        $userRole = $session->get('role');
        $userId = $session->get('id');
        
        $buku = [];
        $totalRows = 0;

        
        if ($userRole === 'admin') {
            $totalRows = $this->bukuModel->countAllBuku($searchQuery);
            $buku = $this->bukuModel->getBuku($perPage, ($currentPage - 1) * $perPage, $searchQuery);
        } else {
            
            $adminUser = $this->userModel->where('role', 'admin')->first();
            $adminId = $adminUser ? $adminUser->id : null;

            if ($adminId) {
                $totalRows = $this->bukuModel->countAllBukuByUserId($adminId, $searchQuery);
                $buku = $this->bukuModel->getBukuByUserId($adminId, $perPage, ($currentPage - 1) * $perPage, $searchQuery);
            }
        }
        
        $totalPages = ceil($totalRows / $perPage);
    
        $data = [
            'title' => 'Daftar Buku',
            'buku' => $buku,
            'pager' => service('pager'),
            'totalRows' => $totalRows,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'searchQuery' => $searchQuery,
            'userRole' => $userRole,
            'userId' => $userId 
        ];
        
        echo view('templates/header', $data);
        echo view('buku/daftar_buku', $data);
        echo view('templates/footer');
    }

    
    public function tambah()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('buku'))->with('error', 'Anda tidak memiliki hak akses untuk menambah buku.');
        }

        $data = [
            'title' => 'Tambah Buku',
            'validation' => \Config\Services::validation()
        ];
        echo view('templates/header', $data);
        echo view('buku/form_buku', $data);
        echo view('templates/footer');
    }

    
    public function simpan()
    {
        $rules = [
            'judul' => 'required|max_length[255]',
            'penulis' => 'required|max_length[255]',
            'penerbit' => 'required|max_length[255]',
            'tahun_terbit' => 'required|integer|less_than_equal_to[2025]',
            'isbn' => 'permit_empty|is_unique[buku.isbn]|max_length[20]',
            'deskripsi' => 'permit_empty',
            'file_buku' => 'uploaded[file_buku]|max_size[file_buku,10240]|ext_in[file_buku,pdf,doc,docx]'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $fileBuku = $this->request->getFile('file_buku');
        $newName = $fileBuku->getRandomName();
        $fileBuku->move('uploads', $newName);

        $this->bukuModel->save([
            'judul' => $this->request->getPost('judul'),
            'penulis' => $this->request->getPost('penulis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'isbn' => $this->request->getPost('isbn'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'file_buku' => 'uploads/' . $newName,
            'user_id' => session()->get('id')
        ]);

        session()->setFlashdata('success', 'Buku berhasil ditambahkan!');
        return redirect()->to(base_url('buku'));
    }

     
    public function edit($id = null)
    {
        $buku = $this->bukuModel->find($id);

        if (!$buku) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku tidak ditemukan.');
        }

        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('buku'))->with('error', 'Anda tidak memiliki hak akses untuk mengedit buku ini.');
        }

        $data = [
            'title' => 'Edit Buku',
            'buku' => $buku,
            'validation' => \Config\Services::validation()
        ];
        echo view('templates/header', $data);
        echo view('buku/form_buku_edit', $data);
        echo view('templates/footer');
    }

     
    public function update($id = null)
    {
        $rules = [
            'judul' => 'required|max_length[255]',
            'penulis' => 'required|max_length[255]',
            'penerbit' => 'required|max_length[255]',
            'tahun_terbit' => 'required|integer|less_than_equal_to[2025]',
            'isbn' => "permit_empty|is_unique[buku.isbn,id,{$id}]|max_length[20]",
            'deskripsi' => 'permit_empty',
            'file_buku' => 'permit_empty|max_size[file_buku,10240]|ext_in[file_buku,pdf,doc,docx]'
        ];
        
        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $buku = $this->bukuModel->find($id);
        if (!$buku) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku tidak ditemukan.');
        }

        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('buku'))->with('error', 'Anda tidak memiliki hak akses untuk mengupdate buku ini.');
        }

        $updateData = [
            'judul' => $this->request->getPost('judul'),
            'penulis' => $this->request->getPost('penulis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'isbn' => $this->request->getPost('isbn'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];
        
        $fileBuku = $this->request->getFile('file_buku');
        if ($fileBuku && $fileBuku->isValid() && !$fileBuku->hasMoved()) {
            if (!empty($buku->file_buku) && file_exists(ROOTPATH . 'public/' . $buku->file_buku)) {
                unlink(ROOTPATH . 'public/' . $buku->file_buku);
            }
            $newName = $fileBuku->getRandomName();
            $fileBuku->move(ROOTPATH . 'public/uploads', $newName);
            $updateData['file_buku'] = 'uploads/' . $newName;
        }

        $this->bukuModel->update($id, $updateData);
        session()->setFlashdata('success', 'Buku berhasil diperbarui!');
        return redirect()->to(base_url('buku'));
    }

    
    public function hapus($id = null)
    {
        $buku = $this->bukuModel->find($id);

        if (!$buku) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku tidak ditemukan.');
        }

        if (session()->get('role') !== 'admin') {
            session()->setFlashdata('error', 'Anda tidak memiliki hak akses untuk menghapus buku ini.');
            return redirect()->to(base_url('buku'));
        }

        if (!empty($buku->file_buku) && file_exists(ROOTPATH . 'public/' . $buku->file_buku)) {
            unlink(ROOTPATH . 'public/' . $buku->file_buku);
        }

        $this->bukuModel->delete($id);
        session()->setFlashdata('success', 'Buku berhasil dihapus!');
        return redirect()->to(base_url('buku'));
    }
}
