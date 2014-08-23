<?php

use CampFireManager\Transformers\TalkTransformer;

class TalkController extends ApiController {
	public function __construct(Talk $Talk, TalkTransformer $TalkTransformer) {
		$this->model = $Talk;
		$this->transformer = $TalkTransformer;
		$this->beforeFilter('auth.basic', ['on' => 'post']);
	}
}
