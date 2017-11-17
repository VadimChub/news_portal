<?php
namespace helpers;
require_once __DIR__ . "/../vendor/autoload.php";
use db\db;
$obj = new category_builder();
$obj->categoriesSelector();
$categoriesArray = $obj->getArrayOfCategories();
$dataBaseObject = new db();
$connection = $dataBaseObject->getConnection();
?>

<? foreach ($categoriesArray as $category):?>
    <?php
    $getIdQuery = $connection->query("SELECT id FROM categories WHERE category = '$category'");
    $categoryIdArray = $getIdQuery->fetch();
    $categoryId = $categoryIdArray['id'];
    $href = "category.php?id=".$categoryId."&name=".$category."&start=0";
    $arrayOfNews = $obj->getArrayOfNewsByCategoryName($category); ?>
    <div class="list-group">
    <a href="<?=$href?>" class="list-group-item list-group-item-action active">
        <?=$category?>
    </a>

    <? foreach ($arrayOfNews as $value) :?>
        <a href="news.php?id=<?= $value['id']?>" class="list-group-item list-group-item-action"><?= $value['title']?></a>
    <? endforeach; ?>
    </div>
    <br>
<? endforeach;  ?>