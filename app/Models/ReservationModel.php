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

    public function getInfo($reservation_id){
        $query = $this->db->query("
            SELECT
                r.reservation_id as resId,
                u.first_name as fname,
                u.last_name as lname,
                rm.name as room_name,
                r.arrival_date as start_date,
                r.departure_date as end_date,
                r.no_of_guests as guests,
                r.date_created as date_reserved
            FROM reservations r
            INNER JOIN bookings b 
                ON r.reservation_id = b.reservation_id
            INNER JOIN users u
                ON b.user_id = u.user_id
            INNER JOIN rooms rm 
                ON r.room_id = rm.room_id
            WHERE
                r.reservation_id = '$reservation_id'
        ");
        return $query->getRowArray(0);
    }
}