<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>



<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Add Room Type
                        <a href="<?= base_url().'/room/type'?>" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?= form_open(); ?>
                        <form>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="name" id="name" placeholder="e.g. Single Room, etc." class="form-control">
                                        <label for="name">Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <textarea name="description" class="form-control" placeholder="e.g. Room Size, Features" id="description" style="height: 100px"></textarea>
                                        <label for="description">Description</label>  
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" name="price" id="price" placeholder="(PHP)" step="0.01" min="0" max="99999" class="form-control">
                                        <label for="price">Price (PHP)</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" name="max_guests" id="max_guests" placeholder="Minimum 1" min="1" max="5" class="form-control">
                                        <label for="max_guests">Maximum number of guests</label>
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
<?= $this->endSection(); ?>