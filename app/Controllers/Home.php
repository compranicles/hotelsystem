<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{	
		date_default_timezone_set('Asia/Manila');
		return date('Y-m-d');
	}
}
