<?php
/**
 * Created by PhpStorm.
 * User: antonio
 * Date: 09/09/21
 * Time: 17:54
 */

namespace App\Controllers;
use Core\Controller;
use App\Models\Users;
use Core\H;
use Core\Router;
use Core\Session;

class AdminController extends Controller{

	public function onConstruct(){
		$this->view->setLayout('admin');
		$this->currentUser = Users::getCurrentUser();
	}

	public function articlesAction(){
		$this->view->render();
	}

	public function usersAction(){
		$allowed = $this->currentUser->hasPermission('admin');
		if(!$allowed){
			Session::msg("You do not have access to this page");
			Router::redirect('admin/articles');
		}
		$params = ['order' => 'lname,fname'];
		$params = Users::mergeWithPagination($params);
		//H::dnd($params);
		$this->view->users = Users::find($params);
		$this->view->total = Users::findTotal($params);
		$this->view->render();
	}
}