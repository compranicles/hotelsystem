<?php namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model{
    protected $table = 'rooms';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $allowedFields =['room_type', 'room_description', 'room_status'];
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'date_created';
    protected $updatedField = 'date_modified';
    protected $deletedField = 'date_deleted';

    public function getDataWithType(){
        $builder = $this->db->table('rooms');
        $builder->select("rooms.id, room_types.room_type_name, room_description, room_status");
        $builder->join('room_types', 'room_types.id = rooms.room_type');
        $query = $builder->get();
        return $query->getResultArray();
    }
}