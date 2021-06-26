<button class="btn btn-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#admin" aria-controls="admin">
    Menu
</button>

<div class="offcanvas offcanvas-start" tabindex="-1" id="admin" aria-labelledby="adminLabel">
    <div class="offcanvas-header">
        <h3 class="offcanvas-title" id="adminLabel">Hello User!</h3>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            <h5>Menu Items:</h5>
        </div>
        <div class="list-group list-group-flush">
            <a href="#" class="list-group-item list-group-item-action">Check-In</a>
            <a href="#" class="list-group-item list-group-item-action">Reports</a>
            <a href="#" class="list-group-item list-group-item-action">Reservations</a>
            <a href="#" class="list-group-item list-group-item-action">Payments</a>
            <a href="<?= base_url().'/room'?>" class="list-group-item list-group-item-action">Rooms</a>
            <a href="<?= base_url().'/user'?>" class="list-group-item list-group-item-action">Users</a>
            <a href="<?= base_url().'/role'?>" class="list-group-item list-group-item-action">Roles</a>
            <a href="<?= base_url().'/permission'?>" class="list-group-item list-group-item-action">Permissions</a>
            <a href="" class="list-group-item list-group-item-action">Update Personal Info</a>
            <a href="" class="list-group-item list-group-item-action">Change Password</a>
            <a href="" class="list-group-item list-group-item-action list-group-item-danger">Log Out</a>
        </div>
    </div>
</div>