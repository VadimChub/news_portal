<?php
namespace components;

use db\db_news;

$obj = new db_news();
$top = $obj->topNews();
?>
<br>
<h2>Top news:</h2>
<ul class="list-group">
    <?php for($i=0; $i<count($top); $i++) :
        $topNewsContent = $obj->getNewInfo($top[$i]);
        ?>
            <a href="news.php?id=<?=$top[$i];?>" class="list-group-item list-group-item-action"><?=$topNewsContent['title'];?></a>
    <?php endfor; ?>
</ul>
