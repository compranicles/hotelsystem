<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
    
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    
    protected $returnType = 'array';
    protected $allowedFields = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'email_address',
        'mobile_number',
        'password'
    ];

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'date_created';
    protected $updatedField = 'date_modified';
    protected $deletedField = 'date_deleted';

    public function saveDataGetId($data){
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->insert($data);

        return $db->insertID();
    }

    public function checkemail($email){
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select("email_address");
        $builder->where("email_address", $email);
        $result = $builder->get();

        if(count($result->getResultArray()) == 0){
            return true;
        }
        else{
            return false;
        }
    }
}