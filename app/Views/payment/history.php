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
                        Payments History
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

<script>
    $(document).ready(function(){
        $('#payment_table').DataTable({

        });
    });
</script>

<?= $this->endSection()?>