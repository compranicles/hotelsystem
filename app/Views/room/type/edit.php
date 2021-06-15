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
                    <label for="room_type_name" class="mb-1">Room Type Name</label>
                    <input type="text" name="room_type_name" value="<?= $room_type['room_type_name']?>" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="room_rate" class="mb-1">Rate Per Night</label>
                    <input type="number" name="room_rate" value="<?= $room_type['room_rate']?>" step="0.01" min="0" max="99999" class="form-control" placeholder="00000.00" required>
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