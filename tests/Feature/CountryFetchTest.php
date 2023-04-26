<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class CountryFetchTest extends TestCase
{
	use RefreshDatabase;

	public function test_handle_method_fetches_data_from_api_and_stores_in_database()
	{
		Http::fake([
			'https://devtest.ge/countries' => Http::response([
				[
					'code' => 'US',
					'name' => 'United States',
				],
				[
					'code' => 'CA',
					'name' => 'Canada',
				],
			], 200),
		]);

		$this->artisan('fetch:CountryData');
		$this->assertDatabaseHas('countries', [
			'code' => 'US',
			'name' => json_encode('United States'),
		]);
		$this->assertDatabaseHas('countries', [
			'code' => 'CA',
			'name' => json_encode('Canada'),
		]);
	}
}
