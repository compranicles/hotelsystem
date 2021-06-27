<?= $this->extend('template/layout');?>

<?= $this->section('content');?>

<?php $session = \Config\Services::session(); ?>
<?= $this->include('bars/navbar')?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Add User
                        <a href="<?= base_url().'/user'?>" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="container mb-2">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <?php if ($session->getTempdata('success_user')): ?>
                                    <div class="alert alert-success" role="alert">
                                        <i class="bi bi-check-circle"></i>  <?= $session->getTempdata('success_user'); ?>
                                    </div>
                                    <?php elseif ($session->getTempdata('error_user')): ?>
                                    <div class="alert alert-danger" role="alert">
                                    <i class="bi bi-x-circle"></i>  <?= $session->getTempdata('error_user'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?= form_open('','id="user_form"')?>
                        <form id="user_form">
                            <?= $this->include('user/form')?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="role" id="role" class="form-select pb-1">
                                            <option value="">Select Role...</option>
                                            <?php foreach($roles as $role): ?>
                                            <option value="<?= $role['role_id']?>"><?= $role['name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="role">Role</label>
                                        <small></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <hr>
                                    <input type="submit" id="submit" value="Save" class="btn btn-primary px-4 float-end">
                                </div>
                            </div>
                        </form>
                    <?= form_close()?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/validator.js"></script>
<?= $this->endSection()?>