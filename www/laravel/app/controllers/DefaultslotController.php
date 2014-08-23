<?php

use CampFireManager\Transformers\DefaultslotTransformer;

class DefaultslotController extends ApiController {
	public function __construct(Defaultslot $Defaultslot, DefaultslotTransformer $DefaultslotTransformer) {
		$this->model = $Defaultslot;
		$this->transformer = $DefaultslotTransformer;
		$this->beforeFilter('auth.basic', ['on' => 'post']);
	}
}
