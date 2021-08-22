<?php

namespace App\Controllers;

use Core\Controller;

class BlogController extends Controller {

	public function indexAction(){
		die("You made it to the index action {}");
	}

	public function fooAction(){
		die("You made it to the foo action");
	}

}