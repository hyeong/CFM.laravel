<?php

class Talk extends GenericModel {
	protected $fillable = ['name', 'summary', 'nsfw', 'room_id', 'slot_id', 'length', 'links', 'room_locked', 'slot_locked', 'locked', 'other_presenters'];

	protected $rules = [
		'name' => 'required',
		'room_id' => 'required',
		'slot_id' => 'required',
		'length' => 'required',
	];

	public function checkFormatting()
	{
		if (is_array($this->links)) {
			$this->links = json_encode($this->links);
		}
		if (is_array($this->other_presenters)) {
			$this->other_presenters = json_encode($this->other_presenters);
		}
		return $this;
	}

}
