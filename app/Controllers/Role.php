<?php

namespace App\Controllers;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\RolePermModel;

class Role extends BaseController{

    public function __construct(){
        $this->roleModel = new RoleModel();
        $this->session = \Config\Services::session();
    }

    public function index() {
        $data['roles'] = $this->roleModel->findAll();
        return view('role/index', $data);
    }
    
    public function add(){

        if($this->request->getMethod() == 'post'){
            $data = [
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
            ];

            if($this->roleModel->save($data) === true){
                $this->session->setTempdata('success', 'Added Successfully!', 3);
                return redirect()->to(base_url().'/role');
            } else {
                $this->session->setTempdata('error', 'Adding Failed!', 3);
            }
        }
       return view('role/add');
    }

    public function edit($id=null){
        
        $data['role'] = $this->roleModel->find($id);

        if($this->request->getMethod() == 'post'){
            $data = [
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
            ];

            if($this->roleModel->update($id, $data) === true){
                $this->session->setTempdata('success', 'Updated Successfully!', 3);
                return redirect()->to(base_url().'/role');
            } else {
                $this->session->setTempdata('error', 'Update Failed!', 3);
            }
        }
        return view('role/edit', $data);
    }

    public function delete($id=null){
        if($this->roleModel->where('role_id', $id)->delete()){
            $this->session->setTempdata('success', 'Deleted Successfully!', 3);
            return redirect()->to(base_url().'/role');
        } else {
            $this->session->setTempdata('error', 'Delete Failed!', 3);
        }
    }

    public function permission($id=null) {
        
        $permission = new PermissionModel();
        $roleperm = new RolePermModel();
        $data['role'] = $this->roleModel->find($id);
        $data['permunselected'] = $permission->getUnselected($id);
        $data['permselected'] = $roleperm->getSelected($id);
        return view('role/selectpermission', $data);
    }

    public function addPermissionToRole($role_id= null, $permission_id= null){
        $roleperm = new RolePermModel();
        $data = [
            'role_id' => $role_id,
            'permission_id' => $permission_id
        ];
        if($roleperm->save($data) === true){
            $this->session->setTempdata('success', 'Added Successfully!', 3);
            return redirect()->to(base_url().'/role/permission/'.$role_id);
        } else {
            $this->session->setTempdata('error', 'Adding Failed!', 3);
            return redirect()->to(base_url().'/role/permission/'.$role_id);
        }
    }

    public function removePermissionToRole($role_id= null, $rope_id= null){
        $roleperm = new RolePermModel();
        if($roleperm->where('role_perm_id', $rope_id)->delete()){
            $this->session->setTempdata('success', 'Removed Successfully!', 3);
            return redirect()->to(base_url().'/role/permission/'.$role_id);
        } else {
            $this->session->setTempdata('error', 'Removing Failed!', 3);
            return redirect()->to(base_url().'/role/permission/'.$role_id);
        }
    }
}