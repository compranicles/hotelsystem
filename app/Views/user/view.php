<?= $this->extend('template/layout');?>

<?= $this->section('content');?>
<?= $this->include('bars/sidebar.php')?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4>
                        View User
                        <a href="<?= base_url().'/user'?>" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?= form_open('', 'id="user_form"')?>
                        <form id="user_form">
                            <?= $this->include('user/form')?>
                        </form>
                    <?= form_close()?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('first_name').value = "<?= $user['first_name']?>";
    document.getElementById('last_name').value = "<?= $user['last_name']?>";
    document.getElementById('date_of_birth').value = "<?= $user['date_of_birth']?>";
    document.getElementById('gender').value = "<?= $user['gender']?>";
    document.getElementById('email').value = "<?= $user['email_address']?>";
    document.getElementById('phone_number').value = "<?= $user['mobile_number']?>";

    $("#first_name").prop("disabled", true);
    $("#last_name").prop("disabled", true);
    $("#date_of_birth").prop("disabled", true);
    $("#gender").prop("disabled", true);
    $("#email").prop("disabled", true);
    $("#phone_number").prop("disabled", true);

    $("#passwords_row").remove();
</script>
<?= $this->endSection();?>