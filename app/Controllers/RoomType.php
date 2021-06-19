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
		return view('room/type/index', $data);
	}

    public function add(){
        date_default_timezone_set('Asia/Manila');
        if($this->request->getMethod()=='post'){
			$data =[
				'name' => $this->request->getVar('name'),
				'description' => $this->request->getVar('description'),
                'price' => $this->request->getVar('price'),
                'max_guests' => $this->request->getVar('max_guests'),
			];

			if($this->roomTypeModel->save($data) === true){
				return redirect()->to(base_url().'/room/type');
			}
		}
        return view('room/type/add');
    }

    public function edit($id=null){
        date_default_timezone_set('Asia/Manila');

        $data['room_type'] = $this->roomTypeModel->find($id);
        if($this->request->getMethod()=='post'){
            $data =[
				'name' => $this->request->getVar('name'),
				'description' => $this->request->getVar('description'),
                'price' => $this->request->getVar('price'),
                'max_guests' => $this->request->getVar('max_guests'),
			];

            if($this->roomTypeModel->update($id, $data) === true){
                return redirect()->to(base_url().'/room/type');
            }
        }
        return view('room/type/edit', $data);
    }

    public function delete($id=null){
        if($this->roomTypeModel->where('room_type_id',$id)->delete()){
			return redirect()->to(base_url().'/room/type');
		}
    }
}