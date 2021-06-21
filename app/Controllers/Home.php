<?php

namespace App\Controllers;
use App\Models\RoomTypeModel;

class Home extends BaseController
{
	public function __construct() {
		$this->roomType = new RoomTypeModel();
    }

	public function index()
	{	
		$data['room_types'] = $this->roomType->findAll();
		if($this->request->getMethod('post')){

		}
		return view('homepage/home',$data);
	}
}
