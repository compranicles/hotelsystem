<?= $this->extend('template/layout');?>

<?= $this->section('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Roles
                            <a href="<?= base_url().'/role/add'?>" class="btn btn-primary float-end">Add</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php if(count($roles)>0): ?>
                            <table id="role_table"class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($roles as $role): ?>
                                    <tr>
                                        <td><?= $role['name']?></td>
                                        <td><?= $role['description']?></td>
                                        <td>
                                            <a href="<?= base_url().'/role/selectpermission/'.$role['role_id']?>" class="btn btn-primary me-2">Permissions</a>
                                            <a href="<?= base_url().'/role/edit/'.$role['role_id'] ?>" class="btn btn-warning me-2">Update</a>
                                            <a href="<?= base_url().'/role/delete/'.$role['role_id'] ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="card-title">No Roles here</h4>
                                    <p class="card-text">Looks like you need to add</p>
                                    <a href="<?= base_url().'/role/add'?>" class="btn btn-primary">Go Add Roles</a>
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
        $('#role_table').DataTable({
        });
    } );
</script>
<?= $this->endSection()?>