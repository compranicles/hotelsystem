<?= $this->extend("template/layout") ?>

<?= $this->section("content") ?>
<link rel="stylesheet" href="<?= base_url().'/pickadate.js-master/lib/themes/classic.css'?>">
<link rel="stylesheet" href="<?= base_url().'/pickadate.js-master/lib/themes/classic.date.css'?>">

<div class="container">
    <div class="row">
        <h2 class="mt-5">Reservation</h2>
    </div>

    <?= form_open(); ?>
    <form> 
        <div class="row mt-5">
            <div class="col-md-12">
                <h4>Select Dates</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="start_date">Start Date</label>
                <input name="start_date" data-value="<?= date('Y-m-d')?>" class="form-control mt-2" id="start_pick">
            </div>
            <div class="form-group col-md-3">
                <label for="end_date">End Date</label>
                <input name="end_date" data-value="<?= date('Y-m-d', strtotime('+1 day'))?>" class="form-control mt-2" id="end_pick">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <h4>Select Room</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="room_type">Select Room Type</label>
                <select name="room_type" class="form-select" required>
                    option
                </select>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <h4>Guest Information</h4>
            </div>
        </div>
        <!-- <div class="row"> 
            <div class="form-group col-md-3">
                <label for="first_name" class="mt-2">First Name</label>
                <input type="text" name="first_name" placeholder="First Name" class="form-control" required autocomplete="first_name"/>
            </div>
            <div class="form-group col-md-3">
                <label for="last_name" class="mt-2">Last Name</label>
                <input type="text" name="last_name" placeholder="Last Name" class="form-control" required autocomplete="last_name"/>
            </div>
            <div class="form-group col-md-3">
                <label for="date_of_birth" class="mt-2">Date of birth</label>
                <input type="date" name="date_of_birth" class="form-control" required autocomplete="date_of_birth" />
            </div>
            <div class="form-group col-md-3">
                <label for="gender" class="mt-2">Gender</label>
                <select name="gender" id="SelectGender" class="form-select">
                    <option value="1">M</option>
                    <option value="2">F</option>
                    <option value="3">X</option>
                </select>
            </div>
        </div>
        <div class="row">
        <div class="form-group col-md-3">
                <label for="email" class="mt-2">Email</label>
                <input type="email" name="email" placeholder="Email" class="form-control" required autocomplete="email"/>
            </div>
        </div> -->
    </form>
    <?= form_close(); ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="<?= base_url().'/pickadate.js-master/lib/compressed/picker.js' ?>"></script>
<script src="<?= base_url().'/pickadate.js-master/lib/compressed/picker.date.js'?>"></script>
<script>
    $(document).ready( function () {
        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth();
        var day = today.getDate();

        $('#start_pick').pickadate({
            format: "mmmm d, yyyy",
            formatSubmit: "yyyy-mm-dd",
            min: [year,month,day],
            max: [year+1,month,day],
        });
        $('#end_pick').pickadate({
            format: "mmmm d, yyyy",
            formatSubmit: "yyyy-mm-dd",
            min: [year,month,day+1],
            max: [year+1,month,day+1]
        });
    } );
</script>
<?= $this->endSection() ?>
