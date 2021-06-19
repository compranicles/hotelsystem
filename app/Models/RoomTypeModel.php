<?php namespace App\Models;

use CodeIgniter\Model;

class RoomTypeModel extends Model{
    protected $table = 'room_types';
    protected $primaryKey = 'room_type_id';

    protected $returnType = 'array';
    protected $allowedFields =[
        'name',
        'description',
        'price',
        'max_guests',
    ];
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'date_created';
    protected $updatedField = 'date_modified';
    protected $deletedField = 'date_deleted';
}