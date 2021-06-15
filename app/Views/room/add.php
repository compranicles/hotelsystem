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
                <div class="form-group mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>