<?php

class Slot extends GenericModel {
	protected $fillable = ['start', 'end', 'slottype_id'];

	protected $rules = [
		'start' => 'required',
		'end' => 'required',
	];

	// As found http://stackoverflow.com/a/20621344/5738
	// Note, if your construct function needs to change
	// the attributes, use 
	// public function __construct(array $attributes = array())
	// {
	// $this->setRawAttributes(
	//	array_merge(
	//		$this->attributes,
	//		['my' => 'thing']
	//	), true);
	// parent::construct($attributes);
	// }
	protected $attributes = array (
		'slottype_id' => 0
	);
}
