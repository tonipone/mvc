<?php

namespace App\Controllers;

use Core\{Controller, H, Session, Router};

class AuthController extends Controller{
	
	public function registerAction($id='new'){
		$this->view->errors = ['fname' => 'First name is required'];
		$this->view->render();
	}
}