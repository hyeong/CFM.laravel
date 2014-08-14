<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTalksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('talks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('summary');
			$table->boolean('nsfw');
			$table->integer('user_id');
			$table->integer('room_id');
			$table->integer('slot_id');
			$table->integer('length');
			$table->text('links');
			$table->boolean('room_locked');
			$table->boolean('slot_locked');
			$table->boolean('locked');
			$table->text('other_presenters');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('talks');
	}

}
