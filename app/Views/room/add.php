<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <?= $this->include('room/nav')?>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="mt-5">Add Room</h2>
            <?= form_open(); ?>
            <form>
                <div class="form-group mt-2">
                    <label for="room_type" class="mb-1">Room Type</label>
                    <select name="room_type" class="form-select" required>
                        <option value="">Select Room Type</option>
                        <option value="1">Single Room</option>
                        <option value="2">Double Room</option>
                        <option value="3">Suite</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="room_description" class="mb-1">Room Description</label>
                    <textarea name="room_description" class="form-control" required></textarea>
                </div>
                <div class="form-group mt-2">
                    <label for="room_rate" class="mb-1">Rate Per Night</label>
                    <input type="number" name="room_rate" step="0.01" min="0" max="99999" class="form-control" placeholder="00000.00" required>
                </div>
                <div class="card-body">
                    <?= form_open_multipart(); ?>
                        <form>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="name" id="name" placeholder="101" class="form-control pb-1">
                                        <label for="name">Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="floor" id="floor" placeholder="floor" class="form-control pb-1">
                                        <label for="floor">Floor Number</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="photo" class="mb-1">Photo</label>  
                                        <input type="file" name="photo" id="photo" placeholder="photo" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mt-1 mb-3">
                                        <select name="room_type_id" id="type" class="form-select pb-1">
                                            <option selected>Select room type</option>
                                            <?php foreach($room_types as $type): ?>
                                            <option value="<?= $type['room_type_id']?>"> <?= $type['name']?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="type">Room Type</label>
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
            </form>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>