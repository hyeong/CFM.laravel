<?php

class Defaultslot extends GenericModel {
	protected $fillable = ['name', 'lock'];

	protected $rules = [
		'name' => 'required',
		'lock' => 'required',
	];
}
