<?= $this->extend("template/layout") ?>

<?= $this->section("content") ?>
<?= $this->include('bars/navbar')?>
<?php $session = \Config\Services::session(); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Rooms
                        <a href="<?= base_url().'/room/type'?>" class="btn btn-outline-secondary float-end ms-2">Room Types</a>
                        <a href="<?= base_url().'/room/add'?>" class="btn btn-primary float-end">Add</a>
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
                    <?php if(count($rooms)>0): ?>
                        <table id="room_table" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Floor Number</th>
                                    <th>Room Type</th>
                                    <th>Room Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($rooms as $room): ?>
                                <tr class="<?php 
                                            if($room['room_status'] == 'Not Available')
                                                echo "table-danger";
                                            elseif($room['room_status'] == 'On Renovation')
                                                echo "table-warning";
                                            ?>">
                                    <td><?= $room['name'] ?></td>    
                                    <td><?= $room['floor'] ?></td>       
                                    <td><?= $room['room_type'] ?></td>  
                                    <td><?= $room['room_status'] ?></td>
                                    <td>
                                        <a href="<?= base_url().'/room/edit/'.$room['room_id'] ?>" class="btn btn-outline-primary">Update</a>
                                        
                                        <button type="button" value="<?= $room['room_id']?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?= $room['name']?>">Delete</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4 class="card-title text-center">No Rooms</h4>
                                <p class="card-text text-center">Looks like you need to add rooms</p>
                                <a href="<?= base_url().'/room/add'?>" class="btn btn-primary">Add Now</a>
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
        $('#room_table').DataTable({
            "order":[[0, 'desc']],
        });
    });

    //Modal
    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var roomName = button.getAttribute('data-bs-whatever')
    var id = button.getAttribute('value')
    // Update the modal's content.
    //var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBody = exampleModal.querySelector('.modal-body p')
    //var modalBody2 = exampleModal.querySelector('.modal-body2 p')

    modalBody.textContent = 'You are about to delete the record of Room ' + roomName + '. This procedure is irreversible.'

    $('.confirm_del').click(function (e) {
    e.preventDefault();

    var url = "/room/delete/" + id
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
