<?php namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model{
    protected $table = 'rooms';
    protected $primaryKey = 'room_id';

    protected $returnType = 'array';
    protected $allowedFields =[
        'name', 
        'floor',
        'photo',
        'room_type_id',
        'room_status_id'
    ];
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'date_created';
    protected $updatedField = 'date_modified';
    protected $deletedField = 'date_deleted';

    public function getDataWithType(){
        $builder = $this->db->table('rooms');
        $builder->select("rooms.room_id, rooms.name, rooms.floor, rooms.photo, room_types.name AS room_type,  room_status.name AS room_status");
        $builder->join('room_types', 'room_types.room_type_id = rooms.room_type_id');
        $builder->join('room_status', 'room_status.room_status_id = rooms.room_status_id');
        $builder->where('rooms.date_deleted', NULL);
        $query = $builder->get();
        return $query->getResultArray();
    }
}