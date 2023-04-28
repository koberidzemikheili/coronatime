<?php

namespace Tests\Feature;

use App\Http\Controllers\StatisticController;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
	use RefreshDatabase;

	private User $user;

	protected function setUp(): void
	{
		parent::setUp();
		$this->user = User::factory()->create();
	}

	public function test_redirect_to_login_page_if_not_authorized_on_visiting_landing_page(): Void
	{
		$response = $this->get(route('landing'));
		$response->assertRedirect(route('login.view'));
	}

	public function test_redirect_to_login_page_if_not_authorized_on_visiting_bycountry_page(): Void
	{
		$response = $this->get(route('bycountry'));
		$response->assertRedirect(route('login.view'));
	}

	public function test_landing_is_reachable_for_auth_users(): Void
	{
		$response = $this->actingAs($this->user)->get(route('landing'));
		$response->assertSuccessful();
		Statistic::factory()->count(3)->create([
			'confirmed' => 10,
			'deaths'    => 2,
			'recovered' => 6,
		]);
		(new StatisticController())->sum();
		$response->assertViewIs('worldwide-content');
		$response = $this->actingAs($this->user)->get(route('landing'));
		$response->assertStatus(200);
		$response->assertViewHas('sums', [
			'confirmed_sum' => 30,
			'deaths_sum'    => 6,
			'recovered_sum' => 18,
		]);
	}

	public function test_bycountry_is_reachable_for_auth_users(): Void
	{
		$response = $this->actingAs($this->user)->get(route('bycountry'));
		$response->assertSuccessful();
	}

	public function testIndex()
	{
		$this->actingAs($this->user);

		Statistic::Factory(10)->create();

		$response = $this->get(route('bycountry'), [
			'search'    => 'search-value',
			'sort'      => 'country_name',
			'direction' => 'asc',
		]);

		$response->assertStatus(200);

		$response->assertViewIs('bycountry-content');

		$response->assertViewHas('statistics');
	}

	public function testSum(): Void
	{
		Statistic::factory()->count(3)->create([
			'confirmed' => 10,
			'deaths'    => 2,
			'recovered' => 6,
		]);

		$result = (new StatisticController())->sum();

		$this->assertEquals(30, $result['confirmed_sum']);
		$this->assertEquals(6, $result['deaths_sum']);
		$this->assertEquals(18, $result['recovered_sum']);
	}

	public function testSearch(): Void
	{
		Statistic::factory()->create([
			'country_name' => 'Georgia',
		]);

		$this->actingAs($this->user);
		$response = $this->get(route('bycountry') . '?search=Georgia');
		$response->assertStatus(200);
		$response->assertViewIs('bycountry-content');
	}
}
