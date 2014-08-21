<?php

abstract class GenericModel extends \Eloquent {

	protected $rules = [];

	protected $errors = [];

	public function getErrors()
	{
		return $this->errors;
	}

	public function isValid()
	{
		$validation = Validator::make($this->attributes, $this->rules);

		if ($validation->passes()) {
			return true;
		}

		$this->errors = $validation->messages();

		return false;
	}


}
