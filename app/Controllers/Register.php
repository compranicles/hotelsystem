<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UserAccessModel;

class Register extends BaseController{

    public function __construct() {
    }

    public function index(){
        if($this->session->has('logged_in')){
            return redirect()->to(base_url().'/user/dashboard');
        }
        if($this->request->getMethod()=='post'){ 
            $userModel = new UserModel();
            $userAccessModel = new UserAccessModel();
            $data = [
                'first_name' => $this->request->getVar('first_name'),
                'last_name' => $this->request->getVar('last_name'),
                'date_of_birth' => $this->request->getVar('date_of_birth'),
                'gender' => $this->request->getVar('gender'),
                'email_address' => $this->request->getVar('email'),
                'mobile_number' => $this->request->getVar('phone_number'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $userModel->insert($data);
            $user_id = $userModel->getInsertID();
            $roledata = [
                'user_id' => $user_id,
                'role_id' => '3'
            ];
                
            if($userAccessModel->save($roledata) === true){
                $this->session->setTempdata('register_success', 'Registration Success! Log In to Continue', 3);
                return redirect()->to(base_url().'/login');
            }
            else{
                $this->session->setTempdata('register_error', 'Registration Failed!', 3);
            }
        }
        return view('register/index');
    }
}