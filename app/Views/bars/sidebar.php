<?php if (session()->has('logged_in')) { ?>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="admin" aria-labelledby="adminLabel">
    <div class="offcanvas-header">
        <h3 class="offcanvas-title" id="adminLabel">Hello User!</h3>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            <h5>Options:</h5>
        </div>
        <div class="list-group list-group-flush">
            <a href="<?= base_url().'/customercheck'?>" class="list-group-item list-group-item-action">Check Reservation</a>
            <a href="<?= base_url().'/report'?>" class="list-group-item list-group-item-action">Reports</a>
            <a href="<?= base_url().'/reservation'?>" class="list-group-item list-group-item-action">Reservations</a>
            <a href="#" class="list-group-item list-group-item-action">Payments</a>
            <a href="<?= base_url().'/room'?>" class="list-group-item list-group-item-action">Rooms</a>
            <a href="<?= base_url().'/user'?>" class="list-group-item list-group-item-action">Users</a>
            <a href="<?= base_url().'/role'?>" class="list-group-item list-group-item-action">Roles</a>
            <a href="<?= base_url().'/permission'?>" class="list-group-item list-group-item-action">Permissions</a>
            <a href="<?= base_url().'user/edit'?>" class="list-group-item list-group-item-action">Update Personal Info</a>
            <a href="<?= base_url().'/user/changepassword'?>" class="list-group-item list-group-item-action">Change Password</a>
            <a href="" class="list-group-item list-group-item-action list-group-item-danger">Log Out</a>
        </div>
    </div>
</div>

<?php } ?>