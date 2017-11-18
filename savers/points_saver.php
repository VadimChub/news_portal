<?php
namespace helpers;

require '../vendor/autoload.php';

use db\db_comment;

$commentId = $_POST['comentId'];
$userId = $_POST['user'];
$sign = $_POST['sign'];

$workObj = new db_comment();


if($sign == "+"){
    $workObj->plusPoints($commentId,$userId);
}
if($sign == "-"){
    $workObj->minusPoints($commentId,$userId);
}

$points = $workObj->countPoints($commentId);

echo $points;