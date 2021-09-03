<?php

namespace App\Controllers;

use Core\{Controller, H, Session, Router};
use App\Models\Users;

class AuthController extends Controller{
	
	public function registerAction($id='new'){
		if($id == 'new'){
			$user = new Users();
			//var_dump($user);
		}else{
			$user = Users::findById($id);
		}
		
		// if posted
		if($this->request->isPost()){
			H::dnd($this->request->get());
		}
		
		$this->view->user = $user;		
		//$this->view->errors = ['fname' => 'First name is required'];
		$this->view->role_options = ['' => '', Users::AUTHOR_PERMISSION => 'Author', Users::ADMIN_PERMISSION => 'Admin'];

		$this->view->errors = $user->getErrors();
		$this->view->render();
	}
}