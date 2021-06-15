
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
                        <th>Room Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rooms as $room): ?>
                    <tr>
                        <td><?= $room['id'] ?></td>    
                        <td><?= $room['room_type_name']?></td>   
                        <td><?= $room['room_description'] ?></td>    
                        <td><?= ($room['room_status'] == '1') ? "Available" :  "Out of Order" ?></td>  
                        <td>
                            <a href="<?= base_url().'/room/edit/'.$room['id']?>" class="btn btn-outline-primary">Edit</a>
                            
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
