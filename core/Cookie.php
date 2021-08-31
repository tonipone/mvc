<?php
/**
 * Created by PhpStorm.
 * User: antonio
 * Date: 31/08/21
 * Time: 09:20
 */

namespace Core;


class Cookie {

	public static function get($name){
		if(self::exists($name)){
			return $_COOKIE[$name];
		}

		return false;
	}

	public static function set($name, $value, $expiry){
		if(setcookie($name, $value, time()+$expiry, '/')){
			return true;
		}
		return false;
	}

	public static function delete($name){
		return self::set($name, '', -1);
	}

	public static function  exists($name){
		return isset($_COOKIE[$name]);
	}
}