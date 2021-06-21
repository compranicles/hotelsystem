<?php namespace App\Models;

use CodeIgniter\Model;

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
}
