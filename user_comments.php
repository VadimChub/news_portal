<!doctype html>
<?php session_start(); ?>
<html lang="en">
<head>
    <title>User comments</title>
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
use db\db_comment;
use db\db_user;

//navbar
include_once 'components/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2"><?php include 'components/advert_left.php'?></div>
        <div class="col-sm-8">
            <?php
            $comObj = new db_comment();
            $userObj = new db_user();
            $userId = $_GET['userid'];
            $userName = $_GET['username'];
            $countComments = $userObj->countCommentsForUser($userId);
            $userComments = $comObj->getAllCommentsByUserId($userId);
            $startB = $_GET['start'];
            define("PAGES",5);

            $last = intval($countComments/5)+1;
            $current = intval($startB/5)+1;

            $hrefBase = "user_comments.php?userid=$userId&username=$userName&start=";
            $previous = ($current*5)-10;
            $next = ($current*5);
            $lastPage = ($last*5)-5;
            $to = ($startB+5);
            if ($to>$countComments){$to = $countComments;}
            ?>
            <br>
            <h1 class="central"><?= $userName;?></h1>
            <br>
            <?php for ($i=$startB; $i<$to; $i++): ?>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <small class="form-text text-muted"><?=$userComments[$i]['date']?></small>
                        <span><?=$userComments[$i]['text']?></span>
                        <span class="badge badge-primary badge-pill"><?=$userComments[$i]['points']?></span>
                    </li>
                </ul>
            <?php endfor; ?>
            <br>

            <?php
            require 'vendor/autoload.php';

            use db\db;
            use helpers\pagination;


            ?>


            <div class="btn-group pagination" role="group" aria-label="Button group with nested dropdown">
                <a href="<?=$hrefBase."$previous"?>"><button type="button" class="btn btn-light back-button">Back</button></a>
                <a href="<?=$hrefBase."0"?>"><button type="button" class="btn btn-light first-button">1</button></a>
                <a href=""><button type="button" class="btn btn-secondary current-button"><?=$current?></button></a>

                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <?php if($last > 2){
                            for($i=1; $i<$last-1; $i++):
                                $start = $i * PAGES;
                                $href = $hrefBase.$start;
                                ?>
                                <a class="dropdown-item" href="<?=$href?>"><?=$i+1?></a>
                            <?php endfor; }?>
                    </div>
                </div>


                <a href="<?=$hrefBase."$lastPage"?>"><button type="button" class="btn btn-light last-button"><?=$last?></button></a>
                <a href="<?php if($next <= $countComments){ echo $hrefBase."$next";}?>"><button type="button" class="btn btn-light next-button">Next</button></a>
            </div>


        </div>
        <div class="col-sm-2"><?php include 'components/advert_right.php'?></div>
    </div>
</div>
<?php include 'components/footer.php'?>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="js/myScript.js" type="text/javascript"></script>
</body>
</html>