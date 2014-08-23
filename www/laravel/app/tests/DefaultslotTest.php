<?php

class DefaultslotTest extends ApiTester {
	use Factory;

	/** @test */
	public function it_fetches_defaultslots() {
		// arrange
		$this->times(5)->make('Defaultslot', [], true);

		// act
		$this->getJson('api/v1/defaultslots'); // This is the routing URL 

		// assert
		$this->assertResponseOk();
	}


	/** @test */
	public function it_fetches_a_single_defaultslot() {
		// arrange
		$this->times(5)->make('Defaultslot', [], true);

		// act
		$defaultslot = $this->getJson('api/v1/defaultslots/1')->data; // This is the routing URL 

		// assert
		$this->assertResponseOk();
		$this->assertObjectHasAttributes($defaultslot, 'id', 'name', 'lock');
	}

	/** @test */
	public function it_404s_if_a_defaultslot_is_not_found()
	{
		$json = $this->getJson('api/v1/defaultslots/x'); // ID should be an integer
		$this->assertResponseStatus(404);
		$this->assertObjectHasAttributes($json, 'error');
	}

	/** @test */
	public function it_creates_a_new_defaultslot_given_valid_parameters()
	{
		$defaultslot = $this->getJson('api/v1/defaultslots', 'POST', $this->getStub());
		$this->assertResponseStatus(201);
		$this->assertObjectHasAttributes($defaultslot, 'id', 'name', 'lock');
		$this->assertTrue($defaultslot->id == 1);
	}

	/** @test */
	public function it_throws_a_422_if_a_new_defaultslot_fails_validation()
	{
		$this->getJson('api/v1/defaultslots', 'POST');
		$this->assertResponseStatus(422);
	}

	protected function getStub()
	{
		$locks = ['hard', 'soft', 'none'];
		return [
			'name' => $this->fake->sentence,
			'lock' => $this->fake->randomElement($locks),
		];
	}
}

