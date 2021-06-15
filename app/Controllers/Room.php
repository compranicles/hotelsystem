<?php

namespace App\Controllers;
use App\Models\RoomModel;
use App\Models\RoomTypeModel;

class Room extends BaseController
{
    public function __construct() {
        helper('form');
		$this->roomModel = new RoomModel();
		$this->roomTypeModel = new RoomTypeModel();
    }

	public function index()
	{
		date_default_timezone_set('Asia/Manila');
		$data['rooms'] = $this->roomModel->getDataWithType();
		return view('room/show', $data);
	}

	public function add(){
		date_default_timezone_set('Asia/Manila');
		$data['room_types'] = $this->roomTypeModel->findAll();
		if($this->request->getMethod()=='post'){
			$data =[
				'room_type' => $this->request->getVar('room_type'),
				'room_description' => $this->request->getVar('room_description'),
				'room_status' => '1',
			];

			if($this->roomModel->save($data) === true){
				return redirect()->to(base_url().'/room/add');
			}
		}
		return view('room/add', $data);
	}

	public function edit($id=null){
		date_default_timezone_set('Asia/Manila');
		$data['room'] = $this->roomModel->find($id);
		$data['room_types'] = $this->roomTypeModel->findAll();
		
		if($this->request->getMethod()=='post'){
			$data = [
				'room_type' => $this->request->getVar('room_type'),
				'room_description' => $this->request->getVar('room_description'),
				'room_status' => $this->request->getVar('room_status'),
			];

			if($this->roomModel->update($id, $data) === true){
				return redirect()->to(base_url().'/room');
			}
		}

		return view('room/edit',$data);
	}

	public function delete($id=null){
		if($this->roomModel->where('id',$id)->delete()){
			return redirect()->to(base_url().'/room');
		}
	}
}