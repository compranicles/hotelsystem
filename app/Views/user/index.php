<?= $this->extend('template/layout');?>

<?= $this->section('content'); ?>

<?php $session = \Config\Services::session(); ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Users
                        <a href="<?= base_url().'/user/add'?>" class="btn btn-primary float-end">Add</a>
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
                    <?php if(count($users) > 0): ?>
                        <table id="users_table" class="table">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>User Data</th>
                                    <th>User Roles</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?= $user['user_id'] ?></td>
                                    <td><?= $user['first_name']." ".$user['last_name']?></td>
                                    <td>
                                        <a href="<?= base_url().'/user/view/'.$user['user_id'] ?>" class="btn btn-primary">View Data</a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url().'/user/role/'.$user['user_id'] ?>" class="btn btn-secondary">Manage Roles</a>
                                    </td>
                                    <td>    
                                        <button type="button" value="<?= $user['user_id']?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?= $user['first_name']." ".$user['last_name']?>">Delete</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('delete'); ?>

<script>
    $(document).ready( function () {
        $('#users_table').DataTable({
        });
    } );

    //Modal
    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var userName = button.getAttribute('data-bs-whatever')
    var id = button.getAttribute('value')
    // Update the modal's content.
    //var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBody = exampleModal.querySelector('.modal-body p')
    //var modalBody2 = exampleModal.querySelector('.modal-body2 p')

    modalBody.textContent = 'You are about to delete the record of User: ' + userName + '. This procedure is irreversible.'

    $('.confirm_del').click(function (e) {
    e.preventDefault();

    console.log(id);
    var url = "/user/delete/" + id
    $.ajax({
        url: url,
        success: function () {
            window.location = url
            //$('#room_table').DataTable();
        } 
    })
    })   

})
</script>
<?= $this->endSection();?>