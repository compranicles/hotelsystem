<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/style.css">

    <title>Hotel Reservation System</title>
</head>
    <body>

    <header class="header">
        <div class="header_content d-flex flex-column align-items-center justify-content-lg-end justify-content-center">

            <div class="logo_container">
            <a href="#">
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
                <?= $this->renderSection("forGuests");?>
                <div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
            </nav>
        </div>
    </header>
    
        <?= $this->renderSection("content");?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    </body>
</html>