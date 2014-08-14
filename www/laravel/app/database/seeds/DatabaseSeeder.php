<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Defaultslot::truncate();
		Room::truncate();
		Slot::truncate();
		User::truncate();
		Talk::truncate();
		Eloquent::unguard();
		$this->call('DefaultslotsTableSeeder');
		$this->call('RoomsTableSeeder');
		$this->call('SlotsTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('TalksTableSeeder');
		// $this->call('UserTableSeeder');
	}

}
