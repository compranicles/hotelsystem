<?php

namespace App\Controllers;
use App\Models\RoomModel;

class Room extends BaseController
{
    public function __construct() {
        helper('form');
		$this->roomModel = new RoomModel();
    }

	public function index()
	{
		$data['rooms'] = $this->roomModel->findAll();
		return view('room/show', $data);
	}

	public function add(){
		if($this->request->getMethod()=='post'){
			$data =[
				'room_type' => $this->request->getVar('room_type'),
				'room_description' => $this->request->getVar('room_description'),
				'room_rate' => $this->request->getVar('room_rate'),
				'room_status' => '1',
			];

			if($this->roomModel->save($data) === true){
				return redirect()->to(base_url().'/room/add');
			}
		}
		return view('room/add');
	}

	public function delete($id=null){
		if($this->roomModel->where('id',$id)->delete()){
			return redirect()->to(base_url().'/room');
		}
	}
}