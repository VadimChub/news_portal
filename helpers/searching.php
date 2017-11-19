<?php

namespace helpers;

include '../vendor/autoload.php';

use db\db_news;

//поиск по тэгам %like%

$search = $_POST['search'];

$workObject = new db_news();

$askedArray = $workObject->searchingInTags($search);
$some = "";
foreach ($askedArray as $item){
  $some .=  "<option class='option-tempor' value='$item'>";
}
echo $some;


