<?= $this->extend("template/layout") ?>

<?= $this->section("content") ?>

<?php $session = \Config\Services::session(); ?>
<?= $this->include('bars/navbar')?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Room Types
                        <div class="btn-group float-end" role="group">
                            <a href="<?= base_url().'/room/type/add'?>" class="btn btn-sm btn-primary">Add</a>
                            <a href="<?= base_url().'/room'?>" class="btn btn-sm btn-danger">Back</a>
                        </div>
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
                    <?php if(count($room_types)>0): ?>
                        <table id="room_type_table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Max No. of Guests</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($room_types as $type): ?>
                                <tr>
                                    <td><?= $type['name'] ?></td>
                                    <td><?= $type['description'] ?></td>
                                    <td><?= $type['price'] ?></td>
                                    <td><?= $type['max_guests'] ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?= base_url().'/room/type/'.$type['room_type_id'].'/edit' ?>" class="btn btn-sm btn-warning">Update</a>
                                            <button type="button" value="<?= $type['room_type_id']?>" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?= $type['name']?>">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4 class="card-title">No Room Types</h4>
                                <p class="card-text">Looks like you need to add</p>
                                <a href="<?= base_url().'/room/type/add'?>" class="btn btn-primary">Go Add Room Types</a>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('delete'); ?>

<script>
    $(document).ready( function () {
        $('#room_type_table').DataTable({
            "order": [[2, 'asc']],
        });
    } );

    //Modal
    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var typeName = button.getAttribute('data-bs-whatever')
    var id = button.getAttribute('value')
    // Update the modal's content.
    //var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBody = exampleModal.querySelector('.modal-body p')
    //var modalBody2 = exampleModal.querySelector('.modal-body2 p')

    modalBody.textContent = 'You are about to delete the record of Room Type: ' + typeName + '. This procedure is irreversible.'

    $('.confirm_del').click(function (e) {
    e.preventDefault();

    console.log(id);
    var url = "/room/type/" + id + '/delete'
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
<?= $this->endSection() ?>
