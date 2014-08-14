<?php

class DefaultslotsTableSeeder extends Seeder {

	public function run()
	{
		Defaultslot::create([
			'name' => 'Opening Keynote',
			'lock' => 'hard'
		]); // ID 1
		Defaultslot::create([
			'name' => 'Morning Break',
			'lock' => 'none'
		]); // ID 2
		Defaultslot::create([
			'name' => 'Lunch',
			'lock' => 'soft'
		]); // ID 3
		Defaultslot::create([
			'name' => 'Afternoon Break',
			'lock' => 'none'
		]); // ID 4
		Defaultslot::create([
			'name' => 'Tea Time',
			'lock' => 'none'
		]); // ID 5
		Defaultslot::create([
			'name' => 'Closing Keynote',
			'lock' => 'hard'
		]); // ID 6
		Defaultslot::create([
			'name' => 'Close Down and Tidy Up',
			'lock' => 'hard'
		]); // ID 7
	}

}
