<?php
use Faker\Factory as Faker;

abstract class ApiTester extends TestCase {

	protected $fake;

	function __construct()
	{
		$this->fake = Faker::create();
	}

	function setUp()
	{
		parent::setUp();
		$this->app['artisan']->call('migrate'); // Load the database into the sqlite
	}

	protected function getJson($uri, $method = 'GET', $parameters = [])
	{
		return json_decode($this->call($method, $uri, $parameters)->getContent());
	}

	protected function assertObjectHasAttributes()
	{
		$args = func_get_args();
		$object = array_shift($args); // We shift the args up by one, which means the first item goes into $object.
		foreach($args as $attribute)
		{
			$this->assertObjectHasAttribute($attribute, $object);
		}
	}
}

