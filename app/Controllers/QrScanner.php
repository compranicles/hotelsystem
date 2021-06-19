<?php 

namespace App\Controllers;

use App\Models\OccupancyModel;

class QrScanner extends BaseController
{
    public function __construct() {
        helper('form');
        $this->session = \Config\Services::session();
        $this->occupancyModel = new OccupancyModel();
    }

    public function index() {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y/m/d H:i:s');
        if($this->request->getMethod() == 'post') {
            $data = [
                'name' => $this->request->getVar('text'),
                'time_in' => $date
            ];

            if ($this->occupancyModel->insert($data) === true) {
                $this->session->setTempdata('success', 'Check-in successfully');
                //return redirect()->to(current_url());
            }else {
                $this->session->setTempdata('error', 'Check-in failed');
            }
        }
        return view('qr/scanner');
    }

}

?>