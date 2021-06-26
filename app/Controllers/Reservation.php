<?php

namespace App\Controllers;
use App\Models\RoomTypeModel;
use App\Models\RoomModel;
use App\Models\ReservationModel;
use App\Models\BookingModel;

class Reservation extends BaseController
{
    public function __construct() {
		helper('url');
        helper('form');
		$this->roomType = new RoomTypeModel();
		$this->room = new RoomModel();
    }

	public function index()
	{
		date_default_timezone_set('Asia/Manila');
		$data['room_types'] = $this->roomType->findAll();
		return view('reservation/index', $data);
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
		return redirect()->to(base_url());
	}

	public function reserve($roomid, $startdate, $enddate, $guests){
		$data['room'] = $this->room->getDataUsingId($roomid);
		$data['startdate'] = $startdate;
		$data['enddate'] = $enddate;
		$data['guests'] = $guests;
		return view('reservation/form', $data);
	}

	public function save($roomid, $startdate, $enddate, $guests){
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
			'user_id' => '17', //temporary id
		];
		if($bookModel->save($bookingdata)){
			return true;
		}
		else{
			//error handler
			return false;
		}
	}

	public function view(){
		return view('reservation/view');
	}
}