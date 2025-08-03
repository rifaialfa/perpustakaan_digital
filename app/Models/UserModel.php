<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    
    protected $table = 'users';
    
    protected $primaryKey = 'id';
    
    protected $returnType = 'object';

    protected $allowedFields = [
        'username',
        'email',
        'password',
        'role'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; 

    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
        'email'    => 'required|min_length[6]|max_length[255]|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]'
    ];
    
    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}
