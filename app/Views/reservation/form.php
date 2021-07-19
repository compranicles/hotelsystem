<?= $this->extend('template/layout'); ?>

<?= $this->section('content');?>
<?= $this->include('bars/navbar')?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Reservation Form
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <img src="<?= '/uploads/'.$room[0]['photo']?>" alt=""  class="img-thumbnail mb-3">
                                    </tr>
                                    <tr>
                                        <td><strong>Room Name: </strong></td>
                                        <td><?= $room[0]['name']?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Floor Number: </strong></td>
                                        <td><?= $room[0]['floor']?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Room Type: </strong></td>
                                        <td><?= $room[0]['room_type']?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Arrival Date: </strong></td>
                                        <td id="startdate"><?= date('F j, Y', strtotime($startdate))?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Departure Date: </strong></td>
                                        <td id="enddate"><?= date('F j, Y', strtotime($enddate))?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Number of Guests: </strong></td>
                                        <td id="guests"><?= $guests?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <a href="<?= base_url().'/reservation/showroom'?>" class="btn btn-danger float-end">Cancel</a>
                            <button id="continue" class="btn btn-warning float-end me-2">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#continue', function() {
            var roomid = <?= $room[0]['room_id']?>;
            var date_start = '<?= $startdate?>';
            var date_end = '<?= $enddate?>';
            var guests = '<?= $guests?>';
            
            var url = "/reservation/save/" + roomid + "/" + date_start + "/" + date_end + "/" + guests; 

            $.ajax({
                url: url,
                success: function (result) {
                    window.location = result;
                } 
            });
        });
</script>
<?= $this->endSection();?>