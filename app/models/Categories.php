<?php
/**
 * Created by PhpStorm.
 * User: antonio
 * Date: 13/09/21
 * Time: 08:52
 */

namespace App\Models;
use Core\Model;
use Core\Validators\{RequiredValidator, UniqueValidator};

class Categories extends Model{
	protected static $table = 'categories';
	public $id, $name;

	public function beforeSave(){
		$this->runValidation(new RequiredValidator($this,['field' => 'name', 'msg' => 'Name is a required field.']));
		$this->runValidation(new UniqueValidator($this,['field' => 'name', 'msg' => 'That category already exixtes.']));
	}

	public static function findAllWithArticles(){
		$params = [
			'columns' => 'categories.*',
			'conditions' => "articles.status = 'public'",
			'joins' => [
				['articles', 'articles.category_id = categories.id']
			],
			'group' => 'categories.id',
			'order' => 'categories.name'
		];

		return self::find($params);
	}
}