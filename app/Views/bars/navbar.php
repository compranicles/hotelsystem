<?php if (session()->has('logged_in')): ?>

<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand mb-0 h1" href="<?= base_url()?>">
            <img src="/cavella_logo.png" alt="Cavella Hotel" width="70" height="65">
            Cavella Hotel
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" data-bs-toggle="offcanvas" role="button" data-bs-target="#admin" aria-controls="admin" href="#">Options</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php else:?>
    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand mb-0 h1" href="<?= base_url()?>">
                <img src="/cavella_logo.png" alt="Cavella Hotel" width="70" height="65">
                Cavella Hotel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url()?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url().'/login'?>">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url().'/register'?>">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php endif; ?>

<?= $this->include('bars/sidebar')?>