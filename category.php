<!doctype html>
<html lang="en">
<head>
    <title>Category</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/my_style.css">
</head>
<body>

<?php
require 'vendor/autoload.php';

use helpers\category_builder;

//navbar
include_once 'components/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 central">
<?php
$newObj = new category_builder();
$name = $_GET['name'];
$startB = $_GET['start'];

$arrayOfNews = $newObj->getArrayOfNewsByCategoryName($name,$startB);
?>
            <br>
            <h1><?=$name?></h1>
            <br>
            <div class="list-group">
                <? foreach ($arrayOfNews as $value) :?>
                <a href="news.php?id=<?= $value['id']?>" class="list-group-item list-group-item-action"><?= $value['title']?></a>
        <? endforeach; ?>
            </div>
            <br>
<?php
//pagination
include 'components/pagination_builder.php';

?>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="js/myScript.js" type="text/javascript"></script>
</body>
</html>