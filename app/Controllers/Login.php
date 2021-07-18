<?php

namespace App\Controllers;
use App\Models\UserModel;

class Login extends BaseController{

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index(){
        if($this->session->has('logged_in')){
            return redirect()->to(base_url().'/user/dashboard');
        }
        if($this->request->getMethod()=='post'){
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');     
            $userdata = $this->userModel->where('email_address', $email)
                                        ->findall();
            // return view('login/index', $userdata); 
            if($userdata){
                if(password_verify($password, $userdata[0]['password'])){
                    //email and password correct
                    //more session code here
                    $userinfo = [
                        'id' => $userdata[0]['user_id'],
                        'first_name' => $userdata[0]['first_name'],
                        'last_name' => $userdata[0]['last_name'],
                        'email' => $userdata[0]['email_address'],
                        'logged_in' => true
                    ];
                    $this->session->set($userinfo);
                    if($this->session->has('room_id')){
                        return redirect()->to(base_url().'/reservation/reservefses');
                    }
                    return redirect()->to(base_url().'/user/dashboard');
                }
                else{
                    //password incorrect
                    $this->session->setTempdata('login_error', 'Password is incorrect', 3);
                    return redirect()->to(current_url());
                }
            }
            else{
                //incorrect email
                $this->session->setTempdata('login_error', 'Email address is incorrect', 3);
                return redirect()->to(current_url());
            }
        }
        return view('login/index');
    }
}