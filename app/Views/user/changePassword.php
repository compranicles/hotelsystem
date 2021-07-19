<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<?= $this->include('bars/navbar')?>
<?php $session = \Config\Services::session(); ?>



<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-body">

                <div class="container mb-2">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <?php if ($session->getTempdata('success_chpw')): ?>
                                <div class="alert alert-success" role="alert">
                                    <i class="bi bi-check-circle"></i>  <?= $session->getTempdata('success_chpw'); ?>
                                </div>
                                <?php elseif ($session->getTempdata('error_chpw')): ?>
                                <div class="alert alert-danger" role="alert">
                                <i class="bi bi-x-circle"></i>  <?= $session->getTempdata('error_chpw'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                  <h2 class="mb-4 text-center">Change Password</h2>
                  <?php if(isset($validation)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors(); ?>
                        </div>
                    <?php } ?>
                    <?= form_open(base_url()."/user/changePassword"); ?>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-floating mb-3">
                            <input type="password" name="current_pw" id="current_pw" placeholder="Current Password" class="form-control" autocomplete="current_pw"/>
                            <label for="current_pw">Current Password</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="password" name="new_pw" id="new_pw" placeholder="New Password" class="form-control" autocomplete="new_pw"/>
                            <label for="new_pw">New Password</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="password" name="confirm_new_pw" id="confirm_new_pw" placeholder="New Password" class="form-control" autocomplete="confirm_new_pw"/>
                            <label for="confirm_new_pw">Confirm New Password</label>
                          </div>

                          <input type="submit" id="submit" value="Save Changes" class="btn btn-warning px-3 float-end">
                        </div>
                      </div>
                    <?= form_close(); ?>
                </div>
            </div>
        <div>
    </div>
</div>
<?= $this->endSection(); ?>