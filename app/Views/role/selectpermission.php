<?= $this->extend('template/layout');?>

<?= $this->section('content'); ?>

<?php $session = \Config\Services::session(); ?>

<div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Select permissions for '<?= $role['name']?>' role
                            <a href="<?= base_url().'/role'?>" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="container mb-2">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                <?php if ($session->getTempdata('success_perm_role')): ?>
                                    <div class="alert alert-success" role="alert">
                                        <i class="bi bi-check-circle"></i>  <?= $session->getTempdata('success_perm_role'); ?>
                                    </div>
                                    <?php elseif ($session->getTempdata('error_perm_role')): ?>
                                    <div class="alert alert-danger" role="alert">
                                    <i class="bi bi-x-circle"></i>  <?= $session->getTempdata('error_perm_role'); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="container mt-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6>
                                                Select permissions to be added:
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                        
                                            <?php if(count($permunselected) > 0 ) : ?>
                                                <table id="permunselected_table"class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($permunselected as $row): ?>
                                                        <tr>
                                                            <td><?= $row['perm_name']?></td>
                                                            <td>
                                                                <a href="<?= base_url().'/role/addPermissionToRole/'.$role['role_id'].'/'.$row['perm_id']?>" class="btn btn-primary me-2">Add</a>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php else: ?>
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <h4 class="card-title">No Permissions here</h4>
                                                        <p class="card-text">Looks like you need to add</p>
                                                        <a href="<?= base_url().'/permission/add'?>" class="btn btn-primary">Add Permission</a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6>
                                                Current permissions of '<?= $role['name']?>' role:
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                        <?php if(count($permselected) > 0 ) : ?>
                                                <table id="permselected_table"class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($permselected as $row): ?>
                                                        <tr>
                                                            <td><?= $row['perm_name']?></td>
                                                            <td>
                                                                <a href="<?= base_url().'/role/removePermissionToRole/'.$role['role_id'].'/'.$row['rope_id']?>" class="btn btn-danger me-2">Remove</a>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php else: ?>
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <h4 class="card-title">No Permissions for '<?= $role['name']?>' role: </h4>
                                                        <p class="card-text">Select from table on the left.</p>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready( function () {
        $('#permunselected_table').DataTable({
        });
        $('#permselected_table').DataTable({
        });
    } );
</script>
<?= $this->endSection() ?>