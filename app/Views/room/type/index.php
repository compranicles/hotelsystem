<?= $this->extend("template/layout") ?>

<?= $this->section("content") ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.3.1/dt-1.10.25/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.3.1/dt-1.10.25/datatables.min.js"></script>


<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Room Types
                        <a href="<?= base_url().'/room/type/add'?>" class="btn btn-primary float-end">Add</a>
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
                                        <a href="<?= base_url().'/room/type/'.$type['room_type_id'].'/edit' ?>" class="btn btn-outline-primary">Edit</a>
                                        
                                        <a href="<?= base_url().'/room/type/'.$type['room_type_id'].'/delete' ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <h5 class="card-title">No Room Types</h5>
                        <p class="card-text">Looks like you need to add</p>
                        <a href="#" class="btn btn-primary">Go Add Room Types</a>
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
