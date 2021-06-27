<?= $this->extend('template/layout');?>

<?= $this->section('content');?>
<?= $this->include('bars/navbar')?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Edit User
                        <a href="<?= base_url().'/user'?>" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
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
<script src="/js/validator.js"></script>
<script>
    var fname = document.getElementById('first_name');
    var lname = document.getElementById('last_name');
    var birth = document.getElementById('date_of_birth');
    var gender = document.getElementById('gender');
    var email = document.getElementById('email');
    var phone = document.getElementById('phone_number');
    var passw = document.getElementById('password');
    var pass2 = document.getElementById('cpassword');
    $("#email").prop("disabled", true);
    $("#password").prop("disabled", true);
    $("#cpassword").prop("disabled", true);
</script>
<?= $this->endSection();?>