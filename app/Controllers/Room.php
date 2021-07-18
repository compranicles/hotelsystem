<?php

namespace App\Controllers;
use App\Models\RoomModel;
use App\Models\RoomTypeModel;
use App\Models\RoomStatusModel;
use App\Controllers\PermissionChecker;

class Room extends BaseController
{
    public function __construct() {
		$this->roomModel = new RoomModel();
		$this->roomTypeModel = new RoomTypeModel();
		$this->roomStatusModel = new RoomStatusModel();
		$this->permcheck = new PermissionChecker();
		$this->session = \Config\Services::session();
    }

	public function index()
	{
		if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'Room')){
			date_default_timezone_set('Asia/Manila');
			$data['rooms'] = $this->roomModel->getDataWithType();
			return view('room/index', $data);
		}
		return view('errors/html/error_404');
	}

	public function add(){
		if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'RoomAdd')){
			date_default_timezone_set('Asia/Manila');

			$data['room_types'] = $this->roomTypeModel->findAll();

			if($this->request->getMethod()=='post'){
				$file = $this->request->getFile('photo');
				if($file->isValid() && ! $file->hasMoved()){
					$photoName = $file->getRandomName();
					$file->move('uploads/', $photoName);
				}
				$data =[
					'name' => $this->request->getVar('name'),
					'floor' => $this->request->getVar('floor'),
					'photo' => $photoName,
					'room_type_id' => $this->request->getVar('room_type_id'),
					'room_status_id' => '1',
				];

				if($this->roomModel->save($data) === true){
					$this->session->setTempdata('success', 'Added Successfully!', 3);
					return redirect()->to(base_url().'/room');
				} else {
					$this->session->setTempdata('error', 'Adding Failed', 3);
				}
			}
			return view('room/add', $data);
		}
		return view('errors/html/error_404');
	}

	public function edit($id=null){
		if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'RoomEdit')){
			date_default_timezone_set('Asia/Manila');
			$data['room'] = $this->roomModel->find($id);
			$data['room_types'] = $this->roomTypeModel->findAll();
			$data['room_status'] = $this->roomStatusModel->findAll();

			if($this->request->getMethod()=='post'){
				$room = $data['room'];
				$oldPhotoName = $room['photo'];

				$file = $this->request->getFile('photo');

				if($file->isValid() && ! $file->hasMoved()){
					if(file_exists("uploads/".$oldPhotoName)){
						unlink("uploads/".$oldPhotoName);
					}
					$photoName = $file->getRandomName();
					$file->move('uploads/', $photoName);
				}
				else{
					$photoName = $room['photo'];
				}
				$data =[
					'name' => $this->request->getVar('name'),
					'floor' => $this->request->getVar('floor'),
					'photo' => $photoName,
					'room_type_id' => $this->request->getVar('room_type_id'),
					'room_status_id' => $this->request->getVar('room_status_id'),
				];

				if($this->roomModel->update($id, $data) === true){
					$this->session->setTempdata('success', 'Updated Successfully!', 3);
					return redirect()->to(base_url().'/room');
				} else {
					$this->session->setTempdata('error', 'Update Failed!', 3);
				}
			}

			return view('room/edit',$data);
		}
		return view('errors/html/error_404');
	}

	public function delete($id=null){
		if($this->session->has('logged_in')&& $this->permcheck->check($this->session->get('id'),'RoomDelete')){
			if($this->roomModel->where('room_id',$id)->delete() === true){
				$this->session->setTempdata('success', 'Deleted Successfully!', 3);
				return redirect()->to(base_url().'/room');
			}
			else{
				$this->session->setTempdata('error', 'Delete Failed!', 3);
			}
		}
		return view('errors/html/error_404');
	}
}