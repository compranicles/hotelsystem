<?= $this->extend('template/layout')?>
<?= $this->section('content')?>
<?php $session = \Config\Services::session(); ?>
<?= $this->include('bars/navbar')?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Reservations
                    </h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs text-center" id="reserveTab" role="tablist"> 
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                Incoming Reservations
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cancel-tab" data-bs-toggle="tab" data-bs-target="#cancel" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                Cancelled Reservations
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="claim-tab" data-bs-toggle="tab" data-bs-target="#claim" type="button" role="tab" aria-controls="claim" aria-selected="false">
                                Claimed Reservations
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="noclaim-tab" data-bs-toggle="tab" data-bs-target="#noclaim" type="button" role="tab" aria-controls="noclaim" aria-selected="false">
                                No-Show
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="reserveTab">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <?php if ($session->getTempdata('success')): ?>
                                <div class="alert alert-success mx-2" role="alert">
                                    <i class="bi bi-check-circle"></i>  <?= $session->getTempdata('success'); ?>
                                </div>
                            <?php elseif ($session->getTempdata('error')): ?>
                                <div class="alert alert-danger mx-2" role="alert">
                                    <i class="bi bi-x-circle"></i>  <?= $session->getTempdata('error'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if(count($booked)>0):?>
                                <div class="container mt-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="normal_table" class="table table-striped table-hover table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Reservation ID</th>
                                                        <th>Name of Guest</th>
                                                        <th>Room Reserved</th>
                                                        <th>Date of Arrival</th>
                                                        <th>Date of Departure</th>
                                                        <th>Number of Guests</th>
                                                        <th>Date Reserved</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($booked as $row) :?>
                                                        <?php
                                                            $currentdate = new DateTime();
                                                            $startdate = new DateTime($row['start_date']);
                                                            $enddate = new DateTime($row['end_date']);
                                                            $d1 = $currentdate->format('Y-m-d');
                                                            $d2 = $startdate->format('Y-m-d');
                                                            $d3 = $enddate->format('Y-m-d');
                                                        ?>
                                                        <?php if($row['cancelled'] == 0 && $row['showed'] == 0 && $d1 < $d3):?>
                                                            <tr>
                                                                <td><?= $row['reservation_id']?></td>
                                                                <td><?= $row['first_name']." ".$row['last_name']?></td>
                                                                <td><?= $row['room_name']?></td>
                                                                <td><?= $row['start_date']?></td>
                                                                <td><?= $row['end_date']?></td>
                                                                <td><?= $row['guests']?></td>
                                                                <td><?= $row['date_reserved']?></td>
                                                                <td>
                                                                    <?php if($d1 <= $d3 && $d1 >= $d2) :?>
                                                                        <i>Arriving...</i>
                                                                    <?php else: ?>
                                                                        <button type="button" value="<?= $row['reservation_id']?>" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
                                                                    <?php endif;?>
                                                                </td>
                                                            </tr>
                                                        <?php endif?>
                                                    <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
                        <?php if(count($cancelled)>0):?>
                                <div class="container mt-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="cancel_table" class="table table-striped table-hover table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Cancellation ID</th>
                                                        <th>Reservation ID</th>
                                                        <th>Date Cancelled</th>
                                                        <th>Cancelled By</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($cancelled as $row) :?>
                                                        <tr>
                                                            <td><?= $row['cancel_id']?></td>
                                                            <td><?= $row['reservation_id']?></td>
                                                            <td><?= $row['cancel_date']?></td>
                                                            <td><?= $row['first_cancel']." ".$row['last_cancel']?></td>
                                                            <td>
                                                                <button type="button" value="<?= $row['reservation_id']?>" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#infobox">View</button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane fade" id="claim" role="tabpanel" aria-labelledby="claim-tab">
                        
                        </div>
                        <div class="tab-pane fade" id="noclaim" role="tabpanel" aria-labelledby="noclaim-tab">
                        <?php if(count($booked)>0):?>
                                <div class="container mt-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="noshow_table" class="table table-striped table-hover table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Reservation ID</th>
                                                        <th>Name of Guest</th>
                                                        <th>Room Reserved</th>
                                                        <th>Date of Arrival</th>
                                                        <th>Date of Departure</th>
                                                        <th>Number of Guests</th>
                                                        <th>Date Reserved</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($booked as $row) :?>
                                                        <?php
                                                            $currentdate = new DateTime();
                                                            $startdate = new DateTime($row['start_date']);
                                                            $enddate = new DateTime($row['end_date']);
                                                            $d1 = $currentdate->format('Y-m-d');
                                                            $d2 = $startdate->format('Y-m-d');
                                                            $d3 = $enddate->format('Y-m-d');
                                                        ?>
                                                        <?php if($row['cancelled'] == 0 && $row['showed'] == 0 && $d1 >= $d3):?>
                                                            <tr>
                                                                <td><?= $row['reservation_id']?></td>
                                                                <td><?= $row['first_name']." ".$row['last_name']?></td>
                                                                <td><?= $row['room_name']?></td>
                                                                <td><?= $row['start_date']?></td>
                                                                <td><?= $row['end_date']?></td>
                                                                <td><?= $row['guests']?></td>
                                                                <td><?= $row['date_reserved']?></td>
                                                            </tr>
                                                        <?php endif?>
                                                    <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="infobox" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="infoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoLabel">Reservation Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless table-responsive">
                    <tbody>
                        <tr>
                            <td class="fw-bold">Reservation ID: </td>
                            <td id="reservation_id"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Name of Guest: </td>
                            <td id="name"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Room Name: </td>
                            <td id="rname"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Arrival Date: </td>
                            <td id="startdate"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Departure Date: </td>
                            <td id="enddate"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Number of Guests: </td>
                            <td id="noguests"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Date Reserved: </td>
                            <td id="resdate"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('#normal_table').DataTable({
            "order":[[3, 'asc']],
        });
        $('#cancel_table').DataTable({
            "order":[[2, 'desc']],
        });
        $('#noshow_table').DataTable({
            "order":[[3, 'desc']],
        });
    });

</script>
<script>
    var infoModal = document.getElementById('infobox');
    infoModal.addEventListener('show.bs.modal', function(e) {
        var button = e.relatedTarget;
        var reservationId = button.getAttribute('value');
        var url = "/reservation/getInfo/"+reservationId;
        $.ajax({
            url: url,
            dataType: 'json',
            success: function (data){
                document.getElementById('reservation_id').innerHTML = data.resId;
                document.getElementById('name').innerHTML = data.fname + " " + data.lname;
                document.getElementById('rname').innerHTML = data.room_name;
                document.getElementById('startdate').innerHTML = data.start_date;
                document.getElementById('enddate').innerHTML = data.end_date;
                document.getElementById('noguests').innerHTML = data.guests;
                document.getElementById('resdate').innerHTML = data.date_reserved;
            }
        });
        
    });
</script>
<?= $this->endSection()?>