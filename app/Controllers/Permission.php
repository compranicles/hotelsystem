<?php

namespace App\Controllers;
use App\Models\PermissionModel;

class Permission extends BaseController{
    
    public function __construct() {
        $this->permissionModel = new PermissionModel();
        $this->session = \Config\Services::session();
    }

    public function index(){
        if($this->session->has('logged_in')){
            $data['permissions'] = $this->permissionModel->findAll();
            return view('permission/index', $data);
        }
        return view('errors/html/error_404');
    }

    public function add(){
        if($this->session->has('logged_in')){
            if($this->request->getMethod()=='post'){
                $data = [
                    'name' => $this->request->getVar('name'),
                    'description' => $this->request->getVar('description'),
                ];

                if($this->permissionModel->save($data) === true){
                    $this->session->setTempdata('success', 'Added Successfully!', 3);
                    return redirect()->to(base_url().'/permission');
                } else {
                    $this->session->setTempdata('error', 'Adding Failed!', 3);
                }
            }

            return view('permission/add');
        }
        return view('errors/html/error_404');
    }

    public function edit($id=null){
        if($this->session->has('logged_in')){
            $data['permission'] = $this->permissionModel->find($id);

            if($this->request->getMethod() == 'post'){
                $data = [
                    'name' => $this->request->getVar('name'),
                    'description' => $this->request->getVar('description'),
                ];

                if($this->permissionModel->update($id, $data) === true){
                    $this->session->setTempdata('success', 'Updated Successfully!', 3);
                    return redirect()->to(base_url().'/permission');
                } else {
                    $this->session->setTempdata('error', 'Update Failed!', 3);
                }
            }
            return view('permission/edit', $data);
        }
        return view('errors/html/error_404');
    }

    public function delete($id=null){
        if($this->session->has('logged_in')){
            if($this->permissionModel->where('permission_id', $id)->delete()){
                $this->session->setTempdata('success', 'Deleted Successfully!', 3);
                return redirect()->to(base_url().'/permission');
            } else {
                $this->session->setTempdata('error', 'Delete Failed!', 3);
            }
        }
        return view('errors/html/error_404');
    }

}