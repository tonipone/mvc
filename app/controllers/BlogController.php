<?php

namespace App\Controllers;

use Core\{DB,Controller,H};

class BlogController extends Controller {

	public function indexAction(){
		
		$db = DB::getInstance();
		/*$sql = "INSERT INTO articles (title , body) VALUES (:title, :body)";
		$bind = ['title' => 'Nuovo Articolo', 'body' => 'Contenuto Articolo'];
		$query = $db->query($sql,$bind);
		$lastId = $query->lastInsertId();*/
		//$db->insert('articles',['title' => 'Article 1','body'=>'Contenuto 1']);
		//$db->update('articles',['title' => 'Article Up','body'=>'Contenuto Up'],['id' => '12']);
		// H::dnd($lastId);

		/*$sql = "SELECT * FROM articles";
		$query = $db->query($sql);
		$articles = $query->results();
		$count = $query->count();
		$lastInId = $query->lastInsertId();
		H::dnd($lastInId);*/

		$this->view->setSiteTitle('Blog');
		$this->view->render();
	}



}