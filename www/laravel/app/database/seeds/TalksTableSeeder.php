<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TalksTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$userIds = User::lists('id');
		$roomIds = Room::lists('id');
		$slotIds = Slot::lists('id');


		foreach(range(1, 10) as $index)
		{
			$json = array();
			if ($faker->boolean()) {
				$json['twitter'] = $faker->username();
			}
			if ($faker->boolean()) {
				$json['email'] = $faker->email();
			}
			if ($faker->boolean()) {
				$json['blog'] = $faker->url();
			}
			if ($faker->boolean()) {
				$json['facebook'] = $faker->username();
			}
			if ($faker->boolean()) {
				if ($faker->boolean()) {
					$json['plus'] = "https://plus.google.com/" . $faker->randomNumber($faker->numberBetween(5, 9));
				} else {
					$json['plus'] = "https://plus.google.com/+" . $faker->username();
				}
			}
			$presenters = array();
			if ($faker->boolean()) {
				$presenters = $faker->randomElements($userIds, $faker->numberBetween(0, count($userIds) >= 5 ? 5 : count($userIds)));
			}
			Talk::create([
				'name'             => $faker->sentence($faker->numberBetween(3, 10)),
				'summary'          => $faker->paragraph(),
				'nsfw'             => $faker->boolean(),
				'user_id'          => $faker->randomElement($userIds),
				'room_id'          => $faker->randomElement($roomIds),
				'slot_id'          => $faker->randomElement($slotIds),
				'length'           => $faker->numberBetween(1, 3),
				'links'            => json_encode($json),
				'room_locked'      => $faker->boolean(),
				'slot_locked'      => $faker->boolean(),
				'locked'           => $faker->boolean(),
				'other_presenters' => json_encode($presenters)
			]);
		}
	}

}
