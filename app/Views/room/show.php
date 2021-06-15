
<?= $this->extend("template/layout") ?>

<?= $this->section("content") ?>

<div class="container">
    <?= $this->include('room/nav')?>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <?php if(count($rooms)>0): ?>
            <table id="room_table" class="table">
                <thead>
                    <tr>
                        <th>Room ID</th>
                        <th>Room Type</th>
                        <th>Room Description</th>
                        <th>Rate Per Night</th>
                        <th>Room Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rooms as $room): ?>
                    <tr>
                        <td><?= $room['id'] ?></td>    
                        <td>
                            <?php
                                switch($room['room_type']){
                                    case '1': echo 'Single Room';
                                        break;
                                    case '2': echo 'Double Room';
                                        break;
                                    case '3': echo 'Suite';
                                        break;
                                    default: echo 'Not Listed';
                                }
                            ?>
                        </td>   
                        <td><?= $room['room_description'] ?></td>    
                        <td><?= $room['room_rate'] ?></td>
                        <td><?= ($room['room_status'] == '1') ? "Available" :  "Out of Order" ?></td>  
                        <td>
                            <a href="" class="btn btn-primary">Edit</a>
                            
                            <a href="<?= base_url().'/room/delete/'.$room['id'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Room ID</th>
                        <th>Room Type</th>
                        <th>Room Description</th>
                        <th>Rate Per Night</th>
                        <th>Room Status</th>
                        <th>Action</th>
                    </tr>         
                </tfoot>
            </table>
            <?php endif ?>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('#room_table').DataTable();
    } );
</script>
<?= $this->endSection() ?>
