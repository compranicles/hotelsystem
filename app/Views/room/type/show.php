<?= $this->extend("template/layout") ?>

<?= $this->section("content") ?>

<div class="container">
    <?= $this->include('room/nav')?>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <?php if(count($room_types)>0): ?>
            <table id="room_type_table" class="table">
                <thead>
                    <tr>
                        <th>Room Type Name</th>
                        <th>Rate Per Night</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($room_types as $type): ?>
                    <tr>
                        <td><?= $type['room_type_name'] ?></td>    
                        <td><?= $type['room_rate'] ?></td>
                        <td>
                            <a href="<?= base_url().'/room/type/edit/'.$type['id'] ?>" class="btn btn-outline-primary">Edit</a>
                            
                            <a href="<?= base_url().'/room/type/delete/'.$type['id'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Room Type Name</th>
                        <th>Rate Per Night</th>
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
        $('#room_type_table').DataTable();
    } );
</script>
<?= $this->endSection() ?>
