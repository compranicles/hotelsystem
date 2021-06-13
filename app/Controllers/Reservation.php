<?php

namespace App\Controllers;

class Reservation extends BaseController
{
    public function __construct() {
        helper('form');
    }

	public function index()
	{
		return view('reservation/create');
	}
}