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
		return view('reservation/create');
	}
}