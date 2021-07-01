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
}

?>