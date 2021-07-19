<?php

namespace App\Controllers;

use App\Models\ShowModel;
use App\Controllers\PermissionChecker;

class CheckIn extends BaseController{

    public function __construct() {
        $this->showModel = new ShowModel();
        $this->permcheck = new PermissionChecker();
    }

    public function index(){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'), 'CheckIn')){
            $data['checkins'] = $this->showModel->getDataUsingId($this->session->get('id'));
            return view('user/checkins', $data);
        }
        return view('errors/html/error_404');
    }
}