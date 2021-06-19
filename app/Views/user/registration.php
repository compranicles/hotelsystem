<div class="row mt-5">
            <div class="col-md-12">
                <h4>Guest Information</h4>
                <hr>
            </div>
        </div>
        <div class="row"> 
            <div class="form-group col-md-4">
                <label for="first_name" class="mt-2">First Name</label>
                <input type="text" name="first_name" placeholder="First Name" class="form-control" required autocomplete="first_name"/>
            </div>
            <div class="form-group col-md-4">
                <label for="last_name" class="mt-2">Last Name</label>
                <input type="text" name="last_name" placeholder="Last Name" class="form-control" required autocomplete="last_name"/>
            </div>
            <div class="form-group col-md-4">
                <label for="date_of_birth" class="mt-2">Date of birth</label>
                <input type="date" name="date_of_birth" class="form-control" required autocomplete="date_of_birth" />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="gender" class="mt-2">Gender</label>
                <select name="gender" id="SelectGender" class="form-select">
                    <option value="">Select Gender</option>
                    <option value="1">M</option>
                    <option value="2">F</option>
                    <option value="3">X</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="email" class="mt-2">Email</label>
                <input type="email" name="email" placeholder="Email" class="form-control" required autocomplete="email"/>
            </div>
            <div class="form-group col-md-4">
                <label for="phone_number" class="mt-2">Phone Number</label>
                <input type="text" inputmode="numeric" name="phone_number" placeholder="9891234567" class="form-control" required autocomplete="phone_number">
            </div>
        </div>