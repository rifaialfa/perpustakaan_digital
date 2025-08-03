<?php
namespace App\Models;
use CodeIgniter\Model;

class BukuModel extends Model {
    protected $table = 'buku';
    protected $allowedFields = ['judul', 'penulis', 'penerbit', 'tahun_terbit'];
}
