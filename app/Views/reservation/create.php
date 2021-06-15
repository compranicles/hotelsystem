<?= $this->extend("template/layout") ?>

<?= $this->section("content") ?>
<link rel="stylesheet" href="/pickadate.js-master/lib/themes/classic.css">
<link rel="stylesheet" href="/pickadate.js-master/lib/themes/classic.date.css">

<div class="container">
    <div class="row">
        <h2 class="my-5">Room Reservation</h2>
    </div>

    <?= form_open(); ?>
    <form> 
        <div class="row">
            <div class="form-group col-md-3">
                <label for="start_date">Start Date</label>
                <input name="start_date" class="form-control" id="start_pick">
            </div>
            <div class="form-group col-md-3">
                <label for="end_date">End Date</label>
                <input name="start_date" class="form-control" id="end_pick">
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
<script src="/pickadate.js-master/lib/compressed/picker.js"></script>
<script src="/pickadate.js-master/lib/compressed/picker.date.js"></script>
<script>
    $(document).ready( function () {
        $('#start_pick').pickadate({
            formatSubmit('yyyy-mm-dd'),
            hiddenName: true
        });
        $('#end_pick').pickadate({
            formatSubmit('yyyy-mm-dd'),
            hiddenName: true
        });
    } );
    
</script>
<?= $this->endSection() ?>
