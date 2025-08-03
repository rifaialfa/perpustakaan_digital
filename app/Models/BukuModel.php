<?php namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table      = 'buku';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'deskripsi',
        'file_buku',
        'user_id' 
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'tanggal_ditambahkan';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    /**
     * @param int $limit
     * @param int $offset
     * @param string|null $searchQuery
     * @return object
     */
    public function getBuku($limit = 10, $offset = 0, $searchQuery = null)
    {
        $builder = $this->builder();
        if ($searchQuery) {
            $builder->groupStart()
                    ->like('judul', $searchQuery)
                    ->orLike('penulis', $searchQuery)
                    ->orLike('penerbit', $searchQuery)
                    ->groupEnd();
        }
        $builder->limit($limit, $offset);
        return $builder->get()->getResultObject();
    }

    /**
     * @param string|null $searchQuery
     * @return int
     */
    public function countAllBuku($searchQuery = null)
    {
        $builder = $this->builder();
        if ($searchQuery) {
            $builder->groupStart()
                    ->like('judul', $searchQuery)
                    ->orLike('penulis', $searchQuery)
                    ->orLike('penerbit', $searchQuery)
                    ->groupEnd();
        }
        return $builder->countAllResults();
    }

    /**
     * @param int $userId
     * @param int $limit
     * @param int $offset
     * @param string|null $searchQuery
     * @return object
     */
    public function getBukuByUserId($userId, $limit = 10, $offset = 0, $searchQuery = null)
    {
        $builder = $this->builder();
        $builder->where('user_id', $userId);
        if ($searchQuery) {
            $builder->groupStart()
                    ->like('judul', $searchQuery)
                    ->orLike('penulis', $searchQuery)
                    ->orLike('penerbit', $searchQuery)
                    ->groupEnd();
        }
        $builder->limit($limit, $offset);
        return $builder->get()->getResultObject();
    }

    /**
     * @param int $userId
     * @param string|null $searchQuery
     * @return int
     */
    public function countAllBukuByUserId($userId, $searchQuery = null)
    {
        $builder = $this->builder();
        $builder->where('user_id', $userId);
        if ($searchQuery) {
            $builder->groupStart()
                    ->like('judul', $searchQuery)
                    ->orLike('penulis', $searchQuery)
                    ->orLike('penerbit', $searchQuery)
                    ->groupEnd();
        }
        return $builder->countAllResults();
    }
}
