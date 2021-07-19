<?= $this->extend('template/layout')?>
<?= $this->section('content')?>

<?php $session = \Config\Services::session(); ?>
<?= $this->include('bars/navbar')?>
<div class="container my-5">
    <div class="row">   
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Payments
                        <a href="<?= base_url().'/payment/type'?>" class="btn btn-sm btn-secondary float-end">Payment Types</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="payment_table" class="table table-striped table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Booking ID</th>
                                            <th>Date Paid</th>
                                            <th>Payment Type</th>
                                            <th>Amount Paid</th>
                                            <th>View Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($payments as $payment): ?>
                                        <tr>
                                            <td><?= $payment['payment_id']?></td>
                                            <td><?= $payment['booking_id']?></td>
                                            <td><?= $payment['payment_date']?></td>
                                            <td>
                                                <?php foreach($paymentTypes as $paymentType):?>
                                                    <?= ($paymentType['payment_type_id'] == $payment['payment_type_id']) ? $paymentType['name']: '' ?>
                                                <?php endforeach?>
                                            </td>
                                            <td><?= $payment['amount']?></td>
                                            <td>
                                            <button type="button" value="<?= $payment['booking_id']?>" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#infobox">View</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
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
<div class="modal fade" id="infobox" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="infoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoLabel">Booking/Reservation Information</h5>
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
                            <td class="fw-bold">Date Checked-In: </td>
                            <td id="startdate"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Date Checked-Out: </td>
                            <td id="enddate"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Number of Guests: </td>
                            <td id="noguests"></td>
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
    $(document).ready(function(){
        $('#payment_table').DataTable({

        });
    });
</script>
<script>
    var infoModal = document.getElementById('infobox');
    infoModal.addEventListener('show.bs.modal', function(e) {
        var button = e.relatedTarget;
        var reservationId = button.getAttribute('value');
        var url = "/payment/getPaymentInfo/"+reservationId;
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