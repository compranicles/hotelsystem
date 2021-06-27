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
                        Edit Personal Information
                    </h4>
                </div>
                <div class="card-body">
                    <?php if ($session->getTempdata('success_edit')): ?>
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle"></i>  <?= $session->getTempdata('success_edit'); ?>
                        </div>
                    <?php elseif ($session->getTempdata('error_edit')): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle"></i>  <?= $session->getTempdata('error_edit'); ?>
                        </div>
                    <?php endif; ?>
                    <?= form_open('', 'id="user_form"')?>
                        <form id="user_form">
                            <?= $this->include('user/form')?>
                            <div class="row">
                                <div class="col-md-12">
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
<script>
    $("#user_form").validate({
	rules:{
		first_name:{
			required: true,
			minlength: 2,
		}, 
		last_name:{
			required: true,
			minlength: 2,
		}, 
		date_of_birth:{
			required: true,
			dateISO: true,
		},
		gender:{
			required: true,
		},
		phone_number:{
			required: true,
			digits: true,
		},
	},  
	messages:{
		first_name:{
			required: "First name is required",
			min: "First name must have atleast 2 characters"
		},
		last_name:{
			required: "First name is required",
			min: "First name must have atleast 2 characters"
		},
		date_of_birth:{
			required: "Your date of birth is required",
		},
		gender:{
			required: "Your gender is required",
		},
		phone_number:{
			required: "Phone number is required",
		},	
	},
	errorElement: "small",
	errorClass: "text-danger",
});
</script>
<script>
    document.getElementById('first_name').value = "<?= $user['first_name']?>";
    document.getElementById('last_name').value = "<?= $user['last_name']?>";
    document.getElementById('date_of_birth').value = "<?= $user['date_of_birth']?>";
    document.getElementById('gender').value = "<?= $user['gender']?>";
    document.getElementById('email').value = "<?= $user['email_address']?>";
    document.getElementById('phone_number').value = "<?= $user['mobile_number']?>";

    var passw = document.getElementById('password');
    var pass2 = document.getElementById('cpassword');
    $("#email").prop("disabled", true);
    $("#password").prop("disabled", true);
    $("#cpassword").prop("disabled", true);
    $(document).ready(function(){
        $("#passwords_row").remove();
});
</script>
<?= $this->endSection();?>