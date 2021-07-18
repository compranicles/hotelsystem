<?php 

namespace App\Controllers;

use App\Models\ShowModel;
use App\Models\BookingModel;
use App\Models\PaymentTypeModel;

class CustomerCheck extends BaseController
{
    public function __construct() {
        helper('form');
        $this->session = \Config\Services::session();
        $this->showModel = new ShowModel();
        $this->bookingModel = new BookingModel();
    }

    public function index() {
        $data['check_data'] = $this->showModel->getAllData();
        return view('qr/scanner', $data);
    }

    public function confirm() {
        
        if ($this->request->getMethod() === "post"){ 

            $bookingPass = $this->request->getVar('booking_id');
        
            $booking = $this->bookingModel->where('booking_id', $bookingPass)->findAll();

            if (count($booking) == 0) {
                $this->session->setTempdata('error', 'Reservation not Found.', 3);
                echo base_url()."/customercheck";             
            }

            else {
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
                    $bookingPassToCheckout = $bookingPassId[0]['booking_id'];
                    $this->session->set('bookingPassToCheckout', $bookingPassToCheckout);
                    echo base_url().'/payment/checkout';
                }
    
                else {    
                    $this->session->setTempdata('error', 'Invalid: Transaction has been ended!', 3);      
                    echo base_url()."/customercheck";
                }
            }
            
        }
    }

}

?>