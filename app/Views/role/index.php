<?= $this->extend('template/layout');?>

<?= $this->section('content'); ?>

<?php $session = \Config\Services::session(); ?>
<?= $this->include('bars/navbar')?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Roles
                            <a href="<?= base_url().'/role/add'?>" class="btn btn-primary float-end">Add</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="container mb-2">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12">
                                        <?php if ($session->getTempdata('success_role')): ?>
                                            <div class="alert alert-success" role="alert">
                                                <i class="bi bi-check-circle"></i>  <?= $session->getTempdata('success_role'); ?>
                                            </div>
                                            <?php elseif ($session->getTempdata('error_role')): ?>
                                            <div class="alert alert-danger" role="alert">
                                            <i class="bi bi-x-circle"></i>  <?= $session->getTempdata('error_role'); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                        <?php if(count($roles)>0): ?>
                            <table id="role_table"class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($roles as $role): ?>
                                    <tr>
                                        <td><?= $role['name']?></td>
                                        <td><?= $role['description']?></td>
                                        <td>
                                            <a href="<?= base_url().'/role/permission/'.$role['role_id']?>" class="btn btn-primary me-2">Permissions</a>
                                            <a href="<?= base_url().'/role/edit/'.$role['role_id'] ?>" class="btn btn-warning me-2">Update</a>
                                            <button type="button" value="<?= $role['role_id']?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?= $role['name']?>">Delete</button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="card-title">No Roles here</h4>
                                    <p class="card-text">Looks like you need to add</p>
                                    <a href="<?= base_url().'/role/add'?>" class="btn btn-primary">Go Add Roles</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->include('delete'); ?>

<script>
    $(document).ready( function () {
        $('#role_table').DataTable({
        });
    } );

    //Modal
    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var roleName = button.getAttribute('data-bs-whatever')
    var id = button.getAttribute('value')
    // Update the modal's content.
    //var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBody = exampleModal.querySelector('.modal-body p')
    //var modalBody2 = exampleModal.querySelector('.modal-body2 p')

    modalBody.textContent = 'You are about to delete the record of Role: ' + roleName + '. This procedure is irreversible.'

    $('.confirm_del').click(function (e) {
    e.preventDefault();

    console.log(id);
    var url = "/role/delete/" + id
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
<?= $this->endSection()?>