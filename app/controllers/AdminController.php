<?php
/**
 * Created by PhpStorm.
 * User: antonio
 * Date: 09/09/21
 * Time: 17:54
 */

namespace App\Controllers;
use App\Models\Categories;
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

	public function categoriesAction(){
		Router::permRedirect(['admin'],'blog/index');
		$params = ['order' => 'name'];
		$params = Categories::mergeWithPagination($params);
		$this->view->categories = Categories::find($params);
		$this->view->total = Categories::findTotal($params);
		$this->view->render();
	}

	public function categoryAction($id = 'new'){
		Router::permRedirect('admin', 'admin/articles');
		$category = $id == 'new' ? new Categories() : Categories::findById($id);
		if(!$category){
			Session::msg("Category does not exists.");
			Router::redirect('admin/categories');
		}

		if($this->request->isPost()){
			Session::csrfCheck();
			$category->name = $this->request->get('name');
			if($category->save()){
				Session::msg("Category Saved", 'success');
				Router::redirect('admin/categories');
			}
		}

		$this->view->category = $category;
		$this->view->heading = $id == 'new' ? "Add Category" : "Edit Category" ;
		$this->view->errors = $category->getErrors();
		$this->view->render();
	}

	public function deleteCategoryAction($id){
		Router::permRedirect('admin','admin/articles');
		//$msgType = 'danger';
		//$msg = 'User cannot be deleted';
		$category = Categories::findById($id);
		if(!$category){
			Session::msg("That category does not exists.");
			Router::redirect('admin/categories');
		}else{
			$category->delete();
			Session::msg("category Deleted.","success");
			Router::redirect('admin/categories');
		}
	}
}