<?php

namespace App\Controllers;
use App\Models\PaymentTypeModel;

class PaymentType extends BaseController
{	
	public function __construct() {
		helper('url');
        helper('form');
		$this->paymentType = new paymentTypeModel();
		$this->session = \Config\Services::session();
    }

	public function index()
	{	
		if($this->session->has('logged_in')){
			date_default_timezone_set('Asia/Manila');
			$data['payment_types'] = $this->paymentType->findAll();
			return view('payment/type/index', $data);
		}
		return view('errors/html/error_404');
	}

	public function add(){
		if($this->session->has('logged_in')){
			date_default_timezone_set('Asia/Manila');

			if($this->request->getMethod()=='post'){
				$data =[
					'name' => $this->request->getVar('name'),
					'description' => $this->request->getVar('description'),
				];

				if($this->paymentType->save($data) === true){
					$this->session->setTempdata('success', 'Added Successfully!', 3);
					return redirect()->to(base_url().'/payment/type');
				} else {
					$this->session->setTempdata('error', 'Adding Failed!', 3);
				}
			}
			return view('payment/type/add');
		}
		return view('errors/html/error_404');
	}

	public function edit($id=null){
		if($this->session->has('logged_in')){
			date_default_timezone_set('Asia/Manila');
			$data['payment_type'] = $this->paymentType->find($id);
			
			if($this->request->getMethod()=='post'){
				$data =[
					'name' => $this->request->getVar('name'),
					'description' => $this->request->getVar('description'),
				];

				if($this->paymentType->update($id, $data) === true){
					$this->session->setTempdata('success', 'Updated Successfully!', 3);
					return redirect()->to(base_url().'/payment/type');
				} else {
					$this->session->setTempdata('error', 'Update Failed!', 3);
				}
			}
			return view('payment/type/edit', $data);
		}
		return view('errors/html/error_404');
	}

	public function delete($id=null){
		if($this->session->has('logged_in')){
			if($this->paymentType->where('payment_type_id',$id)->delete()){
				$this->session->setTempdata('success', 'Deleted Successfully!', 3);
				return redirect()->to(base_url().'/payment/type');
			}else{
				$this->session->setTempdata('error', 'Delete Failed!', 3);
			}
		}
		return view('errors/html/error_404');
	}
}
