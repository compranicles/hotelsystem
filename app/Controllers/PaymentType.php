<?php

namespace App\Controllers;
use App\Models\PaymentTypeModel;

class PaymentType extends BaseController
{	
	public function __construct() {
		helper('url');
        helper('form');
		$this->paymentType = new paymentTypeModel();
    }

	public function index()
	{	
		return view('payment/type/index');
	}

	public function add(){
		return view('payment/type/add');
	}
}
