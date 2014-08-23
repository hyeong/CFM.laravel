<?php namespace CampFireManager\Transformers;

class DefaultslotTransformer extends Transformer {
	public function transform($defaultslot)
	{
		return [
			"id"	=> (integer) $defaultslot['id'],
			"name"	=> $defaultslot['name'],
			"lock"	=> $defaultslot['lock'],
		];
	}
}
