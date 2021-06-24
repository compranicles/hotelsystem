<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class RoleModel extends Model{
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    
    protected $returnType = 'array';
    protected $allowedFields = [
        'name',
        'description',
    ];

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'date_created';
    protected $updatedField = 'date_modified';
    protected $deletedField = 'date_deleted';


    public function getUnselected($user_id){
        $builder = $this->db->table('roles');
        $builder->select("roles.role_id as role_id, roles.name as role_name");
        $builder->whereNotIn('roles.role_id', function(BaseBuilder $builder) use ($user_id){
            return $builder->select('user_access.role_id')->from('user_access')->where('user_access.user_id', $user_id);
        });
        $builder->where('roles.date_deleted', NULL);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
