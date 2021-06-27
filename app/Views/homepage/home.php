<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<?= $this->include('homepage/header')?>

<section class="hero">
    <div class="hero-content">

        <h1 class="hero-title">
            Stay at Cavella
        </h1>

        <div class="col-md-8 offset-md-2">
        <h2 class="hero-subtitle">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac ipsum odio. 
            Pellentesque accumsan pharetra sem, ac congue erat ornare vel. Quisque ac fringilla mi.
        </h2>
        </div>

        <?= $this->include('reservation/api')?>
        <!--<button class="hero-button">
            BOOK NOW
        </button> -->
    </div>
</section>

<!--<div class="container">
    <div class="row">
        <div class="col-md-12">
        
        </div>
    </div>
</div> -->
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
        position: 'top left',
        maxDays: 31,
    });

    picker.setDateRange(today, tomorrow, false);

   
</script>

<?= $this->endSection(); ?>