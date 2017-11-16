<?php
require 'vendor/autoload.php';

use db\db;
use helpers\pagination;

$id = $_GET['id'];
$name = $_GET['name'];
$startB = $_GET['start'];
$obj = new pagination();
$newsQuantity = $obj->paginationCount($id);

define("PAGES",5);
$last = intval($newsQuantity/5)+1;
$current = intval($startB/5)+1;

$hrefBase = "category.php?id=".$id."&name=".$name."&start=";
$previous = ($current*5)-10;
$next = ($current*5);
$lastPage = ($last*5)-5;

?>


<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    <a href="<?=$hrefBase."$previous"?>"><button type="button" class="btn btn-light back-button">Back</button></a>
    <a href="<?=$hrefBase."0"?>"><button type="button" class="btn btn-light first-button">1</button></a>
    <a href=""><button type="button" class="btn btn-secondary current-button"><?=$current?></button></a>

    <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <?php if($last > 2){
                for($i=1; $i<$last-1; $i++):
                    $start = $i * PAGES;
                    $href = "category.php?id=".$id."&name=".$name."&start=$start";
                    ?>
                    <a class="dropdown-item" href="<?=$href?>"><?=$i+1?></a>
                <?php endfor; }?>
        </div>
    </div>


    <a href="<?=$hrefBase."$lastPage"?>"><button type="button" class="btn btn-light"><?=$last?></button></a>
    <a href="<?php if($next <= $newsQuantity){ echo $hrefBase."$next";}?>"><button type="button" class="btn btn-light next-button">Next</button></a>
</div>
