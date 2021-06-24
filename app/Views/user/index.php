<?= $this->extend('template/layout');?>

<?= $this->section('content'); ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Users
                        <a href="<?= base_url().'/user/add'?>" class="btn btn-primary float-end">Add</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php if(count($users) > 0): ?>
                        <table id="users_table" class="table">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>User Data</th>
                                    <th>User Roles</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?= $user['user_id'] ?></td>
                                    <td><?= $user['first_name']." ".$user['last_name']?></td>
                                    <td>
                                        <a href="<?= base_url().'/user/view/'.$user['user_id'] ?>" class="btn btn-primary">View Data</a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url().'/user/role/'.$user['user_id'] ?>" class="btn btn-secondary">Manage Roles</a>
                                    </td>
                                    <td>    
                                        <a href="<?= base_url().'/user/delete/'.$user['user_id'] ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('#users_table').DataTable({
        });
    } );
</script>
<?= $this->endSection();?>
