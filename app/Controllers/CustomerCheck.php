<?php 

namespace App\Controllers;

use App\Models\ShowModel;
use App\Models\BookingModel;

class CustomerCheck extends BaseController
{
    public function __construct() {
        helper('form');
        $this->session = \Config\Services::session();
        $this->showModel = new ShowModel();
        $this->bookingModel = new BookingModel();
    }

    public function index() {
        return view('qr/scanner');
    }

    public function confirm() {
        date_default_timezone_set('Asia/Manila');

        if ($this->request->getMethod() === "post"){ 

            $bookingPass = $this->request->getVar('booking_id');
        
            $booking = $this->bookingModel->where('booking_id', $bookingPass)->findAll();

            if (count($booking) == 0) {
                $this->session->setTempdata('error', 'Reservation not Found', 3);
                echo base_url()."/customercheck";             
            }

            $bookingPassId = $this->showModel->where('booking_id', $booking[0]['booking_id'])->findAll();

            if ((count($bookingPassId) <= 0)) {
                $dataToInsert = [
                    'date_checked_in' =>  date("Y-m-d\TH:i:s"),
                    'booking_id' => $booking[0]['booking_id']
                ];

                

                if ($this->showModel->save($dataToInsert) === true) {
                    $this->session->setTempdata('success', 'Checked-in successfully!', 3);
                    echo base_url()."/customercheck";
                }
            }

            elseif ((count($bookingPassId) > 0) && (!($bookingPassId[0]['date_checked_in'] == null)) && ($bookingPassId[0]['date_checked_out'] == null)) {
                echo base_url().'/payment/checkout/'.$bookingPassId[0]['booking_id'];
            }

            else {    
                $this->session->setTempdata('error', 'Invalid: Transaction has been ended!', 3);      
                echo base_url()."/customercheck";
            }
        }
    }

    public function nice(){

    }

    /*public function index() {
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
    */

}

?>