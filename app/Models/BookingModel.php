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

    public function getUsingId($id){
        $query = $this->db->query("
            SELECT DISTINCT		
                bk.booking_id as booking_id,
                r.reservation_id as reservation_id,
                r.arrival_date as start_date,
                r.departure_date as end_date,
                r.no_of_guests as guests,
                r.date_created as date_reserved,
                o.name as room_name,
                CASE WHEN c.reservation_id IS NULL THEN 0 ELSE 1 END as cancelled,
                CASE WHEN s.booking_id IS NULL THEN 0 ELSE 1 END as showed
            FROM bookings bk
            INNER JOIN reservations r 
                ON bk.reservation_id = r.reservation_id
            LEFT JOIN rooms o 
                ON r.room_id = o.room_id
            LEFT JOIN cancelled_reservations c 
                ON r.reservation_id = c.reservation_id
            LEFT JOIN shows s 
                ON bk.booking_id = s.booking_id
            WHERE bk.user_id = '$id'
        ");
        return $query->getResultArray();
    }

    public function getAllData(){
        $query = $this->db->query("
            SELECT DISTINCT		
                bk.booking_id as booking_id,
                r.reservation_id as reservation_id,
                u.first_name as first_name,
                u.last_name as last_name,
                r.arrival_date as start_date,
                r.departure_date as end_date,
                r.no_of_guests as guests,
                r.date_created as date_reserved,
                o.name as room_name,
                CASE WHEN c.reservation_id IS NULL THEN 0 ELSE 1 END as cancelled,
                CASE WHEN s.booking_id IS NULL THEN 0 ELSE 1 END as showed
            FROM bookings bk
            INNER JOIN reservations r 
                ON bk.reservation_id = r.reservation_id
            INNER JOIN users u
                ON bk.user_id = u.user_id
            LEFT JOIN rooms o 
                ON r.room_id = o.room_id
            LEFT JOIN cancelled_reservations c 
                ON r.reservation_id = c.reservation_id
            LEFT JOIN shows s 
                ON bk.booking_id = s.booking_id
        ");
        return $query->getResultArray();
    }
}