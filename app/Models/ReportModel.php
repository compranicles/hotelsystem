<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class ReportModel extends Model{

    public function countCheckIns($date1, $date2){
        $query = $this->db->query("
            SELECT
                COUNT(show_id) as checkins
            FROM shows
                WHERE (DATE(date_checked_in) BETWEEN '$date1' and '$date2')
        ");
        return $query->getResultArray();
    }

    public function countCheckOuts($date1, $date2){
        $query = $this->db->query("
            SELECT
                COUNT(show_id) as checkouts
            FROM shows
                WHERE (DATE(date_checked_out) BETWEEN '$date1' and '$date2')
        ");
        return $query->getResultArray();
    }

    public function countCancels($date1, $date2){
        $query = $this->db->query("
            SELECT
                COUNT(cancelled_reservation_id) as cancels
            FROM cancelled_reservations
                WHERE (DATE(cancellation_date) BETWEEN '$date1' and '$date2')
        ");
        return $query->getResultArray();
    }

    public function countGuests($date1){
        $query = $this->db->query("
            SELECT
                SUM(reservations.no_of_guests) as guests
            FROM reservations
                INNER JOIN bookings ON bookings.reservation_id = reservations.reservation_id
                INNER JOIN shows ON shows.booking_id = bookings.booking_id
            WHERE (DATE(shows.date_checked_in) <= '$date1') AND (shows.date_checked_out IS NULL OR shows.date_checked_out = '')
        ");
        return $query->getResultArray();
    }

    public function payments($date1, $date2){
        $query = $this->db->query("
            SELECT
                payment_type_id, COUNT(payment_type_id) as paymenttypecount
            FROM payments
            WHERE DATE(payment_date) BETWEEN '$date1' AND '$date2'
            GROUP BY payment_type_id
        ");
        return $query->getResultArray();
    }

    public function countExpectedCheckIns($date1, $date2){
        $query = $this->db->query("
            SELECT
                COUNT(reservations.reservation_id) as echeckins
            FROM reservations
            INNER JOIN bookings
                ON reservations.reservation_id = bookings.reservation_id  
            WHERE reservations.reservation_id NOT IN (SELECT shows.booking_id FROM shows WHERE shows.booking_id = bookings.booking_id)
            AND reservations.reservation_id NOT IN (SELECT cancelled_reservations.reservation_id FROM cancelled_reservations WHERE cancelled_reservations.reservation_id = reservations.reservation_id)
            AND (DATE(reservations.arrival_date) BETWEEN '$date1' AND '$date2')
        ");
        return $query->getResultArray();
    }

    public function countExpectedCheckOuts($date1, $date2){
        $query = $this->db->query("
            SELECT
                COUNT(reservations.reservation_id) as echeckouts
            FROM reservations
            INNER JOIN bookings
                ON reservations.reservation_id = bookings.reservation_id  
            WHERE reservations.reservation_id NOT IN (SELECT shows.booking_id FROM shows WHERE shows.booking_id = bookings.booking_id)
            AND reservations.reservation_id NOT IN (SELECT cancelled_reservations.reservation_id FROM cancelled_reservations WHERE cancelled_reservations.reservation_id = reservations.reservation_id)
            AND (DATE(reservations.departure_date) BETWEEN '$date1' AND '$date2')
        ");
        return $query->getResultArray();
    }

    public function countUnoccupied($date1, $date2){
        $builder = $this->db->table('rooms');
        $builder->selectCount('rooms.room_id');
        $builder->where('rooms.room_status_id', '1');
        $builder->where('rooms.date_deleted', NULL);
        $builder->whereNotIn('rooms.room_id', function (BaseBuilder $builder) use($date1, $date2){
            return $builder->select('reservations.room_id')
                    ->from('reservations')
                    ->join('bookings', 'reservations.reservation_id = bookings.booking_id')
                    ->join('shows', 'bookings.booking_id = shows.booking_id')
                    ->where('shows.date_checked_in >=', $date1)->orWhere('shows.date_checked_out <=', $date2);
        });
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function countTotalReservations($date1, $date2){
        $builder = $this->db->table('reservations');
        $builder->selectCount('reservations.reservation_id');
        $builder->whereNotIn('reservations.reservation_id', function (BaseBuilder $builder){
            return $builder->select('cancelled_reservations.reservation_id')
                    ->from('cancelled_reservations');
        });
        $builder->where('reservations.date_created >=', $date1)->where('reservations.date_created <=', $date2);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function totalRevenue($date1, $date2){
        $builder = $this->db->table('payments');
        $builder->selectSum('amount');
        $builder->where('payment_date >=', $date1)->where('payment_date <=', $date2);
        $query = $builder->get();
        return $query->getResultArray();
    }

    // public function countRooms(){
    //     $builder = $this->db->table('rooms');
    //     $builder->selectCount('room_id');
    //     $query = $builder->get();
    //     return $query->getResultArray();       
    // }
}