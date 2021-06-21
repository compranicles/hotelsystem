<?php

namespace App\Controllers;
use App\Models\PermissionModel;

class Permission extends BaseController{
    
    public function __construct() {
        $this->permissionModel = new PermissionModel();
    }

    public function index(){
        $data['permissions'] = $this->permissionModel->findAll();
        return view('permission/index', $data);
    }

    public function add(){

        if($this->request->getMethod()=='post'){
            $data = [
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
            ];

            if($this->permissionModel->save($data) === true){
                return redirect()->to(base_url().'/permission');
            }
        }

        return view('permission/add');
    }

    public function edit($id=null){
        
        $data['permission'] = $this->permissionModel->find($id);

        if($this->request->getMethod() == 'post'){
            $data = [
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
            ];

            if($this->permissionModel->update($id, $data) === true){
                return redirect()->to(base_url().'/permission');
            }
        }
        return view('permission/edit', $data);
    }

    public function delete($id=null){
        if($this->permissionModel->where('permission_id', $id)->delete()){
            return redirect()->to(base_url().'/permission');
        }
    }

}