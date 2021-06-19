<?php

namespace App\Controllers;
use App\Models\RoomTypeModel;

class Reservation extends BaseController
{
    public function __construct() {
		helper('url');
        helper('form');
		$this->roomType = new RoomTypeModel();
    }

	public function index()
	{
		date_default_timezone_set('Asia/Manila');
		$data['room_types'] = $this->roomType->findAll();
		return view('reservation/index', $data);
	}
}