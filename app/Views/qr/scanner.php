<?= $this->extend('template/layout');?>

<?= $this->section('content');?>
<?= $this->include('bars/navbar')?>

<?php $session = \Config\Services::session(); ?>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2 class="text-center head">Check Reservation</h2>
                <video id="preview"></video>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-9">
                <?php if ($session->getTempdata('success')): ?>
                    <div class="alert alert-success mb-3" role="alert">
                        <i class="bi bi-check-circle"></i>  <?= $session->getTempdata('success'); ?>
                    </div>
                    <?php elseif ($session->getTempdata('error')): ?>
                    <div class="alert alert-danger mb-3" role="alert">
                    <i class="bi bi-x-circle"></i>  <?= $session->getTempdata('error'); ?>
                    </div>
                <?php endif; ?>
              <table id="check_reservation_table" class="table-hover table">
                <thead class="table-thead">
                    <tr>
                        <th>No.</th>
                        <th>Customer</th>
                        <th>Booking ID</th>
                        <th>Checked-in</th>
                        <th>Checked-out</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1 ?>
                    <?php foreach($check_data as $row):?>
                    <tr>
                        <td><?= $count ?></td>
                        <td><?= $row['first_name'].' '.$row['last_name'] ?></td>
                        <td><?= $row['booking_id'] ?></td>
                        <td><?= $row['date_checked_in'] ?></td>
                        <td><?= $row['date_checked_out'] ?></td>
                    </tr>
                    <?php $count++ ?>
                    <?php endforeach; ?>
                </tbody>
              </table>
            </div>
        </div>

        <div class="margin_in_checkTable"></div>
    </div>

<script>
    $(document).ready( function () {
        $('#check_reservation_table').DataTable({
            "order":[[4, 'desc'], [3, 'desc']],
        });
    } );

    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    Instascan.Camera.getCameras().then(function(cameras) {
        if(cameras.length > 0) {
          scanner.start(cameras[0]);
        }else {
          alert('No cameras found');
        }

    }).catch(function(e){
      console.error(e);
    });

    scanner.addListener('scan', function(c){
        console.log(c);
        var url = "/customercheck/confirm";
        var booking_id = c;
        //not fixed
        $.ajax({
            type: "POST",
            url: url,
            data: {booking_id: booking_id},
            success: function(result) {
                window.location = result;
            },
        });

    });

</script>
<?= $this->endSection();?>