<?php
namespace helpers;
require '../vendor/autoload.php';
use db\db;

$views = $_POST['views'];
$id = $_POST['id'];

if($views){
    $obj = new db();
    $connection = $obj->getConnection();

    $query = $connection->query("SELECT views FROM news WHERE id = {$id}");
    $query->setFetchMode(2);
    $queryArray = $query->fetch();

    $newVal = $queryArray['views']+$views;
    $connection->query("UPDATE news SET views = '$newVal' WHERE id = '$id'");

    echo $queryArray['views'];
}