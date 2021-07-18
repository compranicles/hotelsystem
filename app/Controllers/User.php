<?php

namespace App\Controllers;
use App\Models\RoleModel;
use App\Models\UserModel;
use App\Models\UserAccessModel;
use App\Controllers\PermissionChecker;

class User extends BaseController{

    public function __construct() {
        helper(['form', 'url']);
        $this->permcheck = new PermissionChecker();
    }

    public function index(){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'User')){
            $userModel = new UserModel();
            $data['users'] = $userModel->findAll();
            return view('user/index', $data);
        }
        return view('errors/html/error_404');
    }

    public function dashboard(){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'UserDashboard')){
            return redirect()->to(base_url());
        }
        elseif($this->session->has('logged_in')){
            return redirect()->to(base_url().'/reservation/view');
        }
        return view('errors/html/error_404');
    }

    public function add(){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'UserAdd')){
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
        return view('errors/html/error_404');
    }

    public function view($id=null){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'UserView')){
            $userModel = new UserModel();
            $data['user'] = $userModel->find($id);
            return view('user/view', $data);
        }
        return view('errors/html/error_404');
    }

    public function role($user_id){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'UserRole')){
            $uacModel = new UserAccessModel();
            $userModel = new UserModel();
            $roleModel = new RoleModel();
            $data['user'] = $userModel->find($user_id);
            $data['roleselected'] = $uacModel->getSelected($user_id);
            $data['roleunselected'] =$roleModel->getUnselected($user_id);
            return view('user/selectrole', $data);
        }
        return view('errors/html/error_404');
    }

    public function edit(){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'UserEdit')){
            $userModel = new UserModel();
            $id = $this->session->get('id');
            $data['user'] = $userModel->find($id);
            if($this->request->getMethod()=='post'){
                $data=[
                    'first_name' => $this->request->getVar('first_name'),
                    'last_name' => $this->request->getVar('last_name'),
                    'date_of_birth' => $this->request->getVar('date_of_birth'),
                    'gender' => $this->request->getVar('gender'),
                    'email_address' => $this->request->getVar('email'),
                    'mobile_number' => $this->request->getVar('phone_number'),
                    'password' => $data['user']['password'],
                ];
                if($userModel->update($id, $data) === true){
                    $this->session->setTempdata('success_edit', 'Edit Successfully!', 3);
                    return redirect()->to(base_url().'/user/edit');
                }
                else{
                    $this->session->setTempdata('error_edit', 'Edit Failed!', 3);
                }
            }
            return view('user/edit', $data);
        }
        return view('errors/html/error_404');
    }

    public function delete($id){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'UserDelete')){
            $userModel = new UserModel();
            if($userModel->where('user_id', $id)->delete() === true){
                $this->session->setTempdata('success_user', 'Deleted Successfully!', 3);
                return redirect()->to(base_url().'/user');
            } else {
                $this->session->setTempdata('error_user', 'Delete Failed!', 3);
            }
        }
        return view('errors/html/error_404');
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
        return view('errors/html/error_404');
    }

    public function addRoleToUser($user_id= null, $role_id= null){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'UserRoleAdd')){
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
        return view('errors/html/error_404');
    }

    public function removeRoleToUser($user_id= null, $uac_id= null){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'),'UserRoleRemove')){
            $uacModel = new UserAccessModel();
            if($uacModel->where('user_access_id', $uac_id)->delete()){
                $this->session->setTempdata('success_role_user', 'Removed Successfully!', 3);
                return redirect()->to(base_url().'/user/role/'.$user_id);
            } else {
                $this->session->setTempdata('error_role_user', 'Removing Failed!', 3);
            }
        }
        return view('errors/html/error_404');
    }

    public function changePassword() {
        if($this->session->has('logged_in')){
            $userModel = new UserModel();

            $data = [];
            if ($this->request->getMethod() == 'post') {
                $rules = [
                    'current_pw' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Please enter your current password.',
                        ]
                    ],
                    'new_pw' => [
                        'rules' => 'required|min_length[8]',
                        'errors' => [
                            'required' => 'Please enter your new password.',
                            'min_length' => 'New password must atleast {param} characters long',
                        ]
                    ],
                    'confirm_new_pw' => [
                        'rules' => 'required|matches[new_pw]',
                        'errors' => [
                            'required' => 'Please confirm your new password.',
                            'matches' => 'New passwords do not match.'
                        ]
                    ]
                ];

                if ($this->validate($rules)) {
                    $current_pw = $this->request->getVar('current_pw');
                    $new_pw = password_hash($this->request->getVar('new_pw'), PASSWORD_DEFAULT);

                    //session PLEASE DELETE
                    $userId = $this->session->get('id');
                    $userdata = $userModel->getPassword($userId);

                    $data = [
                        'password' => $new_pw
                    ];

                    // ID = 7 temporary
                    if ($userdata) {
                        if (password_verify($current_pw, $userdata['password'])) {
                            if ($userModel->update($userId, $data)) {
                                $this->session->setTempdata('success_chpw', 'Password Changed Successfully!', 3);
                                return redirect()->to(base_url().'/user/changepassword');
                            } else {
                                $this->session->setTempdata('error_chpw', 'Changing Password Failed!', 3);
                                return redirect()->to(base_url().'/user/changepassword');
                            }
                        }
                        else {
                            $this->session->setTempdata('error_chpw', 'Wrong Password!', 3);
                            return redirect()->to(current_url());
                        }
                    } else {
                        echo 'No data';
                    }
                } else {
                    $data['validation'] = $this->validator;
                }
            }
                return view('user/changepassword', $data); 
        }
        return view('errors/html/error_404');
    }


    public function logout(){
        if($this->session->has('logged_in')){
            $this->session->destroy();
            return redirect()->to(base_url());
        }
        else{
            return redirect()->to(base_url());
        }
    }
}
