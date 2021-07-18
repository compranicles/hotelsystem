<?php
namespace App\Models;

use CodeIgniter\Model;

class ShowModel extends Model {
    protected $table = 'shows';
    protected $primaryKey = 'show_id';

    protected $returnType = 'array';
    protected $allowedFields = [
        'date_checked_in',
        'date_checked_out',
        'booking_id'
    ];

    public function getAllData() {
        $query = $this->db->query("
            SELECT usr.first_name, usr.last_name,
                shw.booking_id, shw.date_checked_in, shw.date_checked_out
                FROM shows shw INNER JOIN bookings bk ON shw.booking_id = bk.booking_id
                INNER JOIN users usr ON bk.user_id = usr.user_id

        ");
        return $query->getResultArray();
    }
}

?>