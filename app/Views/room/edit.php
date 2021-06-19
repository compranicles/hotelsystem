<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Edit Room
                        <a href="<?= base_url().'/room' ?>" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?= form_open_multipart(); ?>
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="name" value="<?= $room['name']?>" id="name" placeholder="101" class="form-control">
                                        <label for="name">Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="floor" value="<?= $room['floor']?>" id="floor" placeholder="floor" class="form-control">
                                        <label for="floor">Floor Number</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="photo" class="mb-1">Photo</label>  
                                        <input type="file" name="photo" id="photo" placeholder="photo" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="room_type_id" id="type" class="form-select">
                                            <option>Select the room type</option>
                                            <?php foreach($room_types as $type): ?>
                                            <option value="<?= $type['room_type_id']?>" <?= ($room['room_type_id'] == $type['room_type_id']) ? 'selected' : '' ?>> 
                                                <?= $type['name']?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="type">Room Type</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="room_status_id" id="status" class="form-select">
                                            <option>Select the room's status</option>
                                            <?php foreach($room_status as $status): ?>
                                            <option value="<?= $status['room_status_id']?>" <?= ($room['room_status_id'] == $status['room_status_id']) ? 'selected' : '' ?>>
                                                <?= $status['name']?>
                                            </option>
                                            <?php endforeach ?>
                                        </select>
                                        <label for="stats">Room Status</label>
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
        <div class="col-md-5">
            <img src="<?= base_url().'/uploads/'.$room['photo'] ?>" alt="Room Image" class="w-100">
        </div>
    </div>
</div>
<?= $this->endSection(); ?>