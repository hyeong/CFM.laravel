<?php

use CampFireManager\Transformers\SlotTransformer;

class SlotController extends ApiController {
	public function __construct(Slot $Slot, SlotTransformer $SlotTransformer) {
		$this->model = $Slot;
		$this->transformer = $SlotTransformer;
		$this->beforeFilter('auth.basic', ['on' => 'post']);
	}

}
