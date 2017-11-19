<?php

namespace helpers;
require '../vendor/autoload.php';
use db\db;
use db\db_settings;

$object = new db_settings();
$mode = $_POST['mode'];

$object->setNavMode($mode);



