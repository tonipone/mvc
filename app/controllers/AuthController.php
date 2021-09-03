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
			Session::csrfCheck();
			//H::dnd($this->request->get());
			$fields = ['fname','lname','email','acl','password','confirm'];
			foreach ( $fields as $field ) {
				$user->{$field} = $this->request->get($field);
			}
			$user->save();
		}
		
		$this->view->user = $user;		
		//$this->view->errors = ['fname' => 'First name is required'];
		$this->view->role_options = ['' => '', Users::AUTHOR_PERMISSION => 'Author', Users::ADMIN_PERMISSION => 'Admin'];

		$this->view->errors = $user->getErrors();
		$this->view->render();
	}
}