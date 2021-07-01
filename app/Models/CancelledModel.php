<?php namespace App\Models;

use CodeIgniter\Model;

class CancelledModel extends Model{
    protected $table = 'cancelled_reservations';
    protected $primaryKey = 'cancelled_reservation_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'cancellation_date',
        'reservation_id',
        'user_id',
    ];
    protected $useSoftDeletes = false;

    public function getAllData(){
        $query = $this->db->query("
            SELECT
                a.cancelled_reservation_id as cancel_id,
                a.reservation_id as reservation_id,
                a.cancellation_date as cancel_date,
                u.first_name as first_cancel,
                u.last_name as last_cancel
            FROM cancelled_reservations a
            INNER JOIN reservations r
                ON a.reservation_id = r.reservation_id
            INNER JOIN users u 
                ON a.user_id = u.user_id
        ");
        return  $query->getResultArray();        
    }
}