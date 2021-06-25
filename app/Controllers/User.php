<?php

namespace App\Controllers;
use App\Models\RoleModel;
use App\Models\UserModel;
use App\Models\UserAccessModel;

class User extends BaseController{

    public function __construct() {
        $this->session = \Config\Services::session();
    }

    public function index(){
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        return view('user/index', $data);
    }

    public function dashboard(){
        return view('user/dashboard');
    }

    public function add(){
        $role = new RoleModel();
        $data['roles'] = $role->findAll();

        if($this->request->getMethod()=='post'){
            $data = [
                'first_name' => $this->request->getVar('first_name'),
                'last_name' => $this->request->getVar('last_name'),
                'date_of_birth' => $this->request->getVar('date_of_birth'),
                'gender' => $this->request->getVar('gender'),
                'email_address' => $this->request->getVar('email'),
                'mobile_number' => $this->request->getVar('phone_number'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),  
            ];
            $role_id = $this->request->getVar('role');
            $userModel = new UserModel();
            $uacModel = new UserAccessModel();
            $user_id = $userModel->saveDataGetId($data);
            $uacdata = [
                'user_id' => $user_id,
                'role_id' => $role_id
            ];
            if($uacModel->save($uacdata)){
                //add alerts here
                $this->session->setTempdata('success_user', 'Added Successfully!', 3);
                return redirect()->to(base_url().'/user/add');
            } else {
                $this->session->setTempdata('error_user', 'Adding Failed!', 3);
            }
        }
        
        return view('user/add', $data);
    }

    public function view($id=null){
        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);
        return view('user/view', $data);
    }

    public function role($user_id){
        $uacModel = new UserAccessModel();
        $userModel = new UserModel();
        $roleModel = new RoleModel();
        $data['user'] = $userModel->find($user_id);
        $data['roleselected'] = $uacModel->getSelected($user_id);
        $data['roleunselected'] =$roleModel->getUnselected($user_id);
        return view('user/selectrole', $data);
    }

    public function delete($id){
        $userModel = new UserModel();
        if($userModel->where('user_id', $id)->delete() === true){
            $this->session->setTempdata('success_user', 'Deleted Successfully!', 3);
            return redirect()->to(base_url().'/user');
        } else {
            $this->session->setTempdata('error_user', 'Delete Failed!', 3);
        }
    }
    
    public function checkemail(){
        if($this->request->getMethod()=='post'){
            $email = $this->request->getVar('email');
            $userModel = new UserModel();
            if($userModel->checkemail($email)){
                echo "true";
            }
            else{
                echo "false";
            }
        }
    }

    public function addRoleToUser($user_id= null, $role_id= null){
        $uacModel = new UserAccessModel();
        $data = [
            'user_id' => $user_id,
            'role_id' => $role_id
        ];
        if($uacModel->save($data) === true){
            $this->session->setTempdata('success_role_user', 'Added Successfully!', 3);
            return redirect()->to(base_url().'/user/role/'.$user_id);
        } else {
            $this->session->setTempdata('error_role_user', 'Adding Failed!', 3);
        }
    }

    public function removeRoleToUser($user_id= null, $uac_id= null){
        $uacModel = new UserAccessModel();
        if($uacModel->where('user_access_id', $uac_id)->delete()){
            $this->session->setTempdata('success_role_user', 'Removed Successfully!', 3);
            return redirect()->to(base_url().'/user/role/'.$user_id);
        } else {
            $this->session->setTempdata('error_role_user', 'Removing Failed!', 3);
        }
    }
}