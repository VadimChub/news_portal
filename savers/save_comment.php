<?php
namespace helpers;

require '../vendor/autoload.php';

use db\db_comment;

$text = $_POST['text'];
$userId = $_POST['user'];
$articleId = $_POST['article'];

$object = new db_comment();
$result = $object->saveComment($text, $userId, $articleId);
if ($result) {
    $commentId = $object->getCommentId($text, $userId, $articleId);

    $comment = $object->makeComment($commentId);

    echo $comment;
}