<?= $this->extend("template/layout") ?>

<?= $this->section("content") ?>




<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Room Types
                        <a href="<?= base_url().'/room/type/add'?>" class="btn btn-primary float-end ms-2">Add</a>
                        <a href="<?= base_url().'/room'?>" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php if(count($room_types)>0): ?>
                        <table id="room_type_table" class="table">
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
                                        <a href="<?= base_url().'/room/type/'.$type['room_type_id'].'/edit' ?>" class="btn btn-outline-primary">Update</a>
                                        
                                        <a href="<?= base_url().'/room/type/'.$type['room_type_id'].'/delete' ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <h4 class="card-title">No Room Types</h4>
                        <p class="card-text">Looks like you need to add</p>
                        <a href="<?= base_url().'/room/type/add'?>" class="btn btn-primary">Go Add Room Types</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('#room_type_table').DataTable({
            "order": [[2, 'asc']],
        });
    } );
</script>
<?= $this->endSection() ?>
