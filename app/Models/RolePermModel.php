<?php namespace App\Models;

use CodeIgniter\Model;

class RolePermModel extends Model{
    protected $table = 'role_perm';
    protected $primaryKey = 'role_perm_id';

    protected $returnType = 'array';
    protected $allowedFields = [
        'role_id',
        'permission_id'
    ];

    protected $useSoftDeletes = false;

    public function getSelected($id){
        $builder = $this->db->table('role_perm');
        $builder->select("role_perm.role_perm_id as rope_id, permissions.name as perm_name");
        $builder->join("permissions", "permissions.permission_id = role_perm.permission_id");
        $builder->where('role_perm.role_id', $id);
        
        $query = $builder->get();
        return $query->getResultArray();
    }
}