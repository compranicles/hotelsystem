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
                pm.name as typename, COUNT(p.payment_type_id) as paymenttypecount
            FROM payments p
            INNER JOIN payment_types pm 
                ON pm.payment_type_id = p.payment_type_id
            WHERE DATE(p.payment_date) BETWEEN '$date1' AND '$date2'
            GROUP BY p.payment_type_id
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
            WHERE bookings.booking_id NOT IN (SELECT shows.booking_id FROM shows WHERE shows.booking_id = bookings.booking_id)
                AND reservations.reservation_id NOT IN (SELECT cancelled_reservations.reservation_id FROM cancelled_reservations WHERE cancelled_reservations.reservation_id = reservations.reservation_id)
                AND (DATE(reservations.date_created) BETWEEN '$date1' AND '$date2')
                AND (DATE(reservations.arrival_date) >= '$date2')
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
            INNER JOIN shows
                ON shows.booking_id = bookings.booking_id
            WHERE reservations.reservation_id NOT IN (SELECT cancelled_reservations.reservation_id FROM cancelled_reservations WHERE cancelled_reservations.reservation_id = reservations.reservation_id)
            AND (DATE(reservations.departure_date) BETWEEN '$date1' AND '$date2')
            AND shows.date_checked_out IS NULL
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

    public function countNoShows($date1, $date2){
        $query = $this->db->query("
            SELECT DISTINCT		
                bk.booking_id as booking_id,
                CASE WHEN c.reservation_id IS NULL THEN 0 ELSE 1 END as cancelled,
                CASE WHEN s.booking_id IS NULL THEN 0 ELSE 1 END as noshows
            FROM bookings bk
            INNER JOIN reservations r 
                ON bk.reservation_id = r.reservation_id
            LEFT JOIN cancelled_reservations c 
                ON r.reservation_id = c.reservation_id
            LEFT JOIN shows s 
                ON bk.booking_id = s.booking_id
            WHERE (DATE(r.departure_date) BETWEEN '$date1' AND '$date2') AND (DATE(r.arrival_date) BETWEEN '$date1' and '$date2')
        ");
        return $query->getResultArray();
    }

    public function lossFromCancels($date1, $date2){
        $query = $this->db->query("
            SELECT
                ABS(SUM(rt.price * DATEDIFF(r.arrival_date, r.departure_date))) as losscancels
            FROM cancelled_reservations c
            INNER JOIN reservations r
                ON r.reservation_id = c.reservation_id
            INNER JOIN rooms rm
                ON rm.room_id = r.room_id
            INNER JOIN room_types rt
                ON rt.room_type_id = rm.room_type_id
            WHERE (DATE(c.cancellation_date) BETWEEN '$date1' and '$date2')
        ");
        return $query->getResultArray();
    }

    public function lossFromNoShows($date1, $date2){
        $query = $this->db->query("
            SELECT 
                bk.booking_id as booking_id,
                ABS(rt.price * DATEDIFF(r.arrival_date, r.departure_date)) as lossamount,
                CASE WHEN s.booking_id IS NULL THEN 0 ELSE 1 END as noshows
            FROM bookings bk
            INNER JOIN reservations r 
                ON bk.reservation_id = r.reservation_id
            INNER JOIN rooms rm
                ON rm.room_id = r.room_id
            INNER JOIN room_types rt
                ON rt.room_type_id = rm.room_type_id
            LEFT JOIN shows s 
                ON bk.booking_id = s.booking_id
            WHERE (DATE(r.departure_date) BETWEEN '$date1' AND '$date2') AND (DATE(r.arrival_date) BETWEEN '$date1' and '$date2')
        ");
        return $query->getResultArray();
    }
    
    public function getAllReservations($date1, $date2){
        $query = $this->db->query("
            SELECT DISTINCT		
                bk.booking_id as booking_id,
                r.reservation_id as reservation_id,
                u.first_name as first_name,
                u.last_name as last_name,
                r.arrival_date as start_date,
                r.departure_date as end_date,
                r.no_of_guests as guests,
                r.date_created as date_reserved,
                o.name as room_name,
                CASE WHEN c.reservation_id IS NULL THEN 0 ELSE 1 END as cancelled,
                CASE WHEN s.booking_id IS NULL THEN 0 ELSE 1 END as showed
            FROM bookings bk
            INNER JOIN reservations r 
                ON bk.reservation_id = r.reservation_id
            INNER JOIN users u
                ON bk.user_id = u.user_id
            LEFT JOIN rooms o 
                ON r.room_id = o.room_id
            LEFT JOIN cancelled_reservations c 
                ON r.reservation_id = c.reservation_id
            LEFT JOIN shows s 
                ON bk.booking_id = s.booking_id
            WHERE DATE(r.date_created) BETWEEN '$date1' and '$date2'
        ");
        return $query->getResultArray();
    }

    public function getAllPayments($date1, $date2){
        $query = $this->db->query("
            SELECT
                payments.payment_id as payment_id, 
                payments.booking_id as booking_id,
                users.first_name as first_name,
                users.last_name as last_name,
                payments.payment_date as payment_date,
                payment_types.name as payment_type,
                payments.amount as amount
            FROM payments
            INNER JOIN bookings
                ON bookings.booking_id = payments.booking_id
            INNER JOIN users
                ON users.user_id = bookings.user_id
            INNER JOIN payment_types
                ON payment_types.payment_type_id = payments.payment_type_id
            WHERE (DATE(payments.payment_date) BETWEEN '$date1' and '$date2')
        ");
        return $query->getResultArray();
    }


    // public function countRooms(){
    //     $builder = $this->db->table('rooms');
    //     $builder->selectCount('room_id');
    //     $query = $builder->get();
    //     return $query->getResultArray();       
    // }
}