<?= $this->extend('template/layout');?>

<?= $this->section('content')?>
<?php $session = \Config\Services::session();?>
<?= $this->include('bars/navbar')?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="mb-5 text-center">Log In</h2>
                        </div>
                    </div>
                    <?php if ($session->getTempdata('login_error')): ?>
                        <div class="alert alert-danger" role="alert">
                        <i class="bi bi-x-circle"></i>  <?= $session->getTempdata('login_error'); ?>
                        </div>
                    <?php endif; ?>
                    <?= form_open('', 'id="login_form"')?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" id="email" placeholder="Email" class="form-control"  autocomplete="email"/>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" id="password" placeholder="password" class="form-control" >
                                    <label for="password">Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-grid gap-2">
                                <input type="submit" id="submit" value="Log In" class="btn btn-primary">
                            </div>
                        </div>
                    <?= form_close()?>
                </div>
            </div>
            <h5 class="text-center">
                <small>
                    Not yet Registered? <a href="<?= base_url().'/register'?>" class="link link-primary">Register here.</a>
                </small>
            </h5>
        </div>
    </div>
</div>
<script>
$("#login_form").validate({
	rules:{
		email:{
			required: true,
			email: true,
		},
		password: {
			required: true,
		},
	},  
	messages:{
		email:{
			required: "Your email is required",
			remote: "This email already exist",
		},
		password:{
			required: "Your password is required",
		},
	},
	errorElement: "small",
	errorClass: "text-danger",
});
</script>
<?= $this->endSection()?>