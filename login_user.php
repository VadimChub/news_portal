<?php session_start();

include 'vendor/autoload.php';

use db\db_user;

$newObj = new db_user();
$result = $newObj->loginUser($_POST['email'], $_POST['password']);

header("Location: http://".$_SERVER['HTTP_HOST']."/news_portal/index.php");


