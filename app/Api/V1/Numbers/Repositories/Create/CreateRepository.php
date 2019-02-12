<?php

namespace App\Api\V1\Numbers\Repositories\Create;

use App\Models\Number;
use Exception;
use App\Api\V1\Numbers\ValueObjects\NumberValue;
use App\Api\V1\Numbers\Repositories\Create\RandomNumberGenerator;
use DateTime;

class CreateRepository
{
	public function save(NumberValue $numberValue, string $deviceId)
	{
		try {
			$randomNumberGenerator = new RandomNumberGenerator(new DateTime(), mt_rand());
			$randomNumber = $randomNumberGenerator->generateNumber($numberValue);
			$number = [
				'number' => $randomNumber,
				'device_id' => $deviceId,
			];
			Number::create($number);
		} catch (Exception $e) {
			//mysql unique number
		}
	}
}