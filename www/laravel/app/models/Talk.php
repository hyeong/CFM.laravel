<?php

class Talk extends \Eloquent {
	protected $fillable = ['name', 'summary', 'nsfw', 'user_id', 'room_id', 'slot_id', 'length', 'links', 'room_locked', 'slot_locked', 'locked', 'other_presenters'];
}
