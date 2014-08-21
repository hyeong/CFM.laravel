<?php

class TalkTest extends ApiTester {
	use Factory;

	/** @test */
	public function it_fetches_talks() {
		// arrange
		$this->times(5)->make('Talk', [], true);

		// act
		$this->getJson('api/v1/talks'); // This is the routing URL 

		// assert
		$this->assertResponseOk();
	}


	/** @test */
	public function it_fetches_a_single_talk() {
		// arrange
		$this->make('Talk', [], true);

		// act
		$talk = $this->getJson('api/v1/talks/1')->data; // This is the routing URL 

		// assert
		$this->assertResponseOk();
		$this->assertObjectHasAttributes($talk, 'id', 'name', 'summary', 'nsfw', 'user_id', 'room_id', 'slot_id', 'length', 'links', 'room_locked', 'slot_locked', 'locked', 'other_presenters');
	}

	/** @test */
	public function it_404s_if_a_talk_is_not_found()
	{
		$json = $this->getJson('api/v1/talks/x'); // ID should be an integer
		$this->assertResponseStatus(404);
		$this->assertObjectHasAttributes($json, 'error');
	}

	/** @test */
	public function it_creates_a_new_talk_given_valid_parameters()
	{
		$talk = $this->getJson('api/v1/talks', 'POST', $this->getStub());
		$this->assertResponseStatus(201);
		$this->assertObjectHasAttributes($talk, 'id', 'name', 'summary', 'nsfw', 'user_id', 'room_id', 'slot_id', 'length', 'links', 'room_locked', 'slot_locked', 'locked', 'other_presenters');
		$this->assertTrue($talk->id == 1);
	}

	/** @test */
	public function it_throws_a_422_if_a_new_talk_fails_validation()
	{
		$this->getJson('api/v1/talks', 'POST');
		$this->assertResponseStatus(422);
	}

	protected function getStub()
	{
		$userIds = [1,2,3,4,5];
		$roomIds = [1,2,3,4,5];
		$slotIds = [1,2,3,4,5];
		return [
			'name'             => $this->fake->sentence,
			'summary'          => $this->fake->paragraph,
			'nsfw'             => $this->fake->boolean,
			'user_id'          => $this->fake->randomElement($userIds),
			'room_id'          => $this->fake->randomElement($roomIds),
			'slot_id'          => $this->fake->randomElement($slotIds),
			'length'           => $this->fake->numberBetween(1, 3),
			'links'            => json_encode([]),
			'room_locked'      => $this->fake->boolean,
			'slot_locked'      => $this->fake->boolean,
			'locked'           => $this->fake->boolean,
			'other_presenters' => json_encode([])
		];
	}
}

