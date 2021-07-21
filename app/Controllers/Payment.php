<?php
namespace App\Controllers;

use App\Models\ShowModel;
use App\Models\BookingModel;
use App\Models\PaymentModel;
use App\Models\PaymentTypeModel;
use App\Models\ReservationModel;
use App\Controllers\PermissionChecker;

class Payment extends BaseController {
    
    /*public function checkout($bookingId) {
        $this->bookingModel = new BookingModel();
        $this->paymentTypeModel = new PaymentTypeModel();

        $data['forPayment'] = $this->bookingModel->getReservationDetails($bookingId);
        $data['forPaymentType'] = $this->paymentTypeModel->getPaymentType();
        $data['bookingPass'] = $bookingId;
        return view('payment/checkout/index', $data);
    }
    */

    public function __construct() {
        date_default_timezone_set('Asia/Manila');
        $this->bookingModel = new BookingModel();
        $this->paymentTypeModel = new PaymentTypeModel();
        $this->paymentModel = new PaymentModel();
        $this->showModel = new ShowModel();
        $this->permcheck = new PermissionChecker();
    }

    public function index(){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'), 'Payment') && !($this->permcheck->check($this->session->get('id'), 'PaymentHistory'))){
            $data['payments'] = $this->paymentModel->findAll();
            $data['paymentTypes'] = $this->paymentTypeModel->findAll();
            return view('payment/index', $data);
        }
        elseif($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'), 'PaymentHistory')){
            return redirect()->to(base_url().'/payment/history');
        }
        return view('errors/html/error_404');
    }

    public function history(){
        if($this->session->has('logged_in')  && $this->permcheck->check($this->session->get('id'), 'PaymentHistory')){
            $data['payments'] = $this->paymentModel->findUsingId($this->session->get('id'));
            $data['paymentTypes'] = $this->paymentTypeModel->findAll();
            return view('payment/history', $data);
        }
        return view('errors/html/error_404');
    }

    public function checkout() {
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'), 'PaymentCheckout')){
            $bookingId = $this->session->get('bookingPassToCheckout');
            
            $data['checkForLateCheckout'] = $this->showModel->where('booking_id', $bookingId)->findColumn('date_checked_in');
            $data['forPayment'] = $this->bookingModel->getReservationDetails($bookingId);
            $data['forPaymentType'] = $this->paymentTypeModel->getPaymentType();
            $data['bookingPass'] = $bookingId;
            return view('payment/checkout/index', $data);
        }
        return view('errors/html/error_404');
    }

    public function checkoutPayment() {
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'), 'PaymentCheckout')){
            if ($this->request->getMethod() === "post"){ 

                $booking_id = $this->request->getVar('booking_id');
                $payment_type_id = $this->request->getVar('payment_type');
                $amount = $this->request->getVar('amount');
                
                $data = [
                    'amount' => $amount,
                    'booking_id' => $booking_id,
                    'payment_type_id' => $payment_type_id
                ];
                

                if(($this->paymentModel->save($data) === true) && 
                        ($this->showModel->whereIn('booking_id', [$booking_id])
                                        ->set(['date_checked_out' =>  date("Y-m-d\TH:i:s")])
                                        ->update() === true)) {
                    $this->session->setTempdata('success', 'Checked-out successfully!', 3);
                    echo base_url().'/customercheck';
                }

            }
        }
    }

    public function getPaymentInfo($reservation_id){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'PaymentGetInfo')){
			$resModel = new ReservationModel();
			echo json_encode($resModel->getPaymentInfo($reservation_id));
			exit;
		}
    }
    
}


?>