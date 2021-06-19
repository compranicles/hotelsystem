<?php 

namespace App\Models;

use CodeIgniter\Model;

class OccupancyModel extends Model {
    protected $table = 'qr_scanner';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'time_in'];

    //protected $useTimestamps = true;
    protected $createdField  = 'time_in';
}

?>