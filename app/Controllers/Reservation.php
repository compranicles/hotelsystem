<?php

namespace App\Controllers;
use App\Models\RoomModel;
use App\Models\ShowModel;
use CodeIgniter\I18n\Time;
use App\Models\BookingModel;
use App\Models\RoomTypeModel;
use App\Models\CancelledModel;
use App\Models\ReservationModel;
use App\Controllers\PermissionChecker;

class Reservation extends BaseController
{
    public function __construct() {
		helper('url');
        helper('form');
		$this->roomType = new RoomTypeModel();
		$this->room = new RoomModel();
		$this->permcheck = new PermissionChecker();
    }

	public function index()
	{
		if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'Reservation') && !($this->permcheck->check($this->session->get('id'),'ReservationView'))){
			date_default_timezone_set('Asia/Manila');
			$bookModel = new BookingModel();
			$data['reservations'] = $bookModel->getUsingId($this->session->get('id'));
			return view('reservation/index', $data);
		}
		elseif($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'ReservationView')){
			return redirect()->to(base_url().'/reservation/view');
		}
		return view('errors/html/error_404');
	}

	public function showroom(){
		date_default_timezone_set('Asia/Manila');
		$data['room_types'] = $this->roomType->findAll();


		if($this->request->getMethod()=='post'){
			
			$start_date = $this->request->getVar('arrival_date');
			$end_date = $this->request->getVar('departure_date');
			$room_type_id = $this->request->getVar('room_type');
			$guests = $this->request->getVar('guests');
			
			// selected is any, get all the rooms/
			if($room_type_id == '0'){
				$data['start_date'] = $start_date;
				$data['end_date'] = $end_date;
				$data['room_type_id'] = $room_type_id;
				$data['no_of_guests'] = $guests;
				$data['rooms'] = $this->room->getAllAvailableRooms($start_date, $end_date,$guests);
				return view('reservation/showroom',$data);
			}
			else{
				$data['start_date'] = $start_date;
				$data['end_date'] = $end_date;
				$data['room_type_id'] = $room_type_id;
				$data['no_of_guests'] = $guests;
				$data['rooms'] = $this->room->getRoomsWithRoomType($start_date, $end_date, $guests, $room_type_id);
				return view('reservation/showroom',$data);
			}
		}
		return view('errors/html/error_404');
	}

	public function reserve($roomid, $startdate, $enddate, $guests){
		if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'ReservationReserve')){
			$data['room'] = $this->room->getDataUsingId($roomid);
			$data['startdate'] = $startdate;
			$data['enddate'] = $enddate;
			$data['guests'] = $guests;
			return view('reservation/form', $data);
		}
		$reservedata = [
			'arrival_date' => $startdate,
			'departure_date' => $enddate,
			'no_of_guests' => $guests,
			'room_id' => $roomid,
		];
		$this->session->set($reservedata);
		$this->session->setTempdata('login_error', 'Login to Continue', 3);
		return redirect()->to(base_url().'/login');
	}

	public function reservefses(){
		if($this->session->has('logged_in') && $this->session->has('room_id') && $this->permcheck->check($this->session->get('id'),'ReservationReserve')){
			$data = [
				'startdate' => $this->session->get('arrival_date'),
				'enddate' => $this->session->get('departure_date'),
				'guests' => $this->session->get('no_of_guests'),
				'room' => $this->room->getDataUsingId($this->session->get('room_id'))
			];
			$reservedata = [
				'arrival_date', 'departure_date', 'no_of_guests', 'room_id'
			];
			$this->session->remove($reservedata);
			return view('reservation/form', $data);
		}
		return view('errors/html/error_404');
	}

	public function save($roomid, $startdate, $enddate, $guests){
		if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'ReservationSave')){
			$reservedata = [
				'arrival_date' => $startdate,
				'departure_date' => $enddate,
				'no_of_guests' => $guests,
				'room_id' => $roomid,
			];
			$resModel = new ReservationModel();
			$bookModel = new BookingModel();
			$reserve_id = $resModel->saveGetId($reservedata);
			$bookingdata = [
				'reservation_id' => $reserve_id,
				'user_id' => $this->session->get('id'),
			];
			$bookingId = $bookModel->saveGetId($bookingdata);
			return "/reservation/success/".$bookingId;
		}
		return view('errors/html/error_404');
	}


	public function success($bookingId){
		if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'ReservationSuccess')){
			$data['bookingcode'] = $bookingId;
			return view('reservation/success', $data);
		}
		return view('errors/html/error_404');
	}

	public function cancel($reservId){
		if($this->session->has('logged_in')  && $this->permcheck->check($this->session->get('id'), 'ReservationCancel')){
			$cancelModel = new CancelledModel();
			$cancelreservData = [
				'cancellation_date' => Time::now('Asia/Manila', 'en_US'),
				'reservation_id' => $reservId,
				'user_id' => $this->session->get('id'),
			];
			if($cancelModel->save($cancelreservData) === true){
				$this->session->setTempdata('success', 'Cancellation Successful', 3);
				return redirect()->to(base_url().'/reservation');
			}
			else{
				$this->session->setTempdata('error', 'Cancellation Failed', 3);
				return redirect()->to(base_url().'/reservation');
			}
		}
		return view('errors/html/error_404');
	}


	public function view(){
		if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'), 'ReservationView')){
			$bookModel = new BookingModel();
			$cancelModel = new CancelledModel();
			$showModel = new ShowModel();
			$data['booked'] = $bookModel->getAllData();
			$data['cancelled'] = $cancelModel->getAllData();
			$data['showed'] = $showModel->getAllData();
			return view('reservation/view', $data);
			// print_r($data['showed']);
		}
		return view('errors/html/error_404');
	}

	public function getInfo($reservation_id){
		if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'ReservationGetInfo')){
			$resModel = new ReservationModel();
			echo json_encode($resModel->getInfo($reservation_id));
			exit;
		}
	}
}