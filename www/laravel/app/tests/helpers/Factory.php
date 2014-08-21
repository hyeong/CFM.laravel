<?php

trait Factory {
	protected $times = 1;

	protected function times($count)
	{
		$this->times = $count;
		return $this;
	}

	protected function getStub()
	{
		throw new BadMethodCallException('You have not declared your own getStub method, but are calling for it.');
	}

	protected function make($type, array $fields = [], $unguard = false) {
		while ($this->times--) {
			$stub = array_merge($this->getStub(), $fields);
			if ($unguard) {
				Eloquent::unguard();
			}
			$type::create($stub);
		}
	}
}
