<?= $this->extend('template/layout');?>

<?= $this->section('content');?>
<?= $this->include('bars/navbar')?>

<?php $session = \Config\Services::session(); ?>


<?php if($session->getFlashdata('arrival')) { 
    echo '<script>alert("Check-in failed: The guests arrival date is on '.$session->getFlashdata('arrival').' ."); </script>';
} ?>
<style>
#preview{
   width: 600px;
   height: 400px;
   margin:0px auto;
}
</style>

    <div class="container-fluid mb-5">

        <div class="row">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="text-center head">Check Reservation</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <video id="preview" autoplay></video>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
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
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="text-center head">Room Monitoring</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach($rooms as $room): ?>
                                <div class="col m-2">
                                    <div class="card 
                                        <?= ($room['room_status_id'] == 2) ? 'bg-danger text-white ' : ''?>
                                        <?= ($room['room_status_id'] == 3) ? 'bg-warning' : ''?>
                                        <?php foreach($occupied as $row) :?>
                                            <?= ($room['room_id'] == $row['room_id'] && $row['showed'] == 1) ? ' bg-success text-white' : ''?>
                                        <?php endforeach?>
                                    " style="width: 6rem; height: 6rem;">
                                        <h6 class="card-title m-1"><?= $room['name']?></h6>
                                        <p class="card-text align-text-center text-center mt-3">
                                            <?php foreach($occupied as $row) :?>
                                                <?php if($room['room_id'] == $row['room_id'] && $row['showed'] == 1) :?>
                                                    <button type="button" value="<?= $row['booking_id']?>" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#infobox">Guest Info</button>
                                                <?php endif?>
                                            <?php endforeach?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="margin_in_checkTable"></div>
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
<?= $this->endSection();?>