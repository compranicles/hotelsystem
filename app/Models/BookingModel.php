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

    /*d = room type
    c = rooms
    b = reservations
    a = users
    */
    public function getReservationDetails($bookingId) {
        $query = $this->db->query("
            SELECT a.first_name, a.last_name,
                b.arrival_date, b.departure_date, b.date_created,
                c.name as room_name, c.floor,
                d.name as room_type_name, d.price
                FROM bookings e
                INNER JOIN users a ON a.user_id = e.user_id
                INNER JOIN reservations b ON e.reservation_id = b.reservation_id
                INNER JOIN rooms c ON b.room_id = c.room_id
                INNER JOIN room_types d ON c.room_type_id = d.room_type_id
                WHERE e.booking_id = ".$bookingId.""   
        );
        return $query->getResultArray();
    }
}