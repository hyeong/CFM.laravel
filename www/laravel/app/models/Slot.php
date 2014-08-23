<?php

class Slot extends GenericModel {
	protected $fillable = ['start', 'end', 'slottype_id'];

	protected $rules = [
		'start' => 'required',
		'end' => 'required',
	];
}
