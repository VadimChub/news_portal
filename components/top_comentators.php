<?php
namespace components;

use db\db_user;


$obj = new db_user();

$top = $obj->topComentators();

?>
<br>
<h2>Top commentators:</h2>
<ul class="list-group">
<?php for($i=0; $i<count($top); $i++) :
    $comentator = $obj->getUserInfo($top[$i]);
    $quantity = $obj->countCommentsForUser($top[$i]);
    ?>
    <a href="user_comments.php?userid=<?=$top[$i]?>&username=<?=$comentator['name']?>&start=0">
  <li class="list-group-item d-flex justify-content-between align-items-center">
<?=$comentator['name'];?>
<span class="badge badge-primary badge-pill"><?=$quantity;?></span>
  </li>
    </a>
    <?php endfor; ?>
</ul>
