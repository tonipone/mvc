<?php

session_start();
use \Core\Config as config;

define('PROOT',__DIR__);
define('DS',DIRECTORY_SEPARATOR);
//define('ROOT',dirname(__FILE__));

spl_autoload_register(function($className){
    $parts = explode('\\', $className);
    $class = end($parts);
    array_pop($parts);
    $path = strtolower(implode(DS, $parts));
    $path = PROOT . DS . $path . DS . $class . '.php';
    if(file_exists($path)) {
        include($path);
    }
});

$dbName = Config::get('db_name');
var_dump($dbName);