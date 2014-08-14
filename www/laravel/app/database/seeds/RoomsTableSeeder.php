<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RoomsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 5) as $index)
		{
			Room::create([
				'name' => $faker->sentence(4),
				'capacity' => $faker->numberBetween(3, 100) * 5,
				'locked' => $faker->boolean()
			]);
		}
	}

}
