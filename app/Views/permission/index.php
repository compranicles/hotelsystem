<?= $this->extend('template/layout');?>

<?= $this->section('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Permissions
                            <a href="<?= base_url().'/permission/add'?>" class="btn btn-primary float-end">Add</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php if(count($permissions)>0): ?>
                            <table id="permission_table"class="table">
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
                                            <a href="<?= base_url().'/permission/edit/'.$permission['permission_id'] ?>" class="btn btn-warning me-2">Update</a>
                                            <a href="<?= base_url().'/permission/delete/'.$permission['permission_id'] ?>" class="btn btn-danger">Delete</a>
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
<script>
    $(document).ready( function () {
        $('#permission_table').DataTable({
        });
    } );
</script>
<?= $this->endSection()?>