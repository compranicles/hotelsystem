<?= $this->extend('template/layout');?>

<?= $this->section('content');?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="mb-4 text-center">Sign Up</h2>
                    <?= form_open('', 'id="user_form"') ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control" autocomplete="first_name"/>
                                    <label for="first_name">First Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control" autocomplete="last_name"/>
                                    <label for="last_name">Last Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="date_of_birth" id="date_of_birth" placeholder="date_of_birth" class="form-control"  autocomplete="date_of_birth" />
                                    <label for="date_of_birth">Date of birth</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select name="gender" id="gender" class="form-select pb-1">
                                        <option value="">Select Gender</option>
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                        <option value="X">X</option>
                                        <option value="S">Secret</option>
                                    </select>
                                    <label for="gender">Gender</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" id="email" placeholder="Email" class="form-control"  autocomplete="email"/>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" id="phone_number" name="phone_number" placeholder="9891234567" class="form-control"  autocomplete="phone_number">
                                    <label for="phone_number">Phone Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" id="password" placeholder="password" class="form-control" >
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" name="cpassword" id="cpassword" placeholder="cpassword" class="form-control" >
                                    <label for="cpassword">Confirm Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <p class="float-start ms-3"><small>We promise not to share your account and password.</small></p>
                                <input type="submit" id="submit" value="Sign Up" class="btn btn-warning px-4 float-end">
                            </div>
                        </div>
                    <?= form_close()?>
                </div>
            </div>
            <h5 class="text-center">
                <small>
                    Already have an account? <a href="<?= base_url().'/login'?>" class="link link-primary">Log In here.</a>
                </small>
            </h5>    
        </div>
    </div>
</div>
<script src="/js/litepicker.js"></script>
<script src="/js/reg-validator.js"></script>
<script>
    const today = new Date();
    
    var year = new Date().getFullYear();
    var month = new Date().getMonth();
    var day = new Date().getDate();
    var dateMin = new Date(year-100, month, day);
    var dateMax = new Date(year-18, month, day);

    const picker = new Litepicker({ 
        element: document.getElementById('date_of_birth'),
        dropdowns: {"minYear":year-100,"maxYear":year-18,"months":true,"years":true},
        minDate: dateMin,
        maxDate: dateMax,
    });
</script>
<?= $this->endSection()?>