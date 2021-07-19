<?php

namespace App\Controllers;
use App\Models\RoomModel;
use CodeIgniter\I18n\Time;
use App\Models\ReportModel;
use App\Controllers\PermissionChecker;

class Report extends BaseController{
    
    public function __construct() {
        $this->permcheck = new PermissionChecker();
    }
    public function index(){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'), 'Report')){
            date_default_timezone_set('Asia/Manila');
            $reportModel = new ReportModel();
            $date1 = Time::today('Asia/Manila', 'en_US')->toDateString();
            $date2 = Time::today('Asia/Manila', 'en_US')->toDateString();
            if($this->request->getMethod()=='post'){
                $date1 = $this->request->getVar('start_date');
                $date2 = $this->request->getVar('end_date');
            }
            $data = [
                'checkins' => $reportModel->countCheckIns($date1, $date2)[0]['checkins'],
                'checkouts' => $reportModel->countCheckOuts($date1, $date2)[0]['checkouts'],
                'cancels' => $reportModel->countCancels($date1, $date2)[0]['cancels'],
                'guests' => $reportModel->countGuests($date1, $date2)[0]['guests'],
            ];
            
            // $data['yest_expected_in'] = $reportModel->countExpectedCheckIns($yesterday)[0]['echeckins'];
            // echo $yesterday;
            // echo $date1, $date2;
            // print_r($data);
            // echo date('d-m-y h:i:s');
            return view('report/index', $data);
        }
        return view('errors/html/error_404');
    }
}