<?php namespace App\Models;

use CodeIgniter\Model;

class UserAccessModel extends Model{
    protected $table = 'user_access';
    protected $primaryKey = 'user_access_id';
    
    protected $returnType = 'array';
    protected $allowedFields = [
        'user_id',
        'role_id'
    ];

    protected $useSoftDeletes = false;

    public function getSelected($user_id){
        $builder = $this->db->table('user_access');
        $builder->select("user_access.user_access_id as uac_id, roles.name as role_name");
        $builder->join("roles", "roles.role_id = user_access.role_id");
        $builder->where("user_access.user_id", $user_id);
        $query = $builder->get();
        return $query->getResultArray();
    }
}