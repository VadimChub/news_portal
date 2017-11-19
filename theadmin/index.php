<!doctype html>
<html lang="en">
<head>
    <title>Admin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/my_style.css">
</head>
<body>

<?php
require '../vendor/autoload.php';

//navbar
include_once 'navbar.php';

?>

<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <br>
        <h2>Settings</h2>
<div class="card">
    <div class="card-body">
        Change the navbar color:
        <a href="../index.php" target="_blank"><button type="button" class="btn btn-light btn-sm nav-change-standart">Standart</button></a>
        <a href="../index.php" target="_blank"><button type="button" class="btn btn-dark btn-sm nav-change-dark">Dark</button></a>
        <a href="../index.php" target="_blank"><button type="button" class="btn btn-primary btn-sm nav-change-primary">Primary</button></a>
        <a href="../index.php" target="_blank"><button type="button" class="btn btn-light btn-sm nav-change-light" style="background-color: #e3f2fd;">Light</button></a>
    </div>
</div>
            </div>
        <div class="col-sm-2"></div>
    </div>
</div>








<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="../js/myScript.js" type="text/javascript"></script></body>
</html>