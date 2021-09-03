<?php

/**
 * Created by PhpStorm.
 * User: antonio
 * Date: 03/09/21
 * Time: 16:57
 */

namespace Core\Validators;

abstract class Validator {

	public $success = true, $msg = '', $fiel, $additionalFieldData = [],$rule, $includeDeleted = false;
	protected $_obj;

	public function __construct($obj,$params) {
		$this->_obj = $obj;

		if(!array_key_exists('field',$params)){
			throw new \Exception("You must add a fields to the params array");
		}

		$this->field = $params['field'];
		if(is_array($params['field'])){
			$this->fiels = $params['field'][0];
			array_shift($params['field']);
			$this->additionalFieldData = $params['field'];
		}

		if(!property_exists($this->_obj, $this->field)){
			throw new \Exception("Thue field must exist as a property on the model object");
		}

		if(!array_key_exists('msg',$params)){
			throw new \Exception("You must add a msg to the params array");
		}
		$this->msg = $params['msg'];

		if(array_key_exists('rule',$params)){
			$this->rule = $params['rule'];
		}

		if(array_key_exists('includeDeleted',$params) && $params['includeDeleted']){
			$this->includeDeleted = true;
		}

		try {
			$this->success = $this->runValidation();
		} catch(\Exception $e) {
			echo "validation Exception on " . get_class() . ":" . $e->getMessage() . "<br />";
		}

	}

	abstract public function runValidation();

}