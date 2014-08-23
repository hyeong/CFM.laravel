<?php namespace CampFireManager\Transformers;

class SlotTransformer extends Transformer {
	public function transform($slot)
	{
		if (!is_object($slot['start'])) {
			$start = new \DateTime($slot['start']);
			$end = new \DateTime((string) $slot['end']);
		} else {
			$start = $slot['start'];
			$end = $slot['end'];
		}
		return [
			"id"		=> (integer) $slot['id'],
			"start"		=> $start->format(\DateTime::ATOM),
			"end"		=> $end->format(\DateTime::ATOM),
			"slottype_id"	=> (integer) $slot['slottype_id'],
		];
	}
}
