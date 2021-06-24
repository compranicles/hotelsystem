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
}