<?= $this->extend('template/layout'); ?>


<?= $this->section('forGuests'); ?>
    <!-- Navigation in Right Part of the Header -->
    <div class="right_nav">
        <ul class="d-flex flex-row align-items-center justify-content-start">
            <div class="nav_right_links">
                <li><a href="#">Login</a></li>
                <li> | </li>
                <li><a href="#">Register</a></li>
            </div>
        </ul>
    </div>
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<section class="hero">
    <div class="hero-content">

        <h1 class="hero-title">
            Stay at Cavella
        </h1>

        <div class="col-md-8 offset-md-2 align-content-center">
        <h2 class="hero-subtitle">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac ipsum odio. 
            Pellentesque accumsan pharetra sem, ac congue erat ornare vel. Quisque ac fringilla mi.
        </h2>
        </div>

        <button class="hero-button">
            BOOK NOW
        </button>
    </div>
<!--<a href='https://www.freepik.com/photos/luxury'>Luxury photo created by dit26978 - www.freepik.com</a> -->
</section>
<?= $this->endSection(); ?>