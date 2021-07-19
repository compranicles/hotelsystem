<?= $this->extend('template/layout')?>

<?= $this->section('content');?>
<?php $session = \Config\Services::session(); ?>
<?= $this->include('bars/navbar')?>
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Reservations
                        <a href="<?= base_url()?>" class="btn btn-success float-end">Add New Reservation</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php if ($session->getTempdata('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle"></i>  <?= $session->getTempdata('success'); ?>
                        </div>
                    <?php elseif ($session->getTempdata('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle"></i>  <?= $session->getTempdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(count($reservations) > 0): ?>
                        <table id="reservation_table" class="table table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>Reservation ID</th>
                                    <th>Room Number</th>
                                    <th>Arrival Date</th>
                                    <th>Departure Date</th>
                                    <th>Number of Guests</th>
                                    <th>Date Reserved</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($reservations as $row): ?>
                                <tr>
                                    <td><?= $row['reservation_id']?></td>
                                    <td><?= $row['room_name']?></td>
                                    <td><?= $row['start_date']?></td>
                                    <td><?= $row['end_date']?></td>
                                    <td><?= $row['guests']?></td>
                                    <td><?= $row['date_reserved']?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <?php
                                                $currentdate = new DateTime();
                                                $startdate = new DateTime($row['start_date']);
                                                $enddate = new DateTime($row['end_date']);
                                                $d1 = $currentdate->format('Y-m-d');
                                                $d2 = $startdate->format('Y-m-d');
                                                $d3 = $enddate->format('Y-m-d');


                                            ?>
                                            <?php if($row['cancelled'] == 0 && $row['showed'] == 0): ?>
                                                <?php if($d1 < $d2) :?>
                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-qrcode="<?= $row['booking_id']?>" data-bs-toggle="modal" data-bs-target="#qrcode">QR Code</button>
                                                    <button type="button" value="<?= $row['reservation_id']?>" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
                                                <?php elseif($d1 >= $d2 && $d1 < $d3) :?>
                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-qrcode="<?= $row['booking_id']?>" data-bs-toggle="modal" data-bs-target="#qrcode">QR Code</button>
                                                <?php elseif($d1 >= $d3): ?>
                                                    <i>Unclaimed</i>
                                                <?php endif?>
                                            <?php elseif($row['cancelled'] == 0 && $row['showed'] == 1 && $d1 >= $d2 && $d1 < $d3 ): ?>
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-qrcode="<?= $row['booking_id']?>" data-bs-toggle="modal" data-bs-target="#qrcode">QR Code</button>
                                            <?php endif?>
                                        </div>
                                        <?php if($row['cancelled'] == 1 || $row['showed'] == 1): ?>
                                            <i><?= ($row['cancelled'] == 1) ? 'Cancelled' : '' ?></i> 
                                            <?= ($row['showed'] == 1) ? 'Claimed' : '' ?></i>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="card-title">No Reservations </h4>
                                    <p class="card-text">Reserve Now!</p>
                                    <a href="<?= base_url()?>" class="btn btn-primary">Click Here</a>
                                </div>
                            </div>
                    <?php endif?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="qrcode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="qrcodeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrcodeLabel">QR Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mx-5 my-5">
                    <img src="" id="qrimage" alt="" title="" class="img-thumbnail mb-3"/>
                    <br>
                    <a href="" id="qrlink" target="_blank" rel="noopener noreferrer" id="download" class="btn btn-success" download>Save Code</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="cancelModalLabel">Confirm Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="icon text-center">
            <i class="bi bi-exclamation-circle danger"></i>
            </div>
            <p></p>
        <div class="modal-body2">
            <p>This action is irreversible. Do you want to continue?</p>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
            <button type="button" class="confirm_del btn btn-danger" data-bs-dismiss="modal">Yes</button>
        </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('#reservation_table').DataTable({
            "order":[[5, 'desc']],
        });
    });
</script>

<script>
    var qrcodeModal = document.getElementById('qrcode');
    qrcodeModal.addEventListener('show.bs.modal', function(e) {
        var button = e.relatedTarget;
        var bookingId = button.getAttribute('data-bs-qrcode');
        document.getElementById('qrimage').src="https://api.qrserver.com/v1/create-qr-code/?data="+bookingId+"&amp;size=150x150&format=png";
        document.getElementById('qrlink').href="https://api.qrserver.com/v1/create-qr-code/?data="+bookingId+"&amp;size=300x300&format=png";
    });
</script>

<script>
    var exampleModal = document.getElementById('cancelModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var id = button.getAttribute('value')
        $('.confirm_del').click(function (e) {
            e.preventDefault();

            var url = "/reservation/cancel/" + id
            $.ajax({
                url: url,
                success: function () {
                    window.location = '/reservation'
                } 
            })
        })   
    })
</script>
<?= $this->endSection()?>