<?= $this->extend('template/layout')?>
<?= $this->section('content')?>
<?= $this->include('bars/navbar')?>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

<div class="container-fluid my-4"> 
    <div class="row">
        <div class="col-md-3">
            <h2 class="ms-4">Reports Dashboard</h2>
        </div>
        <div class="col-md-9">
            <div class="card mx-5">
                <div class="card-body">
                    <?= form_open()?>
                        <div class="row">
                            <div class="col">
                                <h6>
                                    <span class="me-2">Select Date Range:</span> 
                                    <input type="text" name="start_date" id="start_date">
                                    <input type="text" name="end_date" id="end_date" class="me-2">
                                    <input type="submit" name="submit" value="Apply" class="btn btn-sm btn-primary">
                                </h6>
                            </div>
                        </div>
                    <?= form_close()?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="row mt-1 mx-1">
                        <div class="row row-cols-4 row-cols-md-1 g-1">
                            <h4>Today's Stats:</h4>
                            <div class="col">
                                <div class="card border-info mb-3" style="max-width: 15rem;">
                                    <div class="card-body">
                                        <h1 class="card-title text-info"><?= $checkins?></h1>
                                        <h5 class="card-title">Check-Ins</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card border-info mb-3" style="max-width: 15rem;">
                                    <div class="card-body">
                                        <h1 class="card-title text-info"><?= $checkouts?></h1>
                                        <h5 class="card-title">Check-Outs</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card border-info mb-3" style="max-width: 15rem;">
                                    <div class="card-body">
                                        <h1 class="card-title text-info"><?= $guests?></h1>
                                        <h5 class="card-title">Guests In-house</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card border-info mb-3" style="max-width: 15rem;">
                                    <div class="card-body">
                                        <h1 class="card-title text-info"><?= $cancels?></h1>
                                        <h5 class="card-title">Reservations Cancelled</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <!-- Reports Part -->
        <div class="col-md-10">
            <div class="card m-2">
                <div class="card-header">
                    <h4>
                        Data from <span class="text-success"><?= $datestart?></span> to <span class="text-success"><?= $dateend?></span>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card border-dark ms-3 mb-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Preferred Payment Type</div>
                                <div class="card-body text-dark">
                                    <?php if(count($paymentrecords)>0): ?>
                                    <?php foreach($paymentrecords as $row): ?>
                                        <h1 class="card-title text-info"><?= $row['paymenttypecount']?></h1>
                                        <h5 class="card-title"><?= $row['typename']?> Transactions</h5>
                                    <?php endforeach?>
                                    <?php else: ?>
                                        <h1 class="card-title text-info">0</h1>
                                        <h5 class="card-title">Transactions</h5>
                                    <?php endif?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark ms-3 mb-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Number of Check-Ins</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info"><?= $rangecheckins?></h1>
                                    <h5 class="card-title">Check-Ins</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark ms-3 mb-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Number of Check-Outs</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info"><?= $rangecheckouts?></h1>
                                    <h5 class="card-title">Check-Outs</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">No. of Cancelled Reservations</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info"><?= $rangecancels?></h1>
                                    <h5 class="card-title">Cancelled Reservations</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">No. of Pending Reservations</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info"><?= $rangePendingCheckins?></h1>
                                    <h5 class="card-title">Pending Reservations</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">No. of Pending Check-Outs</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info"><?= $rangePendingCheckouts?></h1>
                                    <h5 class="card-title">Pending Check-Outs</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Ave. No. of Vacant Rooms</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info"><?= $rangeunoccupied?></h1>
                                    <h5 class="card-title">Vacant Rooms</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Total No. of Reservations</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info"><?= $rangereservations?></h1>
                                    <h5 class="card-title">Reservations</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Total Revenue</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-success"><?= number_format($totalrevenue, 2, ".", ",")?></h1>
                                    <h5 class="card-title">PHP</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">No. of No Shows</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info">
                                        <?php
                                            $countcancelled = 0; 
                                            $countnoshows = 0;
                                            foreach($totalnoshows as $row){
                                                if($row['noshows'] == 0){
                                                    $countcancelled++;
                                                }
                                                if($row['cancelled'] == 1){
                                                    $countnoshows++;
                                                }
                                            }
                                            echo abs($countnoshows-$countcancelled);
                                        ?>
                                    </h1>
                                    <h5 class="card-title">No-Shows</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Loss From Cancelled Reservations</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-danger"><?= number_format($totallosscancel, 2, '.', ',')?></h1>
                                    <h5 class="card-title">PHP</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Loss From No-Shows</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-danger">
                                        <?php
                                            $totalamount = 0; 
                                            foreach($lossnoshows as $row){
                                                if($row['noshows'] == 0){
                                                    $totalamount += $row['lossamount'];
                                                }
                                            }
                                            echo number_format(abs($totallosscancel-$totalamount), 2, '.', ',');
                                        ?>
                                    </h1>
                                    <h5 class="card-title">PHP</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3 justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <ul class="nav nav-tabs card-header-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="reservation-tab" data-bs-toggle="tab" data-bs-target="#reservation" type="button" role="tab" aria-controls="reservation" aria-selected="true">Reservations</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="revenue-tab" data-bs-toggle="tab" data-bs-target="#revenue" type="button" role="tab" aria-controls="revenue" aria-selected="false">Revenues</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="noshow-tab" data-bs-toggle="tab" data-bs-target="#noshow" type="button" role="tab" aria-controls="noshow" aria-selected="false">No-Shows</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="cancel-tab" data-bs-toggle="tab" data-bs-target="#cancel" type="button" role="tab" aria-controls="cancel" aria-selected="false">Cancels</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body tab-content">
                                    <div class="tab-pane fade show active" id="reservation" role="tabpanel" aria-labelledby="reservation-tab">
                                        <table id="reservation_table" class="table table-hover table-striped table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Reservation ID</th>
                                                    <th>Guest Name</th>
                                                    <th>Room Number</th>
                                                    <th>Arrival Date</th>
                                                    <th>Departure Date</th>
                                                    <th>Guest Count</th>
                                                    <th>Reserved Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count = 1 ?>
                                                <?php foreach($reservations as $reservation): ?>
                                                    <tr>
                                                        <td><?= $count ?></td>
                                                        <td><?= $reservation['reservation_id'] ?></td>
                                                        <td><?= $reservation['last_name'].", ".$reservation['first_name'] ?></td>
                                                        <td><?= $reservation['room_name'] ?></td>
                                                        <td><?= $reservation['start_date'] ?></td>
                                                        <td><?= $reservation['end_date'] ?></td>
                                                        <td><?= $reservation['guests'] ?></td>
                                                        <td><?= $reservation['date_reserved'] ?></td>
                                                        <td>
                                                            <?php if($reservation['cancelled'] == 1): ?>
                                                                <span class="text-danger">Cancelled</span>
                                                            <?php elseif($reservation['showed'] == 1):?>
                                                                <span class="text-success">Showed</span>
                                                            <?php elseif($reservation['showed'] == 0 && $reservation['start_date'] < date('Y-m-d', strtotime('today'))):?>
                                                                <span class="text-secondary">No-Show</span>
                                                            <?php elseif($reservation['showed'] == 0 && $reservation['start_date'] > date('Y-m-d', strtotime('today'))):?>
                                                                <span class="text-warning">Pending</span>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                    <?php $count++ ?>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="revenue" role="tabpanel" aria-labelledby="revenue-tab">
                                        <table id="revenue_table" class="table table-hover table-striped table-responive">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Payment ID</th>
                                                    <th>Booking ID</th>
                                                    <th>Guest Name</th>
                                                    <th>Payment Date</th>
                                                    <th>Payment Type</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $count = 1 ?>
                                                <?php foreach($payments as $payment): ?>
                                                    <tr>
                                                        <td><?= $count ?></td>
                                                        <td><?= $payment['payment_id'] ?></td>
                                                        <td><?= $payment['booking_id'] ?></td>
                                                        <td><?= $payment['last_name'].", ".$payment['first_name'] ?></td>
                                                        <td><?= $payment['payment_date'] ?></td>
                                                        <td><?= $payment['payment_type'] ?></td>
                                                        <td><?= number_format($payment['amount'], 2, '.', ',') ?></td>
                                                    </tr>
                                                    <?php $count++ ?>
                                                <?php endforeach ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th class="text-end">Total:</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="noshow" role="tabpanel" aria-labelledby="noshow-tab">
                                        <table id="noshow_table" class="table table-hover table-responsive table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Reservation ID</th>
                                                    <th>Guest Name</th>
                                                    <th>Room Number</th>
                                                    <th>Arrival Date</th>
                                                    <th>Departure Date</th>
                                                    <th>Guest Count</th>
                                                    <th>Reserved Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count = 1 ?>
                                                <?php foreach($reservations as $reservation): ?>
                                                    <?php if($reservation['showed'] == 0 && $reservation['start_date'] < date('Y-m-d', strtotime('today')) && $reservation['cancelled'] == 0): ?>
                                                        <tr>
                                                            <td><?= $count ?></td>
                                                            <td><?= $reservation['reservation_id'] ?></td>
                                                            <td><?= $reservation['last_name'].", ".$reservation['first_name'] ?></td>
                                                            <td><?= $reservation['room_name'] ?></td>
                                                            <td><?= $reservation['start_date'] ?></td>
                                                            <td><?= $reservation['end_date'] ?></td>
                                                            <td><?= $reservation['guests'] ?></td>
                                                            <td><?= $reservation['date_reserved'] ?></td>
                                                        </tr>
                                                        <?php $count++ ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
                                    <table id="cancel_table" class="table table-hover table-responsive table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Reservation ID</th>
                                                    <th>Guest Name</th>
                                                    <th>Room Number</th>
                                                    <th>Arrival Date</th>
                                                    <th>Departure Date</th>
                                                    <th>Guest Count</th>
                                                    <th>Reserved Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count = 1 ?>
                                                <?php foreach($reservations as $reservation): ?>
                                                    <?php if($reservation['cancelled'] == 1): ?>
                                                        <tr>
                                                            <td><?= $count ?></td>
                                                            <td><?= $reservation['reservation_id'] ?></td>
                                                            <td><?= $reservation['last_name'].", ".$reservation['first_name'] ?></td>
                                                            <td><?= $reservation['room_name'] ?></td>
                                                            <td><?= $reservation['start_date'] ?></td>
                                                            <td><?= $reservation['end_date'] ?></td>
                                                            <td><?= $reservation['guests'] ?></td>
                                                            <td><?= $reservation['date_reserved'] ?></td>
                                                        </tr>
                                                        <?php $count++ ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</div>
<script src="/js/litepicker.js"></script>
<script>
    const today = new Date();
    var monthBefore = new Date();
    monthBefore.setMonth(monthBefore.getMonth() - 1);

    const picker = new Litepicker({
        element: document.getElementById('start_date'),
        elementEnd: document.getElementById('end_date'),
        singleMode: false,
        resetButton: true,
        dropdowns: {
            "minYear":2020,
            "maxYear":null,
            "months":true,
            "years":true,
        },
        firstDay : 0,
        numberOfColumns: 2,
        numberOfMonths: 2,
    });

    picker.setDateRange(monthBefore, today, false);
</script>
<!-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> -->
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script></script>

<script>
    $(document).ready( function () {
        $('#reservation_table').DataTable({
            dom: 'Bfrtlip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
        });
        $('#revenue_table').DataTable({
            dom: 'Bfrtlip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "footerCallback": function(row, data, start, end, display){
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // Total over all pages
                total = api
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Total over this page
                pageTotal = api
                    .column( 6, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api.column( 6 ).footer() ).html(pageTotal +' ( ' + total +' total )');
            }
        });
        $('#noshow_table').DataTable({
            dom: 'Bfrtlip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
        });
        $('#cancel_table').DataTable({
            dom: 'Bfrtlip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
        });
    });
</script>
<?= $this->endSection()?>