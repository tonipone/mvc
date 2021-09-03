<?php

/**
 * Created by PhpStorm.
 * User: antonio
 * Date: 03/09/21
 * Time: 16:58
 */
namespace Core\Validators;
use Core\Validators\Validator;

class RequiredValidator extends Validator {
	public function runValidation() {
		$value = trim($this->_obj->{$this->field});
		$passes = $value != '' && isset($value);
		return $passes;
	}
}
