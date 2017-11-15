<?php
namespace helpers;

$obj = new category_builder();
$obj->categoriesSelector();
$categoriesArray = $obj->getArrayOfCategories();

?>

<? foreach ($categoriesArray as $category):?>
    <?php  $href = lcfirst($category).".php";
    $arrayOfNews = $obj->getArrayOfNewsByCategoryName($category); ?>
    <div class="list-group">
    <a href="<?=$href?>" class="list-group-item list-group-item-action active">
        <?=$category?>
    </a>

    <? foreach ($arrayOfNews as $value) :?>
        <a href="news/news.php?id=<?= $value['id']?>" class="list-group-item list-group-item-action"><?= $value['title']?></a>
        </div>
    <? endforeach; ?>

<? endforeach;  ?>