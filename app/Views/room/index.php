
<?= $this->extend("template/layout") ?>

<?= $this->section("content") ?>


<div class="container mt-4">
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
                    <?php if(count($rooms)>0): ?>
                        <table id="room_table" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Floor Number</th>
                                    <th>Room Image</th>
                                    <th>Room Type</th>
                                    <th>Room Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($rooms as $room): ?>
                                <tr>
                                    <td><?= $room['name'] ?></td>    
                                    <td><?= $room['floor'] ?></td>   
                                    <td>
                                        <img src="<?= 'uploads/'.$room['photo'] ?>" alt="<?= 'Room '.$room['name'] ?>" height="50px" width="50px">
                                    </td>    
                                    <td><?= $room['room_type'] ?></td>  
                                    <td><?= $room['room_status'] ?></td>
                                    <td>
                                        <a href="<?= base_url().'/room/edit/'.$room['room_id'] ?>" class="btn btn-outline-primary">Update</a>
                                        
                                        <a href="<?= base_url().'/room/delete/'.$room['room_id'] ?>" class="btn btn-danger">Delete</a>
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
<script>
    $(document).ready( function () {
        $('#room_table').DataTable();
    } );
</script>
<?= $this->endSection() ?>
