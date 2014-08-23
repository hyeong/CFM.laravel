<?php

class SlotTest extends ApiTester {
	use Factory;

	/** @test */
	public function it_fetches_slots() {
		// arrange
		$this->times(5)->make('Slot', [], true);

		// act
		$this->getJson('api/v1/slots'); // This is the routing URL 

		// assert
		$this->assertResponseOk();
	}


	/** @test */
	public function it_fetches_a_single_slot() {
		// arrange
		$this->make('Slot', [], true);

		// act
		$slot = $this->getJson('api/v1/slots/1')->data; // This is the routing URL 

		// assert
		$this->assertResponseOk();
		$this->assertObjectHasAttributes($slot, 'id', 'start', 'end', 'slottype_id');
	}

	/** @test */
	public function it_404s_if_a_slot_is_not_found()
	{
		$json = $this->getJson('api/v1/slots/x'); // ID should be an integer
		$this->assertResponseStatus(404);
		$this->assertObjectHasAttributes($json, 'error');
	}

	/** @test */
	public function it_creates_a_new_slot_given_valid_parameters()
	{
		$slot = $this->getJson('api/v1/slots', 'POST', $this->getStub());
		$this->assertResponseStatus(201);
		$this->assertObjectHasAttributes($slot, 'id', 'start', 'end', 'slottype_id');
		$this->assertTrue($slot->id == 1);
	}

	/** @test */
	public function it_throws_a_422_if_a_new_slot_fails_validation()
	{
		$this->getJson('api/v1/slots', 'POST');
		$this->assertResponseStatus(422);
	}

	protected function getStub()
	{
		$start = $this->fake->unique()->numberBetween(0,144);
		if ($start % 2 === 0) {
			$start_time = $start / 2; # Number of hours since 00:00:00 today
			$minutes = 0;
		} else {
			$start_time = ($start - 1) /2;
			$minutes = 30;
		}
		$date_start = new DateTime("Today 00:00:00");
		$date_start->add(new DateInterval("PT" . $start_time . "H" . $minutes . "M"));
		$date_end = new DateTime($date_start->format("Y-m-d H:i:s"));
		$date_end->add(new DateInterval("PT30M"));
		return [
			'start'		=> $date_start,
			'end'		=> $date_end,
			'slottype_id'	=> $this->fake->numberBetween(0, 8),
		];
	}
}

