<?php if (session()->has('logged_in')) { ?>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="admin" aria-labelledby="adminLabel">
    <div class="offcanvas-header">
        <h3 class="offcanvas-title" id="adminLabel">Hello <?= $_SESSION['first_name']?>!</h3>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            <h5>Options:</h5>
            <h5 id="user_id" hidden><?= session()->get('id')?></h5>
        </div>
        <div class="list-group list-group-flush">
            <a href="<?= base_url().'/checkin'?>"       id="CheckIn"        class="list-group-item list-group-item-action" hidden>Check-In History</a>
            <a href="<?= base_url().'/customercheck'?>" id="CustomerCheck"  class="list-group-item list-group-item-action" hidden>Check Reservation</a>
            <a href="<?= base_url().'/report'?>"        id="Report"         class="list-group-item list-group-item-action" hidden>Reports</a>
            <a href="<?= base_url().'/reservation'?>"   id="Reservation"    class="list-group-item list-group-item-action" hidden>Reservations</a>
            <a href="<?= base_url().'/payment'?>"       id="Payment"        class="list-group-item list-group-item-action" hidden>Payments</a>
            <a href="<?= base_url().'/room'?>"          id="Room"           class="list-group-item list-group-item-action" hidden>Rooms</a>
            <a href="<?= base_url().'/user'?>"          id="User"           class="list-group-item list-group-item-action" hidden>Users</a>
            <a href="<?= base_url().'/role'?>"          id="Role"           class="list-group-item list-group-item-action" hidden>Roles</a>
            <a href="<?= base_url().'/permission'?>"    id="Permission"     class="list-group-item list-group-item-action" hidden>Permissions</a>
            <a href="<?= base_url().'/user/edit'?>"     id="UserEdit"       class="list-group-item list-group-item-action" hidden>Update Personal Info</a>
            <a href="<?= base_url().'/user/changepassword'?>" class="list-group-item list-group-item-action">Change Password</a>
            <a href="<?= base_url().'/user/logout'?>" class="list-group-item list-group-item-action list-group-item-danger">Log Out</a>
        </div>
    </div>
</div>

<script>
    var options = new Array("CheckIn", "CustomerCheck", "Report", "Reservation", "Payment", "Room", "User", "Role", "Permission", "UserEdit");
    var id = document.getElementById('user_id').innerHTML;
    options.forEach((option) => {
        var url = "/permissionchecker/checkajax/"+id+"/"+option;
        $.ajax({
            url: url,
            method: 'get',
            success: function (data){
                if(data == true){
                    $("#"+option).removeAttr("hidden");
                }
            }
        });
    });
</script>

<?php } ?>