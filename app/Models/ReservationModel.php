<?php namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model{
    protected $table = 'reservations';
    protected $primaryKey = 'reservation_id';

    protected $returnType = 'array';
    protected $allowedFields = [
        'arrival_date',
        'departure_date',
        'no_of_guests',
        'room_id',
    ];

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'date_created';
    protected $updatedField = 'date_modified';
    protected $deletedField = 'date_deleted';

    public function saveGetId($data){
        $db = \Config\Database::connect();
        $builder = $db->table('reservations');
        $builder->insert($data);
        return $db->insertID();
    }
}