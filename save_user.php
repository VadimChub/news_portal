<?php

include 'vendor/autoload.php';

use db\db_user;

$obj = new db_user();

$result = $obj->saveUser($_POST['name'], $_POST['password'], $_POST['email']);

if ($result){
    header("Location: http://".$_SERVER['HTTP_HOST']."/news_portal/index.php");
} else {
    header("Location: http://".$_SERVER['HTTP_HOST']."/news_portal/registration.php");
}