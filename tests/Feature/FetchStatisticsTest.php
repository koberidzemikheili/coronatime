<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FetchStatisticsTest extends TestCase
{
	use RefreshDatabase;

	public function testFetchStatistics()
	{
		Http::fake([
			'devtest.ge/get-country-statistics' => Http::response([
				'code'         => 'US',
				'country_name' => '{"en": "United States","ka": "United States"}',
				'confirmed'    => 1000,
				'recovered'    => 500,
				'deaths'       => 100,
				'critical'     => 50,
				'created_at'   => '2023-04-26 10:00:00',
				'updated_at'   => '2023-04-26 10:00:00',
			], 200),
		]);

		$country = new Country();
		$country->code = 'US';
		$country->name = json_encode(['en' => 'United States', 'ka' => 'ამერიკის შეერთდიანებული შტატები']);
		$country->save();

		$this->artisan('fetch:statistics');

		$this->assertDatabaseHas('statistics', [
			'country_code'         => 'US',
			'country_name'         => $country->name,
			'confirmed'            => 1000,
			'recovered'            => 500,
			'deaths'               => 100,
			'critical'             => 50,
			'created_at'           => '2023-04-26 10:00:00',
			'updated_at'           => '2023-04-26 10:00:00',
		]);
	}
}
