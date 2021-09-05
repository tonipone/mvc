<?php

namespace Core;



// use App\Controllers\BlogController;


class Router {
	public static function route($url){
		$urlParts = explode('/',$url);

		// set controller
		$controller = !empty($urlParts[0])? $urlParts[0] : Config::get('default_controller');
		$controllerName = $controller;
		
		
		$controller = '\App\Controllers\\' . ucwords($controller). 'Controller';

		
		//set action
		array_shift($urlParts);
		$action = !empty($urlParts[0])? $urlParts[0] : 'index';
		$actionName = $action;
		$action .= 'Action';
		array_shift($urlParts);


		if(!class_exists($controller)){
			// throw new \Exception('Error');
			echo($controller." - Not Exist");
		}
		$controllerClass = new $controller($controllerName,$actionName);

		if(!method_exists($controllerClass,$action)){
			echo($action." - Not Exist");
		}
		call_user_func_array([$controllerClass,$action],$urlParts);
		//var_dump($controllerClass);
	}
	
	public static function redirect($location){
		if(!headers_sent()) {
            header('Location: ' . ROOT . $location);
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href = "'. ROOT . $location .'"';
            echo '</script>';
            echo '<nosript>';
            echo '<meta http-equiv="refresh" content="0;url=' . ROOT . $location . '" />';
            echo '</nosript>';
        }
        exit();
		
	}
}