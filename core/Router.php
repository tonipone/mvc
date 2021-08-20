<?php

namespace Core;

use App\Controllers\BlogController;

class Router {
	public static function route($url){
		//var_dump($url);
		$controller = new BlogController('Blog','indexAction');


	}
}