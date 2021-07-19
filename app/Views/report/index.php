<?= $this->extend('template/layout')?>
<?= $this->section('content')?>
<?= $this->include('bars/navbar')?>
<div class="container-fluid my-4">
    <div class="row">
        <div class="col-md-3">
            <h2 class="ms-4">Reports Dashboard</h2>
        </div>
        <div class="col-md-9">
            <div class="card mx-5">
                <div class="card-body">
                    <?= form_open()?>
                        <div class="row">
                            <div class="col">
                                <h6>
                                    <span class="me-2">Select Date Range:</span> 
                                    <input type="text" name="start_date" id="start_date">
                                    <input type="text" name="end_date" id="end_date" class="me-2">
                                    <input type="submit" name="submit" value="Apply" class="btn btn-sm btn-primary">
                                </h6>
                            </div>
                        </div>
                    <?= form_close()?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="row mt-1 mx-1">
                        <div class="row row-cols-4 row-cols-md-1 g-1">
                            <h4>Today's Stats:</h4>
                            <div class="col">
                                <div class="card border-info mb-3" style="max-width: 15rem;">
                                    <div class="card-body">
                                        <h1 class="card-title text-info"><?= $checkins?></h1>
                                        <h5 class="card-title">Check-Ins</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card border-info mb-3" style="max-width: 15rem;">
                                    <div class="card-body">
                                        <h1 class="card-title text-info"><?= $checkouts?></h1>
                                        <h5 class="card-title">Check-Outs</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card border-info mb-3" style="max-width: 15rem;">
                                    <div class="card-body">
                                        <h1 class="card-title text-info"><?= $guests?></h1>
                                        <h5 class="card-title">Guests In-house</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card border-info mb-3" style="max-width: 15rem;">
                                    <div class="card-body">
                                        <h1 class="card-title text-info"><?= $cancels?></h1>
                                        <h5 class="card-title">Reservations Cancelled</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card m-2">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    
    
</div>
<script src="/js/litepicker.js"></script>
<script>
    const today = new Date();

    const picker = new Litepicker({
        element: document.getElementById('start_date'),
        elementEnd: document.getElementById('end_date'),
        singleMode: false,
        resetButton: true,
        dropdowns: {
            "minYear":2020,
            "maxYear":null,
            "months":true,
            "years":true,
        },
        firstDay : 0,
        numberOfColumns: 2,
        numberOfMonths: 2,
    });

    picker.setDateRange(today, today, false);
</script>
<?= $this->endSection()?>