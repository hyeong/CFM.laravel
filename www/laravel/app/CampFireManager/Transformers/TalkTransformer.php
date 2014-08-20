<?php namespace CampFireManager\Transformers;

class TalkTransformer extends Transformer {
	public function transform($talk)
	{
		return [
			"intTalkID"		=> (integer) $talk['id'],
			"strTalkTitle"		=> $talk['name'],
			"strTalkDescription"	=> $talk['summary'],
			"intSlotID"		=> (integer) $talk['slot_id'],
			"intRoomID"		=> (integer) $talk['room_id'],
			"intProposer"		=> (integer) $talk['user_id'],
			"arrLinks"		=> $talk['links'],
		];
	}
}
