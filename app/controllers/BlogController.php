<?php

namespace App\Controllers;

use Core\Controller;

class BlogController extends Controller {

	public function indexAction(){
		$this->view->setSiteTitle('Blog');
		$this->view->render();
	}



}