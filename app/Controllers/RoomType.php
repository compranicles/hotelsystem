<?php

namespace App\Controllers;
use App\Models\RoomTypeModel;

class RoomType extends BaseController
{
    public function __construct() {
        helper('form');
		$this->roomTypeModel = new RoomTypeModel();
    }

	public function index()
	{
		date_default_timezone_set('Asia/Manila');
        $data['room_types'] = $this->roomTypeModel->findAll();
		return view('room/type/show', $data);
	}

    public function add(){
        date_default_timezone_set('Asia/Manila');
        if($this->request->getMethod()=='post'){
			$data =[
				'room_type_name' => $this->request->getVar('room_type_name'),
				'room_rate' => $this->request->getVar('room_rate'),
			];

			if($this->roomTypeModel->save($data) === true){
				return redirect()->to(base_url().'/room/type/add');
			}
		}
        return view('room/type/add');
    }

    public function edit($id=null){
        date_default_timezone_set('Asia/Manila');
        $data['room_type'] = $this->roomTypeModel->find($id);
        if($this->request->getMethod()=='post'){
            $data = [
                'room_type_name' => $this->request->getVar('room_type_name'),
				'room_rate' => $this->request->getVar('room_rate'),
            ];

            if($this->roomTypeModel->update($id, $data) === true){
                return redirect()->to(base_url().'/room/type');
            }
        }
        return view('room/type/edit', $data);
    }

    public function delete($id=null){
        if($this->roomTypeModel->where('id',$id)->delete()){
			return redirect()->to(base_url().'/room/type');
		}
    }
}