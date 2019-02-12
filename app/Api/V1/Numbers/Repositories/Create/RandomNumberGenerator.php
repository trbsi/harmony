<?php

namespace App\Api\V1\Numbers\Repositories\Create;

use DateTime;
use App\Api\V1\Numbers\ValueObjects\NumberValue;

class RandomNumberGenerator
{
	private const PARAMETERS = ['lat', 'lng'];
	private $dateTime;
	private $mtRand;

	public function __construct(DateTime $dateTime, int $mtRand)
	{
		$this->dateTime = $dateTime;
		$this->mtRand = $mtRand;
	}

	public function generateNumber(NumberValue $numberValue): string
	{
		$sum = $this->generateSaltNumber();
		$singleDigitNumber = $this->generateSingleDigitNumber($sum);
		return $this->generateRealRandomNumber($numberValue, $singleDigitNumber);
	}

	private function generateRealRandomNumber(NumberValue $numberValue, int $singleDigitNumber): string
	{
		$parametersOrder = $this->calculateParametersOrder(self::PARAMETERS, 0, $singleDigitNumber, []);

		$number = '';
		foreach ($parametersOrder as $index) {
			switch (self::PARAMETERS[$index]) {
				case 'lat':
					$number = sprintf('%s%s', $number, str_replace(['.', ','], '', $numberValue->getLat()));
					break;
				case 'lng':
					$number = sprintf('%s%s', $number, str_replace(['.', ','], '', $numberValue->getLng()));
					break;
			}
		}
		
		return $number;
	}

	private function calculateParametersOrder(
		array $params,
		int $start,
		int $singleDigitNumber,
		array $parametersOrder
	): array {
		$paramsLastIndex = count($params)-1;
		$countIndex = $start-1;

		for ($i = $start; $i < $singleDigitNumber; $i++) { 
			if ($countIndex === $paramsLastIndex) {
				$countIndex = 0; 
			} else {
				$countIndex++;
			}
		}

		$parametersOrder[] = $countIndex;
		unset($params[$countIndex]);

		//check if this is last index
		if ($countIndex === $paramsLastIndex) {
			$start = $countIndex-1;
		} else {
			$start = $countIndex;
		}

		if (1 === count($params)) {
			$parametersOrder[] = key($params);
			return $parametersOrder;
		} else {
			//reset keys
			$params = array_values($params);
			return $this->calculateParametersOrder($params, $start, $singleDigitNumber, $parametersOrder);
		}
	}

	private function generateSaltNumber(): int
	{
		$salt = env('SALT', 'kovacevictrbovic');
		$saltLen = strlen($salt);
		$sumDate = $this->dateTime->format('Y')+$this->dateTime->format('m')+$this->dateTime->format('d');
		return (int) ($saltLen+$sumDate+$this->mtRand);
	}

	private function generateSingleDigitNumber(int $number): int
	{
		$split = str_split($number);
		$sum = 0; 
		for ($i = 0; $i < count($split); $i++) {
			$sum += $split[$i];
		}

		if (strlen($sum) > 1) {
			return (int) $this->generateSingleDigitNumber($sum);
		}

		return (int) $sum;
	}
}