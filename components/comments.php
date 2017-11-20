<?php

namespace components;

use db\db_comment;

$obj = new db_comment();
$arrayOfComments = $obj->getAllComments($_GET['id']);
?>
<ul class="list-group">
    <p class="empty">Comments:</p>

    <?php foreach ($arrayOfComments as $comment) : ?>
        <?php $arrayOfSubComments = $obj->getAllSubComments($comment['id']); ?>
        <span class="comment-p"><li class="list-group-item d-flex justify-content-between align-items-center">
            <small id="commentator-info" comid="<?=$comment['id']?>" class="form-text text-muted"><?= $comment['date'] ,"|" ,$name = $obj->getCommentatorName($comment['user_id']);;?></small>
            <p class="commented-text"><?=$comment['text']?></p>
            <label><span class="badge badge-primary badge-pill"><?=$comment['points']?></span></label>
        </li>
            <p class="test1" id="test1"><span class="badge badge-pill badge-secondary additional-reply" id="reply">reply</span> <span class="badge badge-pill badge-danger comment-minus">-</span> <span class="badge badge-pill badge-success comment-plus">+</span></p>
 <ul class="list-group sub-ul">
            <?php if($arrayOfSubComments): ?>
                <?php foreach ($arrayOfSubComments as $subComment): ?>
                    <li class="list-group-item list-group-item-secondary sub-comment">
                        <small id="comment-info" subcomid="<?=$subComment['id']?>" class="form-text text-muted"><?= $subComment['date'] ,"|" ,$name = $obj->getCommentatorName($subComment['user_id']);;?></small>
                        <?=$subComment['text']?>
                    </li>
                    <br>
                    <?php endforeach; ?>
                <br>
            <?php endif; ?>
            </ul>
        </span>
    <? endforeach; ?>
</ul>
<br>
<form>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Add comment:</label>
        <textarea class="form-control comment-text" id="commentTxt" rows="3"></textarea>
    </div>
    <button type="button" class="btn btn-secondary comment-button">Comment</button>
</form>

<script>
    var user_id=<?=$_SESSION['user_id'];?>;
</script>