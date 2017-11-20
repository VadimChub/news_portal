<?php

namespace helpers;

require '../vendor/autoload.php';

use db\db_advert;

$title = $_POST['title'];
$price = $_POST['price'];
$owner = $_POST['owner'];
$position = $_POST['position'];

$advertObj = new db_advert();

$advertObj->updateAdvert($position, $title, $price, $owner);
