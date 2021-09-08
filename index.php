<?php

session_start();

use \Core\{Config, Router,H};
use App\Models\Users;

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

// Check for logged in user
$currentUser = Users::getCurrentUser();
// H::dnd($currentUser);

$dbName = Config::get('db_name');

$rootDir = Config::get('root_dir');
define('ROOT',$rootDir);


$url = $_SERVER['REQUEST_URI'];
$url = str_replace(ROOT,'',$url);
$url = preg_replace('/(\?.+)/','',$url);
$currentPage = $url;

Router::route($url);


