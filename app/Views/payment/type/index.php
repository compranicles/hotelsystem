<?= $this->extend("template/layout") ?>

<?= $this->section("content") ?>




<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Payment Types
                        <a href="<?= base_url().'/payment/type/add'?>" class="btn btn-primary float-end ms-2">Add</a>
                        <a href="<?= base_url().'/payment'?>" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php if(count($payment_types)>0): ?>
                        <table id="payment_type_table" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Date Added</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($payment_types as $type): ?>
                                <tr>
                                    <td><?= $type['name'] ?></td>
                                    <td><?= $type['description'] ?></td>
                                    <td><?= date('F j, Y', strtotime($type['date_created'])) ?></td>
                                    <td>
                                        <a href="<?= base_url().'/payment/type/'.$type['payment_type_id'].'/edit' ?>" class="btn btn-outline-primary">Update</a>
                                        <a href="<?= base_url().'/payment/type/'.$type['payment_type_id'].'/delete' ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4 class="card-title">No Payment Types</h4>
                                <p class="card-text">Looks like you need to add</p>
                                <a href="<?= base_url().'/payment/type/add'?>" class="btn btn-primary">Go Add Payment Types</a>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('#payment_type_table').DataTable({
            "order": [[2, 'asc']],
        });
    } );
</script>
<?= $this->endSection() ?>
