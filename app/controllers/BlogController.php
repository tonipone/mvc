<?php

namespace App\Controllers;

use Core\{DB,Controller,H};

class BlogController extends Controller {

	public function indexAction(){
		$db = DB::getInstance();
		H::dnd($db,false);
		$this->view->setSiteTitle('Blog');
		$this->view->render();
	}



}