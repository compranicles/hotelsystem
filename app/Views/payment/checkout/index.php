<?= $this->extend('template/layout'); ?>

<?= $this->section('content');?>
<?= $this->include('bars/navbar')?>

<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mb-4 rounded-0">
                <div class="reserve_card card-body col-md-11">
                    <img class="logo-forpay mx-auto" src="/cavella_logo.png" alt="">
                    <h3 class="text-center">Reservation Details</h3><br>
                  <div class="row">
                  <?php  
                        $arrival = new DateTime($forPayment[0]['arrival_date']);
                        $departure = new DateTime($forPayment[0]['departure_date']);
                        $other_charges = 0.00;

                        $nights = $departure->diff($arrival)->format("%a");
                        
                        $total = $forPayment[0]['price'] * $nights;


                    ?>
                    
                    <h5 class="name_payment mb-3"><?= $forPayment[0]['first_name']." ".$forPayment[0]['last_name']; ?></h5>
                    <div class="col-md-12">
                        <p class="mb-1">Reservation Date: &emsp;&emsp;&emsp;<?= $forPayment[0]['date_created']; ?></p>
                        <p class="mb-1">Arrival Date: &emsp;&emsp;&emsp;&nbsp;&emsp;&emsp;<?= $forPayment[0]['arrival_date']; ?></p>
                        <p class="mb-3">Departure Date: &emsp;&ensp;&emsp;&emsp;<?= $forPayment[0]['departure_date']; ?></p>
                    </div>
                  <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Other Charges (If any)</th>
                        <th scope="col">Reservation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>&#8369; <?= number_format($forPayment[0]['price'], 2); ?><br>
                        <?php if ($nights >= 2): ?>
                            x (<?= $nights; ?>) nights
                        <?php endif; ?>
                        </td>
                        <td>
                            <?php
                            if($departure->diff($checkForLateCheckout[0]['date_checked_in'])->format("%h") <= 2){
                                echo "&#8369; 0.00";
                            }
                            elseif($departure->diff($checkForLateCheckout[0]['date_checked_in'])->format("%h") <= 4) {
                                $other_charges += ($total *  0.25);
                                echo "Late Check-out Charge (4 hours max.): &#8369; ".$other_charges;
                            }
                            elseif($departure->diff($checkForLateCheckout[0]['date_checked_in'])->format("%h") <= 6) {
                                $other_charges += ($total *  0.50);
                                echo "Late Check-out Charge (6 hours max.): &#8369; ".$other_charges;
                            }
                            else{
                                $other_charges += ($total);
                                echo "Overstayed (more than 6 hours): &#8369; ".$other_charges;
                            }
                            ?>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td>Room <?= $forPayment[0]['room_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Floor #<?= $forPayment[0]['floor']; ?></td>
                                </tr>
                                <tr>
                                    <td><?= $forPayment[0]['room_type_name']; ?></td>
                                </tr>
                            </table>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                    </div>
                </div>
                <p class="amount"><strong>Total Amount: </strong> &#8369; <?= number_format($total + $other_charges, 2); ?></p>

                
                <div class="form_select_paymentType">
                    <p><strong>Payment Type:</strong>
                        <select class="validate[required] form-select rounded-0 mt-1" name="payment_type" id="select_payment">
                            <option value="" selected disabled>---Select---</option>
                            <?php foreach ($forPaymentType as $type): ?>
                            <option value="<?= $type['payment_type_id']; ?>"><?= $type['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                </div>
                
                <button id="checkoutpay" class="btn btn-warning btn-lg rounded-0">Checkout</button>
            </div>
        </div>
    </div>
</div>

<script>

  $(document).on('click', '#checkoutpay', function() {

        if(!$('#select_payment').val()){
            alert('Please select a payment type.');
        }

        else{
            var url = "/payment/checkoutpayment";
            $.ajax({
                type: "POST",
                url: url,
                data: {booking_id: <?= $bookingPass; ?> , payment_type: $('#select_payment').val(), amount: <?= $total; ?>},
                success: function(result) {
                    window.location = result;
                }
            });
        }
  });

</script>

<?= $this->endSection();?>