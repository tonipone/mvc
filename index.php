<?php

session_start();

use \Core\Config;

define('PROOT',__DIR__);
define('DS',DIRECTORY_SEPARATOR);
include('core/Config.php');
//define('ROOT',dirname(__FILE__));
$ver = Config::get('version');
var_dump($ver);