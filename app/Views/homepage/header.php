<header class="header">
    <div class="header_content d-flex flex-column align-items-center justify-content-lg-end justify-content-center">

        <div class="logo_container">
        <a href="<?= base_url()?>">
            <img class="logo" src="cavella_logo.png" alt="">
        </a>
        </div>
        <!-- Main Nav -->
        <nav class="main_nav">
            <ul class="d-flex flex-row align-items-center justify-content-start">
                <li><a class="active" href="/">Home</a></li>
                <li><a href="#">Rooms</a></li>
                <li><a href="#">About us</a></li> 
                <li><a href="#">Contact</a></li>
            </ul>
            <!-- Hamburger Button -->
            <!-- Navigation in Right Part of the Header -->
            <div class="right_nav">
                <ul class="d-flex flex-row align-items-center justify-content-start">

                        <li><a href="<?= base_url().'/login'?>">Login</a> | <a href="<?= base_url().'/register' ?>">Register</a></li>

                </ul>
            </div>
            <div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
        </nav>
    </div>
</header>