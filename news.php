<!doctype html>
<html lang="en">
<head>
    <title>News</title>
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
 use db\db_news;
//navbar
include_once 'components/navbar.php';

$obj = new db_news();
$newId = $_GET['id'];
$arrayOfTags = $obj->getTags($newId);
$arrayOfImages = $obj->getImages($newId);
$arrayOfInfo = $obj->getNewInfo($newId);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <br>
            <h1><?=$arrayOfInfo['title']?></h1>

            <?php if ($arrayOfImages) : ?>
                <?php
                $count = count($arrayOfImages);
                ?>

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php for ($i=0; $i < 1; $i++) :?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i;?>" class="active"></li>
                        <?php endfor;?>
                        <?php if ($count > 1) { for ($i=1; $i < $count; $i++) :?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i;?>"></li>
                        <?php endfor; } ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php for ($i=0; $i < 1; $i++) :?>
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="<?=substr($arrayOfImages[$i],3);?>" alt="">
                        </div>
                        <?php endfor; ?>
                        <?php if ($count > 1) { for ($i=1; $i < $count; $i++) :?>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="<?=substr($arrayOfImages[$i],3);?>" alt="">
                            </div>
                        <?php endfor; } ?>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            <?php endif; ?>

        </div>
        <div class="col-sm-3"></div>
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