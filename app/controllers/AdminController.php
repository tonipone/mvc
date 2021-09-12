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
		Router::permRedirect(['author','admin'],'blog/index');
		$this->view->render();
	}

	public function usersAction(){
		Router::permRedirect('admin', 'admin/articles');
		$params = ['order' => 'lname,fname'];
		$params = Users::mergeWithPagination($params);
		//H::dnd($params);
		$this->view->users = Users::find($params);
		$this->view->total = Users::findTotal($params);
		$this->view->render();
	}

	public function togleBlockUserAction($userId){
		Router::permRedirect('admin','admin/articles');
		$user = Users::findById($userId);
		if($user) {
			$user->blocked = $user->blocked ? 0 : 1;
			$user->save();
			$msg = $user->blocked ? "User blocked" : "User unblocked";
		}
		Session::msg($msg, 'success');
		Router::redirect('admin/users');
	}

	public function deleteUserAction($userId){
		Router::permRedirect('admin','admin/articles');
		$msgType = 'danger';
		$msg = 'User cannot be deleted';
		$user = Users::findById($userId);
		if($user && $user->id !== Users::getCurrentUser()->id){
			$user->delete();
			$msgType = 'success';
			$msg = 'User Deleted';
		}
		Session::msg($msg,$msgType);
		Router::redirect('admin/users');
	}
}