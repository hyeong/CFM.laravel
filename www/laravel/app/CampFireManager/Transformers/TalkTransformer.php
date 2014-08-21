<?php namespace CampFireManager\Transformers;

class TalkTransformer extends Transformer {
	public function transform($talk)
	{
		return [
			"id"			=> (integer) $talk['id'],
			"name"			=> $talk['name'],
			"summary"		=> $talk['summary'],
			"slot_id"		=> (integer) $talk['slot_id'],
			"room_id"		=> (integer) $talk['room_id'],
			"user_id"		=> (integer) $talk['user_id'],
			"links"			=> json_decode($talk['links']),
			"length"		=> (integer) $talk['length'],
			"nsfw"			=> (boolean) $talk['nsfw'],
			"locked"		=> (boolean) $talk['locked'],
			"slot_locked"		=> (boolean) $talk['slot_locked'],
			"room_locked"		=> (boolean) $talk['room_locked'],
			"other_presenters"	=> json_decode($talk['other_presenters']),
		];
	}
}
