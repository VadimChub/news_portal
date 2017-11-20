<?php
namespace helpers;

require '../vendor/autoload.php';

use db\db_comment;

$text = $_POST['text'];
$commentid = $_POST['comment'];
$user_id = $_POST['user'];

$subComObj = new db_comment();

$result = $subComObj->saveSubComment($text, $user_id, $commentid);
if($result){

    $subcomId = $subComObj->getSubCommentId($text, $user_id, $commentid);
    $subComment = $subComObj->makeSubComment($subcomId);

    echo $subComment;
}