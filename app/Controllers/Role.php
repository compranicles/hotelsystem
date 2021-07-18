<?php

namespace App\Controllers;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\RolePermModel;
use App\Controllers\PermissionChecker;

class Role extends BaseController{

    public function __construct(){
        $this->roleModel = new RoleModel();
        $this->session = \Config\Services::session();
        $this->permcheck = new PermissionChecker();
    }

    public function index() {
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'Role')){
            $data['roles'] = $this->roleModel->findAll();
            return view('role/index', $data);
        }
        return view('errors/html/error_404');
    }
    
    public function add(){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'RoleAdd')){
            if($this->request->getMethod() == 'post'){
                $data = [
                    'name' => $this->request->getVar('name'),
                    'description' => $this->request->getVar('description'),
                ];

                if($this->roleModel->save($data) === true){
                    $this->session->setTempdata('success_role', 'Added Successfully!', 3);
                    return redirect()->to(base_url().'/role');
                } else {
                    $this->session->setTempdata('error_role', 'Adding Failed!', 3);
                }
            }
        return view('role/add');
        }
        return view('errors/html/error_404');
    }

    public function edit($id=null){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'RoleEdit')){
            $data['role'] = $this->roleModel->find($id);

            if($this->request->getMethod() == 'post'){
                $data = [
                    'name' => $this->request->getVar('name'),
                    'description' => $this->request->getVar('description'),
                ];

                if($this->roleModel->update($id, $data) === true){
                    $this->session->setTempdata('success_role', 'Updated Successfully!', 3);
                    return redirect()->to(base_url().'/role');
                } else {
                    $this->session->setTempdata('error_role', 'Update Failed!', 3);
                }
            }
            return view('role/edit', $data);
        }
        return view('errors/html/error_404');
    }

    public function delete($id=null){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'RoleDelete')){
            if($this->roleModel->where('role_id', $id)->delete()){
                $this->session->setTempdata('success_role', 'Deleted Successfully!', 3);
                return redirect()->to(base_url().'/role');
            } else {
                $this->session->setTempdata('error_role', 'Delete Failed!', 3);
            }
        }
        return view('errors/html/error_404');

    }

    public function permission($id=null) {
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'RolePermission')){
            $permission = new PermissionModel();
            $roleperm = new RolePermModel();
            $data['role'] = $this->roleModel->find($id);
            $data['permunselected'] = $permission->getUnselected($id);
            $data['permselected'] = $roleperm->getSelected($id);
            return view('role/selectpermission', $data);
        }
        return view('errors/html/error_404');

    }

    public function addPermissionToRole($role_id= null, $permission_id= null){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'RolePermissionAdd')){
            $roleperm = new RolePermModel();
            $data = [
                'role_id' => $role_id,
                'permission_id' => $permission_id
            ];
            if($roleperm->save($data) === true){
                $this->session->setTempdata('success_perm_role', 'Added Successfully!', 3);
                return redirect()->to(base_url().'/role/permission/'.$role_id);
            } else {
                $this->session->setTempdata('error_perm_role', 'Adding Failed!', 3);
                return redirect()->to(base_url().'/role/permission/'.$role_id);
            }
        }
        return view('errors/html/error_404');

    }

    public function removePermissionToRole($role_id= null, $rope_id= null){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'RolePermissionRemove')){
            $roleperm = new RolePermModel();
            if($roleperm->where('role_perm_id', $rope_id)->delete()){
                $this->session->setTempdata('success_perm_role', 'Removed Successfully!', 3);
                return redirect()->to(base_url().'/role/permission/'.$role_id);
            } else {
                $this->session->setTempdata('error_perm_role', 'Removing Failed!', 3);
                return redirect()->to(base_url().'/role/permission/'.$role_id);
            }
        }
        return view('errors/html/error_404');

    }
}