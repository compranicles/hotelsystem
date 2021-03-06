<?= $this->extend('template/layout');?>

<?= $this->section('content'); ?>

<?php $session = \Config\Services::session(); ?>
<?= $this->include('bars/navbar')?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Permissions
                            <a href="<?= base_url().'/permission/add'?>" class="btn btn-sm btn-primary float-end">Add</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="container mb-2">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                    <?php if ($session->getTempdata('success')): ?>
                                        <div class="alert alert-success" role="alert">
                                            <i class="bi bi-check-circle"></i>  <?= $session->getTempdata('success'); ?>
                                        </div>
                                        <?php elseif ($session->getTempdata('error')): ?>
                                        <div class="alert alert-danger" role="alert">
                                        <i class="bi bi-x-circle"></i>  <?= $session->getTempdata('error'); ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php if(count($permissions)>0): ?>
                            <table id="permission_table" class="table table-striped table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($permissions as $permission): ?>
                                    <tr>
                                        <td><?= $permission['name']?></td>
                                        <td><?= $permission['description']?></td>
                                        <td>
                                            <div class="btn-group" role="alert">
                                                <a href="<?= base_url().'/permission/edit/'.$permission['permission_id'] ?>" class="btn btn-sm btn-warning">Update</a>
                                                <button type="button" value="<?= $permission['permission_id']?>" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?= $permission['name']?>">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="card-title">No permissions here</h4>
                                    <p class="card-text">Looks like you need to add</p>
                                    <a href="<?= base_url().'/permission/add'?>" class="btn btn-primary">Go Add permissions</a>
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
        $('#permission_table').DataTable({
        });
    } );

    //Modal
    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var permissionName = button.getAttribute('data-bs-whatever')
    var id = button.getAttribute('value')
    // Update the modal's content.
    //var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBody = exampleModal.querySelector('.modal-body p')
    //var modalBody2 = exampleModal.querySelector('.modal-body2 p')

    modalBody.textContent = 'You are about to delete the record of Permission: ' + permissionName + '. This procedure is irreversible.'

    $('.confirm_del').click(function (e) {
    e.preventDefault();

    console.log(id);
    var url = "/permission/delete/" + id
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