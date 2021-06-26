<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

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

    public function getDataUsingId($id){
        $builder = $this->db->table('rooms');
        $builder->select("rooms.room_id AS room_id, rooms.name AS name, rooms.floor AS floor, rooms.photo AS photo, room_types.name AS room_type, room_status.name AS room_status");
        $builder->join('room_types', 'room_types.room_type_id = rooms.room_type_id');
        $builder->join('room_status', 'room_status.room_status_id = rooms.room_status_id');
        $builder->where('rooms.room_id', $id);
        $builder->where('rooms.date_deleted', NULL);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getAllAvailableRooms($date_start, $date_end, $guests){
        $builder = $this->db->table('rooms');
        $builder->select("rooms.room_id as room_id, rooms.name as room_name, rooms.floor as room_floor, rooms.photo as room_photo, room_types.name as room_type_name, room_types.description as room_description, room_types.price as room_price, room_types.max_guests as max_guests");
        $builder->join('room_types','room_types.room_type_id = rooms.room_type_id');
        $builder->where('rooms.room_status_id', '1');
        $builder->where('rooms.date_deleted', NULL);
        $builder->where('room_types.max_guests >=', $guests);
        $builder->whereNotIn('rooms.room_id', function (BaseBuilder $builder) use($date_start, $date_end){
            return $builder->select('reservations.room_id')->from('reservations')->where('reservations.arrival_date <=', $date_start)->where('reservations.departure_date >=', $date_end)->where('reservations.date_deleted', NULL);
        });
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getRoomsWithRoomType($date_start, $date_end, $guests, $room_type_id){
        $builder = $this->db->table('rooms');
        $builder->select("rooms.room_id as room_id, rooms.name as room_name, rooms.floor as room_floor, rooms.photo as room_photo, room_types.name as room_type_name, room_types.description as room_description, room_types.price as room_price, room_types.max_guests as max_guests");
        $builder->join('room_types','room_types.room_type_id = rooms.room_type_id');
        $builder->where('rooms.room_type_id', $room_type_id);
        $builder->where('rooms.room_status_id', '1');
        $builder->where('rooms.date_deleted', NULL);
        $builder->where('room_types.max_guests >=', $guests);
        $builder->whereNotIn('rooms.room_id', function (BaseBuilder $builder) use($date_start, $date_end){
            return $builder->select('reservations.room_id')->from('reservations')->where('reservations.arrival_date <=', $date_start)->where('reservations.departure_date >=', $date_end)->where('reservations.date_deleted', NULL);
        });
        $query = $builder->get();
        return $query->getResultArray();
    }
}
