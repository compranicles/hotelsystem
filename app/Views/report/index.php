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
        <!-- Reports Part -->
        <div class="col-md-10">
            <div class="card m-2">
                <div class="card-header">
                    <h4>
                        Data from <span class="text-success"><?= $datestart?></span> to <span class="text-success"><?= $dateend?></span>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card border-dark ms-3 mb-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Preferred Payment Type</div>
                                <div class="card-body text-dark">
                                    <?php if(count($paymentrecords)>0): ?>
                                    <?php foreach($paymentrecords as $row): ?>
                                        <h1 class="card-title text-info"><?= $row['paymenttypecount']?></h1>
                                        <h5 class="card-title"><?= $row['typename']?> Transactions</h5>
                                    <?php endforeach?>
                                    <?php else: ?>
                                        <h1 class="card-title text-info">0</h1>
                                        <h5 class="card-title">Transactions</h5>
                                    <?php endif?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark ms-3 mb-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Number of Check-Ins</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info"><?= $rangecheckins?></h1>
                                    <h5 class="card-title">Check-Ins</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark ms-3 mb-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Number of Check-Outs</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info"><?= $rangecheckouts?></h1>
                                    <h5 class="card-title">Check-Outs</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">No. of Cancelled Reservations</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info"><?= $rangecancels?></h1>
                                    <h5 class="card-title">Cancelled Reservations</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">No. of Pending Reservations</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info"><?= $rangePendingCheckins?></h1>
                                    <h5 class="card-title">Pending Reservations</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">No. of Pending Check-Outs</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info"><?= $rangePendingCheckouts?></h1>
                                    <h5 class="card-title">Pending Check-Outs</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Ave. No. of Vacant Rooms</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info"><?= $rangeunoccupied?></h1>
                                    <h5 class="card-title">Vacant Rooms</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Total No. of Reservations</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info"><?= $rangereservations?></h1>
                                    <h5 class="card-title">Reservations</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Total Revenue</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-success"><?= number_format($totalrevenue, 2, ".", ",")?></h1>
                                    <h5 class="card-title">PHP</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">No. of No Shows</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-info">
                                        <?php
                                            $countcancelled = 0; 
                                            $countnoshows = 0;
                                            foreach($totalnoshows as $row){
                                                if($row['noshows'] == 0){
                                                    $countcancelled++;
                                                }
                                                if($row['cancelled'] == 1){
                                                    $countnoshows++;
                                                }
                                            }
                                            echo abs($countnoshows-$countcancelled);
                                        ?>
                                    </h1>
                                    <h5 class="card-title">No-Shows</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Loss From Cancelled Reservations</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-danger"><?= number_format($totallosscancel, 2, '.', ',')?></h1>
                                    <h5 class="card-title">PHP</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-dark mb-3 ms-3" style="max-width: 15rem;">
                                <div class="card-header bg-transparent">Loss From No-Shows</div>
                                <div class="card-body text-dark">
                                    <h1 class="card-title text-danger">
                                        <?php
                                            $totalamount = 0; 
                                            foreach($lossnoshows as $row){
                                                if($row['noshows'] == 0){
                                                    $totalamount += $row['lossamount'];
                                                }
                                            }
                                            echo number_format(abs($totallosscancel-$totalamount), 2, '.', ',');
                                        ?>
                                    </h1>
                                    <h5 class="card-title">PHP</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</div>
<script src="/js/litepicker.js"></script>
<script>
    const today = new Date();
    var monthBefore = new Date();
    monthBefore.setMonth(monthBefore.getMonth() - 1);

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

    picker.setDateRange(monthBefore, today, false);
</script>
<?= $this->endSection()?>