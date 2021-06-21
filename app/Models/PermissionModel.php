<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class PermissionModel extends Model {
    protected $table = 'permissions';
    protected $primaryKey = 'permission_id';
    
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

    public function getUnselected($id){
        $builder = $this->db->table('permissions');
        $builder->select("permissions.permission_id as perm_id, permissions.name as perm_name");
        $builder->whereNotIn('permissions.permission_id', function(BaseBuilder $builder) use ($id){
            return $builder->select('role_perm.permission_id')->from('role_perm')->where('role_perm.role_id', $id);
        });
        $builder->where('permissions.date_deleted', NULL);

        $query = $builder->get();
        return $query->getResultArray();
    }
}