<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LogoutTest extends TestCase
{
	use RefreshDatabase;

	public function test_user_can_logout_and_is_redirected_to_landing_page()
	{
		$user = User::factory()->create();
		Auth::login($user);

		$response = $this->post(route('logout'));

		$this->assertGuest();

		$response->assertRedirect(route('login'));
	}

	public function test_guest_user_is_redirected_to_login_page_when_attempting_to_logout()
	{
		$response = $this->post(route('logout'));

		$this->assertGuest();

		$response->assertRedirect(route('login'));
	}
}
