<?php
namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\PaymentTypeModel;
use App\Models\PaymentModel;
use App\Modeld\ShowModel;

class Payment extends BaseController {
    
    public function checkout($bookingId) {
        $this->bookingModel = new BookingModel();
        $this->paymentTypeModel = new PaymentTypeModel();

        $data['forPayment'] = $this->bookingModel->getReservationDetails($bookingId);
        $data['forPaymentType'] = $this->paymentTypeModel->getPaymentType();
        $data['bookingPass'] = $bookingId;
        return view('payment/checkout/index', $data);
    }

    public function checkoutPayment() {
        date_default_timezone_set('Asia/Manila');
        $this->paymentModel = new PaymentModel();
        $this->showModel = new ShowModel();

        if ($this->request->getMethod() === "post"){ 

            $booking_id = $this->request->getVar('booking_id');
            $payment_type_id = $this->request->getVar('payment_type');
            $amount = $this->request->getVar('amount');
            
        $data = [
            'amount' => $amount,
            'booking_id' => $booking_id,
            'payment_type_id' => $payment_type_id
        ];
        
        $dataToCheckout = ['date_checked_out' =>  date("Y-m-d\TH:i:s")];

        if(($this->paymentModel->save($data) === true) && ($this->showModel->save($dataToCheckout) === true)) {
            echo base_url().'/checkreservation';
          }
        }
    }
}


?>