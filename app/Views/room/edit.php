<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <?= $this->include('room/nav')?>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h4 class="mt-5">Edit Room</h4>
            <?= form_open(); ?>
            <form>
                <div class="form-group mt-2">
                    <label for="room_type" class="mb-1">Room Type</label>
                    <select name="room_type" class="form-select" required>
                        <option value="">Select Room Type</option>
                        <?php foreach($room_types as $type): ?>
                        <option value="<?= $type['id']?>" <?= ($room['room_type'] == $type['id']) ? 'selected' : '' ?>> <?= $type['room_type_name']?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="room_description" class="mb-1">Room Description</label>
                    <textarea name="room_description" class="form-control" required><?= $room['room_description'] ?></textarea>
                </div>
                <div class="form-group mt-2">
                    <label for="room_status">Status</label>
                    <select name="room_status" class=form-select required>
                        <option value="">Select Status</option>
                        <option value="1" <?= ($room['room_status'] == '1') ? 'selected' : '' ?>>Available</option>
                        <option value="2" <?= ($room['room_status'] == '2') ? 'selected' : '' ?>>Not Available</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>