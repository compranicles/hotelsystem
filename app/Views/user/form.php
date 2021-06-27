<!-- Not a crud just a form for add view and edit -->
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
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"  autocomplete="date_of_birth" />
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
<div class="row" id="passwords_row">
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
<script src="/js/litepicker.js"></script>
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

    
    
    
