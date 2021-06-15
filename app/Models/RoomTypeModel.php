<?php namespace App\Models;

use CodeIgniter\Model;

class RoomTypeModel extends Model{
    protected $table = 'room_types';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $allowedFields =['room_type_name', 'room_rate'];
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'date_created';
    protected $updatedField = 'date_modified';
    protected $deletedField = 'date_deleted';
}