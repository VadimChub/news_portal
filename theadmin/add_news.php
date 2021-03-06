<!doctype html>
<?php session_start(); ?>
<?php require_once '../vendor/autoload.php';
use db\db;
use db\db_news;
?>
<html lang="en">
<head>
    <title>Add new</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>
<?php include 'navbar.php';?>
<div class="container">
    <div class="row">
<div class="col-sm-4"></div>
<div class="col-sm-4">
    <br>
<form action="../savers/save_new.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect2">Choose the categories</label>
        <select multiple class="form-control" id="exampleFormControlSelect2" name="categories[]" required>
            <option>Politic</option>
            <option>Analitic</option>
            <option>Economic</option>
            <option>Science</option>
            <option>Sport</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Text</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text" required></textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Image</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file[]" multiple>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Tags</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="tags"></textarea>
        <small id="emailHelp" class="form-text text-muted">All tags should be separated with # sign</small>
    </div>
    <button type="submit" class="btn btn-primary">Add news</button>
</form>
        <div class="col-sm-4"></div>

</div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="../js/myScript.js" type="text/javascript"></script>
</body>
</html>