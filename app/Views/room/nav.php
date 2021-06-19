<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <h2>Rooms</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-5" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url().'/room' ?>">Show</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url().'/room/add' ?>">Add</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url().'/room/type'?>">Room Type-Show</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url().'/room/type/add' ?>">Room Type-Add</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
