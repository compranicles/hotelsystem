<?= $this->extend('template/layout');?>

<?= $this->section('content');?>

<?php $session = \Config\Services::session(); ?>
<?= $this->include('bars/navbar')?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Add Role
                        <a href="<?= base_url().'/role'?>" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="container mb-2">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <?php if ($session->getTempdata('success_role')): ?>
                                    <div class="alert alert-success" role="alert">
                                        <i class="bi bi-check-circle"></i>  <?= $session->getTempdata('success_user'); ?>
                                    </div>
                                    <?php elseif ($session->getTempdata('error_role')): ?>
                                    <div class="alert alert-danger" role="alert">
                                    <i class="bi bi-x-circle"></i>  <?= $session->getTempdata('error_user'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?= form_open()?>
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" name="name" id="name" placeholder="101" class="form-control">
                                        <label for="name">Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <textarea name="description" class="form-control" placeholder="e.g. Room Size, Features" id="description" style="height: 100px"></textarea>
                                        <label for="description">Description</label>  
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
                    <?= form_close()?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>