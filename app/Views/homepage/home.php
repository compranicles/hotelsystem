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
<?= $this->endSection(); ?>