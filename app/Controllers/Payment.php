<?php

namespace App\Controllers;

class Payment extends BaseController
{
	public function index()
	{	
		return view('payment/type/add');
	}
}
