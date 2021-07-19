<?= $this->extend('template/layout');?>
<?= $this->section('content');?>
<?php $session = \Config\Services::session(); ?>
<?= $this->include('bars/navbar')?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Check-In History
                    </h4>
                </div>
                <div class="card-body">
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="checkin_table" class="table table-responsive table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Booking ID</th>
                                            <th>Date Checked-In</th>
                                            <th>Date Checked-Out</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($checkins as $row): ?>
                                        <tr>
                                            <td><?= $row['show_id']?></td>
                                            <td><?= $row['booking_id']?></td>
                                            <td><?= $row['date_checked_in']?></td>
                                            <td><?= $row['date_checked_out']?></td>
                                        </tr>
                                        <?php endforeach?>
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
<script>
    $(document).ready( function () {
        $('#checkin_table').DataTable({
            "order":[[2, 'desc'], [3, 'desc']],
        });
    } );
</script>
<?= $this->endSection()?>