<?php

namespace Tests\Unit\Api\V1\Numbers\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class NumbersControllerTest extends TestCase
{
    use RefreshDatabase;

	public function setUp()
	{
		parent::setUp();
	}

	public function tearDown()
	{
		parent::tearDown();
	}

    public function testUnauthorized()
    {
        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])
        ->post('/api/system/v1/numbers',
        [
            'lat' => '11.22222',
            'lat' => '33.44444',
            'device_id' => 'qqq222www',
        ]);

        $response->assertStatus(401);
    }

    public function testSuccessfullySaveNumber()
    {
        $user = factory(User::class)->create();

        $response = $this
        ->actingAs($user, 'api')
        ->withHeaders([
            'Accept' => 'application/json',
        ])
        ->json('POST', '/api/system/v1/numbers',
        [
            'lat' => '99.88888',
            'lng' => '66.77777',
            'device_id' => 'qqq222www',
        ]);

        $response->assertStatus(204);

         $this->assertDatabaseHas('numbers', [
            'device_id' => 'qqq222www'
        ]);
    }
}
