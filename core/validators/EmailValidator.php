<?php
/**
 * Created by PhpStorm.
 * User: antonio
 * Date: 03/09/21
 * Time: 18:48
 */

namespace Core\Validators;
use Core\Validators\Validator;

class EmailValidator extends Validator {

	public function runValidation() {
		// TODO: Implement runValidation() method.
		$email = $this->_obj->{$this->field};
		$pass = true;
		if(!empty($email)){
			$pass = filter_var($email, FILTER_VALIDATE_EMAIL);
		}
		return $pass;
	}
}