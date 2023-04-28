<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
	use RefreshDatabase;

	public function test_login_page_is_accessible(): Void
	{
		$response = $this->get(route('login.view'));
		$response->assertSuccessful();
	}

	public function test_auth_should_give_us_errors_if_input_is_not_provided(): Void
	{
		$response = $this->post(route('login'));
		$response->assertSessionHasErrors(
			[
				'login',
				'password',
			]
		);
	}

	public function test_auth_should_give_us_email_or_username_error_if_we_wont_provide_email_or_username_input(): Void
	{
		$response = $this->post(route('login'), [
			'password' => 'my-so-secret-password',
		]);
		$response->assertSessionHasErrors(
			[
				'login',
			]
		);
		$response->assertSessionDoesntHaveErrors(['password']);
	}

	public function test_auth_should_give_us_password_error_if_we_wont_provide_password_input(): Void
	{
		$response = $this->post(route('login'), [
			'login' => 'testname',
		]);
		$response->assertSessionHasErrors(
			[
				'password',
			]
		);
		$response->assertSessionDoesntHaveErrors(['login']);
	}

	public function test_auth_should_give_us_email_or_username_error_when_email_or_username_field_is_not_correct(): Void
	{
		$response = $this->post(route('login'), [
			'login' => 'my',
		]);
		$response->assertSessionHasErrors(
			[
				'login',
			]
		);
	}

	public function test_auth_should_give_us_incorrect_credentials_error_when_such_user_does_not_exists(): Void
	{
		$response = $this->post(route('login'), [
			'login'    => 'testerror@gmail.com',
			'password' => 'password',
		]);
		$response->assertSessionHasErrors(
			[
				'login' => 'The :attribute field must be a valid username or email address.',
			]
		);
	}

	public function test_auth_should_redirect_to_landing_page_after_successful_login(): Void
	{
		$email = 'tester@gmail.com';
		$password = 'password';
		$user = User::factory()->create(
			[
				'email'    => $email,
				'password' => $password,
			]
		);
		$response = $this->post(route('login'), [
			'login'    => $email,
			'password' => $password,
			'remember' => true,
		]);

		$response->assertRedirect(route('landing'));
		$this->assertAuthenticatedAs($user);
	}
}
