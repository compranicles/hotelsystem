<?php 

namespace App\Controllers;

use App\Models\ShowModel;
use App\Models\BookingModel;
use App\Controllers\PermissionChecker;

class CustomerCheck extends BaseController
{
    public function __construct() {
        helper('form');
        $this->showModel = new ShowModel();
        $this->bookingModel = new BookingModel();
        $this->permcheck = new PermissionChecker();
        date_default_timezone_set('Asia/Manila');
    }

    public function index() {
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'), 'CustomerCheck')){
            $data['check_data'] = $this->showModel->getAllData();
            return view('qr/scanner', $data);
        }
        return view('errors/html/error_404');
    }

    public function confirm() {
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'), 'CustomerCheckConfirm')){
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
        return view('errors/html/error_404');
    }
}

?>