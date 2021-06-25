<?php

namespace App\Controllers;
use App\Models\UserModel;

class Register extends BaseController{

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index(){
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

            if($this->userModel->save($data) === true){
                return redirect()->to(base_url().'/user/dashboard');
            } else {
                $this->session->setTempdata('register_error', 'Registration Failed!', 3);
            }
        }
        return view('register/index');
    }
}