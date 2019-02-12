<?php

namespace App\Api\V1\Numbers\ValueObjects;

class NumberValue 
{
	private $lat;
	private $lng;

	public function __construct(
		float $lat,
		float $lng
	) {
		$this->lat = $lat;
		$this->lng = $lng;
	}

	public function getLat()
	{
		return $this->lat;
	}

	public function getLng()
	{
		return $this->lng;
	}
}