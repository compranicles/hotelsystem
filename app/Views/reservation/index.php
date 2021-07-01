<?= $this->extend('template/layout')?>

<?= $this->section('content');?>
<?= $this->include('bars/navbar')?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Reservations
                        <a href="" class="btn btn-success float-end">Add New Reservation</a>
                    </h4>
                </div>
                <div class="card-body">
<<<<<<< HEAD

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
                        <table id="reservation_table" class="table table-striped table-hover">
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
                    <?php endif?>

=======
>>>>>>> parent of ce5c035 (reservation view for admin/staff)
                    <table id="reservation_table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Room Number</th>
                                <th>Arrival Date</th>
                                <th>Departure Date</th>
                                <th>Number of Guests</th>
                                <th>Date Reserved</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="" class="btn btn-sm btn-primary">QR Code</a>
                                        <a href="" class="btn btn-sm btn-danger">Cancel</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection()?>