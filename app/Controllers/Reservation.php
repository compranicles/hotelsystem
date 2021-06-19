<?php

namespace App\Controllers;

class Reservation extends BaseController
{
    public function __construct() {
		helper('url');
        helper('form');
    }

	public function index()
	{
		date_default_timezone_set('Asia/Manila');
		return view('reservation/start');
	}
}