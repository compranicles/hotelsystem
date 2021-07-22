<?php

namespace App\Controllers;
use App\Models\RoomTypeModel;
use App\Controllers\PermissionChecker;

class Home extends BaseController
{
	public function __construct() {
		$this->roomType = new RoomTypeModel();
		$this->permcheck = new PermissionChecker();
    }

	public function index()
	{	
		if($this->session->has('logged_in') && ($this->permcheck->check($this->session->get('id'), 'Reservation')) && !($this->permcheck->check($this->session->get('id'), 'ReservationAdd'))){
		 	return redirect()->to(base_url().'/user/dashboard');
		}
		elseif($this->session->has('logged_in') && ($this->permcheck->check($this->session->get('id'), 'ReservationAdd'))){
	   	}
		$data['room_types'] = $this->roomType->findAll();
		return view('homepage/home',$data);
	}
}
