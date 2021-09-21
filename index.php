<?php

session_start();

use \Core\{Config, Router,H};
use App\Models\Users;
use Symfony\Component\Dotenv\Dotenv ;

define('PROOT',__DIR__);
define('DS',DIRECTORY_SEPARATOR);

//define('ROOT',dirname(__FILE__));

require_once(PROOT . DS . 'lib/dotenv/Dotenv.php');


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

//load .env file
$dotenv = new Dotenv();
$dotenv->load(PROOT . DS . '.env');
// Check for logged in user
$currentUser = Users::getCurrentUser();


//H::dnd($_ENV);

$dbName = Config::get('db_name');

$rootDir = Config::get('root_dir');
define('ROOT',$rootDir);


$url = $_SERVER['REQUEST_URI'];
if(ROOT != '/'){
	$url = str_replace(ROOT,'',$url);
}else{
	$url = ltrim($url,'/');
}
$url = preg_replace('/(\?.+)/','',$url);
$currentPage = $url;

Router::route($url);


