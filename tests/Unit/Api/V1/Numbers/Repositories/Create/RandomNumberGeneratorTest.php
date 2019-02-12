<?php

namespace Tests\Unit\Api\V1\Numbers\Repositories\Create;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use DateTime;
use App\Api\V1\Numbers\ValueObjects\NumberValue;
use App\Api\V1\Numbers\Repositories\Create\RandomNumberGenerator;

class RandomNumberGeneratorTest extends TestCase
{
	private $datetime;

	public function setUp()
	{
		parent::setUp();
		$this->datetime = $this->prophesize(DateTime::class);
		$this->numberValue = new NumberValue('11.22222', '33.44444');
	}

	public function tearDown()
	{
		parent::tearDown();
		$this->datetime = null;
		$this->numberValue = null;
	}

    public function testGenerateRandomNumberTestOne()
    {
        $this->datetime
        	->format('Y')
        	->shouldBeCalledOnce()
        	->willReturn(1991);
        	
        $this->datetime
        	->format('m')
        	->shouldBeCalledOnce()
        	->willReturn(12);
        	
        $this->datetime
        	->format('d')
        	->shouldBeCalledOnce()
        	->willReturn(29);

        $randomNumberGenerator = new RandomNumberGenerator($this->datetime->reveal(), 12345);
        $randomNumber = $randomNumberGenerator->generateNumber($this->numberValue);	
       	$this->assertEquals('33444441122222', $randomNumber);
    }

    public function testGenerateRandomNumberTestTwo()
    {
        $this->datetime
        	->format('Y')
        	->shouldBeCalledOnce()
        	->willReturn(1991);
        	
        $this->datetime
        	->format('m')
        	->shouldBeCalledOnce()
        	->willReturn(12);
        	
        $this->datetime
        	->format('d')
        	->shouldBeCalledOnce()
        	->willReturn(29);

        $randomNumberGenerator = new RandomNumberGenerator($this->datetime->reveal(), 666);
        $randomNumber = $randomNumberGenerator->generateNumber($this->numberValue);	
       	$this->assertEquals('11222223344444', $randomNumber);
    }
}
