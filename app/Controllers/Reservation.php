<?php

namespace App\Controllers;

class Reservation extends BaseController
{
	public function index()
	{
		return view('reservation/create');
	}
}