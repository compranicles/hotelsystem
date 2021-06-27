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