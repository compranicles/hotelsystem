<?= $this->extend('template/layout')?>

<?= $this->section('content');?>
<?= $this->include('bars/navbar')?>
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Reservation Successful</h4>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <h6 class="card-title">Here is the QR code: </h6>
                                <div class="text-center mx-5 my-5">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?= $bookingcode ?>&amp;size=300x300&format=png" alt="" title="" class="img-thumbnail mb-3"/>
                                    <br>
                                    <a href="https://api.qrserver.com/v1/create-qr-code/?data=<?= $bookingcode ?>&amp;size=300x300&format=png" target="_blank" rel="noopener noreferrer" id="download" class="btn btn-success" download>Save Code</a>
                                </div>
                                <div class="alert alert-warning" role="alert">
                                    <strong>Note:</strong> To claim your reservation, save this QR code, and present it to the Hotel's Receptionist on your arrival.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <a href="<?= base_url().'/reservation'?>" class="btn btn-warning float-end">Finish</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>
<?= $this->endSection()?>