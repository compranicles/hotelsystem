<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
			<img class="logo-forpay mx-auto" src="/cavella_logo.png" alt="">
			<h3 class="text-center">Reservation Details</h3><br>
			<div class="row">
			<?php foreach ($forPayment as $row): 
				$arrival = new DateTime($row['arrival_date']);
				$departure = new DateTime($row['departure_date']);

				$nights = $departure->diff($arrival)->format("%a");
				
				$total = $row['price'] * $nights;
			?>
			
			<h5 class="name_payment mb-3"><?= $row['first_name']." ".$row['last_name']; ?></h5>
			<div class="col-md-12">
				<p class="mb-1">Reservation Date: &emsp;&emsp;&emsp;<?= $row['date_created']; ?></p>
				<p class="mb-1">Arrival Date: &emsp;&emsp;&emsp;&nbsp;&emsp;&emsp;<?= $row['arrival_date']; ?></p>
				<p class="mb-3">Departure Date: &emsp;&ensp;&emsp;&emsp;<?= $row['departure_date']; ?></p>
			</div>

			<table class="table">
				<thead>
					<tr>
					<th scope="col">#</th>
					<th scope="col">Amount</th>
					<th scope="col">Reservation</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<th scope="row">1</th>
					<td>&#8369; <?= number_format($row['price'], 2); ?><br>
						<?php if ($nights >= 2): ?>
							x (<?= $nights; ?>) nights
						<?php endif; ?>
					</td>
					<td>
						<table>
							<tr>
								<td>Room <?= $row['room_name']; ?></td>
							</tr>
							<tr>
								<td>Floor #<?= $row['floor']; ?></td>
							</tr>
							<tr>
								<td><?= $row['room_type_name']; ?></td>
							</tr>
						</table>
					</td>
					</tr>
				</tbody>
			</table>
			</div>
			<p class="amount"><strong>Total Amount: </strong> &#8369; <?= number_format($total, 2); ?></p>
			<?php endforeach; ?>
			
			<div class="form_select_paymentType">
				<p><strong>Payment Type:</strong>
				<select class="form-select rounded-0 mt-1" name="payment_type" id="select_payment">
				<?php foreach ($forPaymentType as $type): ?>
					<option selected disabled>--Select--</option>
					<option value="<?= $type['payment_type_id']; ?>"><?= $type['name']; ?></option>
					<?php endforeach; ?>
				</select>
				</p>
			</div>
			
			<button id="checkoutpay" class="btn btn-warning btn-lg rounded-0" data-bs-dismiss="modal-dialog">Checkout</button>
		</div>
    </div>
</div>