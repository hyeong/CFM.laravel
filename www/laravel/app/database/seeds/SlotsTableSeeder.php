<?php

class SlotsTableSeeder extends Seeder {

	public function run()
	{
		Slot::create([
			'start' => new \DateTime('Today 09:00:00'),
			'end' => new \DateTime('Today 09:25:00'),
			'slottype_id' => 1
		]);
		Slot::create([
			'start' => new \DateTime('Today 09:30:00'),
			'end' => new \DateTime('Today 09:55:00'),
			'slottype_id' => 0
		]);
		Slot::create([
			'start' => new \DateTime('Today 10:00:00'),
			'end' => new \DateTime('Today 10:25:00'),
			'slottype_id' => 0
		]);
		Slot::create([
			'start' => new \DateTime('Today 10:30:00'),
			'end' => new \DateTime('Today 10:55:00'),
			'slottype_id' => 2
		]);
		Slot::create([
			'start' => new \DateTime('Today 11:00:00'),
			'end' => new \DateTime('Today 11:25:00'),
			'slottype_id' => 0
		]);
		Slot::create([
			'start' => new \DateTime('Today 11:30:00'),
			'end' => new \DateTime('Today 11:55:00'),
			'slottype_id' => 0
		]);
		Slot::create([
			'start' => new \DateTime('Today 12:00:00'),
			'end' => new \DateTime('Today 12:25:00'),
			'slottype_id' => 3
		]);
		Slot::create([
			'start' => new \DateTime('Today 12:30:00'),
			'end' => new \DateTime('Today 12:55:00'),
			'slottype_id' => 3
		]);
		Slot::create([
			'start' => new \DateTime('Today 13:00:00'),
			'end' => new \DateTime('Today 13:25:00'),
			'slottype_id' => 0
		]);
		Slot::create([
			'start' => new \DateTime('Today 13:30:00'),
			'end' => new \DateTime('Today 13:55:00'),
			'slottype_id' => 0
		]);
		Slot::create([
			'start' => new \DateTime('Today 14:00:00'),
			'end' => new \DateTime('Today 14:25:00'),
			'slottype_id' => 4
		]);
		Slot::create([
			'start' => new \DateTime('Today 14:30:00'),
			'end' => new \DateTime('Today 14:55:00'),
			'slottype_id' => 0
		]);
		Slot::create([
			'start' => new \DateTime('Today 15:00:00'),
			'end' => new \DateTime('Today 15:25:00'),
			'slottype_id' => 0
		]);
		Slot::create([
			'start' => new \DateTime('Today 15:30:00'),
			'end' => new \DateTime('Today 15:55:00'),
			'slottype_id' => 5
		]);
		Slot::create([
			'start' => new \DateTime('Today 16:00:00'),
			'end' => new \DateTime('Today 16:25:00'),
			'slottype_id' => 0
		]);
		Slot::create([
			'start' => new \DateTime('Today 16:30:00'),
			'end' => new \DateTime('Today 16:55:00'),
			'slottype_id' => 0
		]);
		Slot::create([
			'start' => new \DateTime('Today 17:00:00'),
			'end' => new \DateTime('Today 17:25:00'),
			'slottype_id' => 6
		]);
		Slot::create([
			'start' => new \DateTime('Today 17:30:00'),
			'end' => new \DateTime('Today 17:55:00'),
			'slottype_id' => 7
		]);
	}

}
