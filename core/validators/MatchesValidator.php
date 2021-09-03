<?php
/**
 * Created by PhpStorm.
 * User: antonio
 * Date: 03/09/21
 * Time: 18:56
 */

namespace Core\Validators;
use Core\H;
use Core\Validators\Validator;

class MatchesValidator extends Validator{
	public function runValidation() {
		// TODO: Implement runValidation() method.
		$value = $this->_obj->{$this->field};

		return $value == $this->rule;
	}
}