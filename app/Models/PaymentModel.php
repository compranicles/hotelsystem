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

    public function findUsingId($user_id){
        $builder = $this->db->table('payments');
        $builder->select("*");
        $builder->join('bookings', 'bookings.booking_id = payments.booking_id');
        $builder->where('bookings.user_id', $user_id);
        $query = $builder->get();
        return $query->getResultArray();
    }

}

?>