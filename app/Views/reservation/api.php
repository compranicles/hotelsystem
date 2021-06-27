<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-body">
                    <?= form_open('reservation/showroom', 'id="reserve_form"'); ?>
                        <form> 
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" name="arrival_date" id="start-date" class="form-control" required>
                                        <label for="start-date">Start Date</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" name="departure_date" id="end-date" class="form-control" required>
                                        <label for="end-date">End Date</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating">
                                        <input type="number" name="guests" placeholder="nice" value="1" step="1" max="5" id="guests" class="form-control" required>
                                        <label for="guests">Number of Guests</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating">
                                        <select name="room_type" id="room_type" class="form-select pb-1" required>
                                            <option value="0">Any</option>
                                            <?php foreach($room_types as $type): ?>
                                            <option value="<?= $type['room_type_id']?>"> <?= $type['name']?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="room_type">Room Type</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="d-grid">
                                        <input type="submit" value="Check Availability" class="btn btn-warning py-3">
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#reserve_form').validate({
        rules:{
            room_type: "required",
            guests: {
                required:true,
                digits:true
            }
        },
        errorElement: "small",
        errorClass: "text-danger",
    });
</script>
<script src="/js/litepicker.js"></script>

