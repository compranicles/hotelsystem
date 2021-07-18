<?php

namespace App\Controllers;
use App\Models\RoomTypeModel;
use App\Controllers\PermissionChecker;

class RoomType extends BaseController
{
    public function __construct() {
        helper('form');
		$this->roomTypeModel = new RoomTypeModel();
        $this->session = \Config\Services::session();
        $this->permcheck = new PermissionChecker();
    }

	public function index()
	{
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'RoomType')){
            date_default_timezone_set('Asia/Manila');
            $data['room_types'] = $this->roomTypeModel->findAll();
            return view('room/type/index', $data);
        }
        return view('errors/html/error_404');
	}

    public function add(){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'RoomTypeAdd')){
            date_default_timezone_set('Asia/Manila');
            if($this->request->getMethod()=='post'){
                $data =[
                    'name' => $this->request->getVar('name'),
                    'description' => $this->request->getVar('description'),
                    'price' => $this->request->getVar('price'),
                    'max_guests' => $this->request->getVar('max_guests'),
                ];

                if($this->roomTypeModel->save($data) === true){
                    $this->session->setTempdata('success', 'Added Successfully!', 3);
                    return redirect()->to(base_url().'/room/type');
                } else {
                    $this->session->setTempdata('error', 'Adding Failed!', 3);
                }
            }
            return view('room/type/add');
        }
        return view('errors/html/error_404');
    }

    public function edit($id=null){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'RoomTypeEdit')){
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
                    $this->session->setTempdata('success', 'Updated Successfully!', 3);
                    return redirect()->to(base_url().'/room/type');
                } else {
                    $this->session->setTempdata('error', 'Update Failed!', 3);
                }
            }
            return view('room/type/edit', $data);
        }
        return view('errors/html/error_404');
    }

    public function delete($id=null){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'RoomTypeDelete')){
            if($this->roomTypeModel->where('room_type_id',$id)->delete()){
                $this->session->setTempdata('success', 'Deleted Successfully!', 3);
                return redirect()->to(base_url().'/room/type');
            }
            else{
                $this->session->setTempdata('error', 'Delete Failed!', 3);
            }
            return redirect()->to(base_url().'/room/type');
        }
        return view('errors/html/error_404');
    }
}