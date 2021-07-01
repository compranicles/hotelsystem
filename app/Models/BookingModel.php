<?php namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model{
    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';

    protected $returnType = 'array';
    protected $allowedFields = [
        'reservation_id',
        'user_id'
    ];

    protected $useSoftDeletes = false;

    public function saveGetId($data){
        $db = \Config\Database::connect();
        $builder = $db->table('bookings');
        $builder->insert($data);
        return $db->insertID();
    }
}