<?php session_start();

include 'vendor/autoload.php';

use db\db_user;

$newObj = new db_user();
$newObj->logOut();

header("Location: http://".$_SERVER['HTTP_HOST']."/news_portal/index.php");

