<?= $this->extend('template/layout');?>
<?= $this->section('content'); ?>

<?php $session = \Config\Services::session(); ?>
<?= $this->include('bars/sidebar.php')?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Select Roles for <?= $user['first_name']." ".$user['last_name']?>
                        <a href="<?= base_url().'/user'?>" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                <div class="container mb-2">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                <?php if ($session->getTempdata('success_role_user')): ?>
                                    <div class="alert alert-success" role="alert">
                                        <i class="bi bi-check-circle"></i>  <?= $session->getTempdata('success_role_user'); ?>
                                    </div>
                                    <?php elseif ($session->getTempdata('error_role_user')): ?>
                                    <div class="alert alert-danger" role="alert">
                                    <i class="bi bi-x-circle"></i>  <?= $session->getTempdata('error_role_user'); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>
                                            Select Roles to be added:
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <?php if(count($roleunselected) > 0): ?>
                                            <table id="roleunselected_table" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Role Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($roleunselected as $row): ?>
                                                        <tr>
                                                            <td><?= $row['role_name'] ?></td>
                                                            <td>
                                                                <a href="<?= base_url().'/user/addRoleToUser/'.$user['user_id'].'/'.$row['role_id']?>" class="btn btn-success me-2">Add</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>
                                            Current Roles of the User:
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <?php if(count($roleselected) > 0): ?>
                                            <table id="roleselected_table" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Role Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($roleselected as $row): ?>
                                                        <tr>
                                                            <td><?= $row['role_name'] ?></td>
                                                            <td>
                                                                <a href="<?= base_url().'/user/removeRoleToUser/'.$user['user_id'].'/'.$row['uac_id']?>" class="btn btn-danger me-2">Remove</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        <?php endif;?>
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
        $('#roleunselected_table').DataTable({
        });
        $('#roleselected_table').DataTable({
        });
    } );
</script>
<?= $this->endSection()?>