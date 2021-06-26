<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<?= $this->include('bars/sidebar.php')?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Add Room
                        <a href="<?= base_url().'/room'?>" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?= form_open_multipart('','id="room_form"'); ?>
                        <form>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="name" id="name" placeholder="101" class="form-control">
                                        <label for="name">Name</label>
                                        <small></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="floor" id="floor" placeholder="floor" class="form-control">
                                        <label for="floor">Floor Number</label>
                                        <small></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="photo" class="mb-1">Photo</label>  
                                        <input type="file" name="photo" id="photo" placeholder="photo" class="form-control form-control-sm">
                                        <small></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mt-1 mb-3">
                                        <select name="room_type_id" id="type" class="form-select">
                                            <option value="">Select room type</option>
                                            <?php foreach($room_types as $type): ?>
                                            <option value="<?= $type['room_type_id']?>"> <?= $type['name']?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="type">Room Type</label>
                                        <small></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <input type="submit" value="Save" class="btn btn-primary px-4 float-end">
                                </div>
                            </div>
                        </form>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#room_form").validate({
        rules:{
            name: "required",
            floor: {
                required: true, 
                digits: true
            },
            photo: "required",
            room_type_id: "required",
        },
        errorElement: "small",
	    errorClass: "text-danger",
    });
    
</script>
<?= $this->endSection(); ?>