<?php 

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model {
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';

    protected $returnType = 'array';
    protected $allowedFields = [
        'amount',
        'booking_id',
        'payment_type_id'
    ];

    protected $useSoftDeletes = false;
    //protected $useTimestamps = true;
    //protected $createdField = 'payment_date';

}

?>