<?php

namespace helpers;

require '../vendor/autoload.php';

use db\db_advert;

$position = $_POST['position'];
$advertObj = new db_advert();

$advertObj->deleteAdvert($position);