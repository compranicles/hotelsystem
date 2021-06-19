<?= $this->extend("template/layout") ?>

<?= $this->section("content") ?>
<div class="container">
    <?= form_open(); ?>
    <form> 
        <div class="row">
            <div class="col-md-3 form-group">
                <label for="arrival_date">Start Date</label>
                <input type="text" name="arrival_date" id="start-date" class="form-control" required>
            </div>
            <div class="col-md-3 form-group">
                <label for="departure_date">End Date</label>
                <input type="text" name="departure_date" id="end-date" class="form-control" required>
            </div>
            <div class="col-md-3 form-group">
                <label for="room_type">Select Room Type</label>
                <select name="room_type" class="form-select" required>
                    <option value="0">Any</option>
                </select>
            </div>
            <div class="d-grid gap-2 col-md-3 form-group">
                <input type="submit" value="Check Availability" class="btn btn-outline-primary mt-4">
            </div>
        </div>
    </form>
    <?= form_close(); ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<script>
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate()+1);

    var year = new Date().getFullYear();
    var month = new Date().getMonth();
    var day = new Date().getDate();
    var dateMin = new Date(year, month, day);
    var dateMax = new Date(year+1, month, day+1);

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
    });

    picker.setDateRange(today, tomorrow, false);

</script>
<?= $this->endSection() ?>
