<?php namespace App\Models;

use CodeIgniter\Model;

class RoomStatusModel extends Model{
    protected $table = 'room_status';
    protected $primaryKey = 'room_status_id';
    protected $returnType = 'array';
}