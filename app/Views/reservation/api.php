<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-body">
                    <?= form_open(); ?>
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
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <select name="room_type" id="room_type" class="form-select pb-1" required>
                                            <option value="0">Select Room Type</option>
                                            <?php foreach($room_types as $type): ?>
                                            <option value="<?= $type['room_type_id']?>"> <?= $type['name']?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="room_type">Select Room Type</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-grid">
                                        <input type="submit" value="Check Availability" class="btn btn-warning py-3 px-5">
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
<script src="/js/litepicker.js"></script>
<script>
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate()+1);

    var year = new Date().getFullYear();
    var month = new Date().getMonth();
    var day = new Date().getDate();
    var dateMin = new Date(year, month, day);
    var dateMax = new Date(year+1, month, day);

    const picker = new Litepicker({
        element: document.getElementById('start-date'),
        elementEnd: document.getElementById('end-date'),
        singleMode: false,
        allowRepick: true,
        resetButton: true,
        tooltipText: {
            one: 'night',
            other: 'nights',
        },
        tooltipNumber: (totalDays) => {
            return totalDays - 1;
        },
        numberOfColumns: 2,
        numberOfMonths: 2,
        minDate: dateMin,
        maxDate: dateMax,
        firstDay: 0,
        position: 'top left'
    });

    picker.setDateRange(today, tomorrow, false);

</script>
