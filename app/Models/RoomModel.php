<?php namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model{
    protected $table = 'rooms';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $allowedFields =['room_type', 'room_description', 'room_rate', 'room_status'];
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'date_created';
    protected $updatedField = 'date_modified';
    protected $deletedField = 'date_deleted';
}