<?php

namespace App\Controllers;
use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\RoomModel;
use CodeIgniter\I18n\Time;
use App\Models\ReportModel;
use App\Models\PaymentTypeModel;
use App\Controllers\PermissionChecker;

class Report extends BaseController{
    
    public function __construct() {
        $this->permcheck = new PermissionChecker();
    }
    public function index(){
        if($this->session->has('logged_in') && $this->permcheck->check($this->session->get('id'), 'Report')){
            date_default_timezone_set('Asia/Manila');
            $reportModel = new ReportModel();
            $paymentTypeModel = new PaymentTypeModel();
            $minusOneMonth = date('Y-m-d', strtotime('-1 months'));
            $today = date('Y-m-d', strtotime('today'));

            if($this->request->getMethod()=='post'){
                $datestart = $this->request->getVar('start_date');
                $dateend = $this->request->getVar('end_date');
                $begin = new DateTime($datestart);
                $end = new DateTime($dateend);
                $end = $end->modify("+1 day");

                $interval = new DateInterval('P1D');
                $period = new DatePeriod($begin, $interval, $end);
                $countDays = 0;
                $totalRooms = 0;
                foreach ($period as $date) {
                    $date = date("Y-m-d", strtotime($date->getTimestamp()));
                    $totalRooms += $reportModel->countUnoccupied($date)[0]['room_id'];
                    $countDays++;
                }
                $aveNumVaRoom = $totalRooms/$countDays;
                $data = [
                    'datestart' => date("F j, Y",strtotime($datestart)),
                    'dateend' => date("F j, Y",strtotime($dateend)),
                    'checkins' => $reportModel->countCheckIns($today, $today)[0]['checkins'],
                    'checkouts' => $reportModel->countCheckOuts($today, $today)[0]['checkouts'],
                    'cancels' => $reportModel->countCancels($today, $today)[0]['cancels'],
                    'guests' => $reportModel->countGuests($today)[0]['guests'],
                    'paymentrecords' => $reportModel->payments($datestart, $dateend),
                    'rangecheckins' => $reportModel->countCheckIns($datestart, $dateend)[0]['checkins'],
                    'rangecheckouts' => $reportModel->countCheckOuts($datestart, $dateend)[0]['checkouts'],
                    'rangecancels' => $reportModel->countCancels($datestart, $dateend)[0]['cancels'],
                    'rangePendingCheckins' => $reportModel->countExpectedCheckIns($datestart, $dateend)[0]['echeckins'],
                    'rangePendingCheckouts' => $reportModel->countExpectedCheckOuts($datestart, $dateend)[0]['echeckouts'],
                    'rangeunoccupied' => $aveNumVaRoom,
                    'rangereservations' => $reportModel->countTotalReservations($datestart, $dateend)[0]['reservation_id'],
                    'totalrevenue' => $reportModel->totalRevenue($datestart, $dateend)[0]['amount'],
                    'totalnoshows' => $reportModel->countNoShows($datestart, $dateend),
                    'totallosscancel' => $reportModel->lossFromCancels($datestart, $dateend)[0]['losscancels'],
                    'lossnoshows' => $reportModel->lossFromNoShows($datestart, $dateend),
                    'reservations' => $reportModel->getAllReservations($datestart, $dateend),
                    'payments' => $reportModel->getAllPayments($datestart, $dateend),
                ];
            }
            else{
                $begin = new DateTime($minusOneMonth);
                $end = new DateTime($today);
                $end = $end->modify("+1 day");

                $interval = new DateInterval('P1D');
                $period = new DatePeriod($begin, $interval, $end);
                $countDays = 0;
                $totalRooms = 0;
                foreach ($period as $date) {
                    $date = date("Y-m-d", strtotime($date->getTimestamp()));
                    $totalRooms += $reportModel->countUnoccupied($date)[0]['room_id'];
                    $countDays++;
                }
                $aveNumVaRoom = $totalRooms/$countDays;
                $data = [
                    'datestart' => date("F j, Y",strtotime($minusOneMonth)),
                    'dateend' => date("F j, Y",strtotime($today)),
                    'checkins' => $reportModel->countCheckIns($today, $today)[0]['checkins'],
                    'checkouts' => $reportModel->countCheckOuts($today, $today)[0]['checkouts'],
                    'cancels' => $reportModel->countCancels($today, $today)[0]['cancels'],
                    'guests' => $reportModel->countGuests($today)[0]['guests'],
                    'paymentrecords' => $reportModel->payments($minusOneMonth, $today),
                    'rangecheckins' => $reportModel->countCheckIns($minusOneMonth, $today)[0]['checkins'],
                    'rangecheckouts' => $reportModel->countCheckOuts($minusOneMonth, $today)[0]['checkouts'],
                    'rangecancels' => $reportModel->countCancels($minusOneMonth, $today)[0]['cancels'],
                    'rangePendingCheckins' => $reportModel->countExpectedCheckIns($minusOneMonth, $today)[0]['echeckins'],
                    'rangePendingCheckouts' => $reportModel->countExpectedCheckOuts($minusOneMonth, $today)[0]['echeckouts'],
                    'rangeunoccupied' => $aveNumVaRoom,
                    'rangereservations' => $reportModel->countTotalReservations($minusOneMonth, $today)[0]['reservation_id'],
                    'totalrevenue' => $reportModel->totalRevenue($minusOneMonth, $today)[0]['amount'],
                    'totalnoshows' => $reportModel->countNoShows($minusOneMonth, $today),
                    'totallosscancel' => $reportModel->lossFromCancels($minusOneMonth, $today)[0]['losscancels'],
                    'lossnoshows' => $reportModel->lossFromNoShows($minusOneMonth, $today),
                    'reservations' => $reportModel->getAllReservations($minusOneMonth, $today),
                    'payments' => $reportModel->getAllPayments($minusOneMonth, $today),
                ];
            }
            // print_r($data);
            // echo date('d-m-y h:i:s');
            return view('report/index', $data);
        }
        return view('errors/html/error_404');
    }

}