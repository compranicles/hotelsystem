<?= $this->extend('template/layout')?>

<?= $this->section('content');?>
<?= $this->include('bars/navbar')?>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?= $this->include('reservation/api')?>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 id="nights">
                                                Available Rooms 
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            
                                            <?php if(count($rooms) > 0) :?>
                                                <?php foreach($rooms as $room): ?>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="row g-0">
                                                                    <div class="col-md-3">
                                                                        <img src="<?= "/uploads/".$room['room_photo']?>" alt="<?= "Room-".$room['room_name']?>" width="300px" height="200px" class="card-img-top rounded-start">
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title ms-3"><?= "Room-".$room['room_name'].", Floor ".$room['room_floor']?></h5>
                                                                            <h5 class="ms-3"><small><?= $room['room_type_name']?></small></h5>
                                                                            <p class="card-text ms-3">
                                                                                <?= $room['room_description']?>
                                                                                <br>
                                                                                <?= "Maximum of ".$room['max_guests']." guests"?>
                                                                            </p>
                                                                            <p class="card-text ms-3"><small>No Prepayment</small></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 text-center">
                                                                        <h6 class="card-title mt-5 mb-2"><small>&#8369; <?= $room['room_price']?>/Night</small></h6>
                                                                        
                                                                        <button value="<?= $room['room_id']?>" class="btn btn-warning mb-2">Reserve Now</button>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach ?>
                                            <?php else: ?>
                                                <div class="col-md-12 text-center">
                                                    <h4 class="card-title">No Available Rooms</h4>
                                                    <p class="card-text">Sorry, Looks like the rooms are reserved already</p>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#room_type").val("<?= $room_type_id?>").change();
        $("#guests").val("<?= $no_of_guests?>").change();


        var date1 = new Date('<?= $start_date?>');
        var date2 = new Date('<?= $end_date?>');

        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
        var numberOfNights = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
        
        var options = { year: 'numeric', month: 'long', day: 'numeric' };

        document.getElementById("nights").innerHTML = "Available Rooms for "+numberOfNights+" Night(s) ("+date1.toLocaleDateString("en-US", options)+" - "+date2.toLocaleDateString("en-US", options)+")";

    </script>
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
            position: 'bottom',
            maxDays: 31,
        });

        picker.setDateRange('<?= $start_date?>', '<?= $end_date?>', false);
    </script>
    <script>
        $(document).on('click', 'button', function() {
            var roomid = $(this).val();
            var date_start = '<?= $start_date?>';
            var date_end = '<?= $end_date?>';
            var guests = '<?= $no_of_guests?>';
            
            var url = "/reservation/reserve/" + roomid + "/" + date_start + "/" + date_end + "/" + guests; 

            $.ajax({
                url: url,
                success: function () {
                    window.location = url
                } 
            });
        });
    </script>

<?= $this->endSection()?>