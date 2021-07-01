<?php namespace App\Models;

use CodeIgniter\Model;

class PaymentTypeModel extends Model{
    protected $table = 'payment_types';
    protected $primaryKey = 'payment_type_id';

    protected $returnType = 'array';
    protected $allowedFields =[
        'name', 
        'description',
    ];
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'date_created';
    protected $updatedField = 'date_modified';
    protected $deletedField = 'date_deleted';

    public function getPaymentType() {
        $builder = $this->db->table('payment_types');
        $builder->select('payment_types.payment_type_id, payment_types.name');
        $builder->where('date_deleted', null);
        $query = $builder->get();
        return $query->getResultArray();
    }
}