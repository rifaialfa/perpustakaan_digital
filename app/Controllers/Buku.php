<?php
namespace App\Controllers;
use App\Models\BukuModel;

class Buku extends BaseController {
    public function index() {
        if (!session()->has('user')) return redirect()->to('/auth');

        $model = new BukuModel();
        $search = $this->request->getGet('q');
        $perPage = 5;

        $query = $search ? $model->like('judul', $search)->orLike('penulis', $search) : $model;
        $data['buku'] = $query->paginate($perPage);
        $data['pager'] = $model->pager;
        $data['search'] = $search;

        return view('layout/header')
            . view('buku/index', $data)
            . view('layout/footer');
    }

    public function create() {
        if ($this->request->getMethod() === 'post') {
            $model = new BukuModel();
            $model->insert($this->request->getPost());
            return redirect()->to('/buku');
        }
        return view('layout/header') . view('buku/create') . view('layout/footer');
    }

    public function edit($id) {
        $model = new BukuModel();
        if ($this->request->getMethod() === 'post') {
            $model->update($id, $this->request->getPost());
            return redirect()->to('/buku');
        }
        $data['buku'] = $model->find($id);
        return view('layout/header') . view('buku/edit', $data) . view('layout/footer');
    }

    public function delete($id) {
        $model = new BukuModel();
        $model->delete($id);
        return redirect()->to('/buku');
    }
}
