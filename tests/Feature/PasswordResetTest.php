<?php

namespace Tests\Feature;

use App\Http\Requests\PasswordRequest\ResetRequest;
use App\Models\User;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

class PasswordResetTest extends TestCase
{
	use RefreshDatabase;

	public function test_resetpassword_page_is_accessible()
	{
		$response = $this->get(route('password.request'));
		$response->assertSuccessful();
	}

	public function test_resetpassword_page_should_give_us_errors_if_input_is_not_provided()
	{
		$response = $this->post(route('password.email'));
		$response->assertSessionHasErrors(
			[
				'email',
			]
		);
	}

	public function test_resetpassword_page_should_give_us_errors_if_input_is_wrong()
	{
		$response = $this->post(route('password.email'), ['email'=>'test']);
		$response->assertSessionHasErrors(
			[
				'email',
			]
		);
	}

	public function test_resetpassword_page_should_give_us_errors_if_input_does_not_match_records()
	{
		$response = $this->post(route('password.email'), ['email'=>'test@gmail.com']);
		$response->assertSessionHasErrors(
			[
				'email',
			]
		);
	}

	public function test_send_email_post_is_working()
	{
		User::factory()->create(
			[
				'email'    => 'tester@email.com',
			]
		);
		$response = $this->post(route('password.request'), ['email'=>'tester@email.com']);

		$response->assertRedirect(route('password.confirmation'));
	}

	public function test_email_is_sent()
	{
		User::factory()->create(
			[
				'email'    => 'tester@email.com',
			]
		);
		$user = User::where('email', 'tester@email.com')->first();
		$token = Password::createToken($user);
		Notification::fake();
		$user->sendPasswordResetNotification($token);
		notification::assertSentTo(
			$user,
			CustomResetPasswordNotification::class
		);
	}

	public function test_show_reset_form()
	{
		User::factory()->create(
			[
				'email'    => 'tester@email.com',
			]
		);
		$user = User::where('email', 'tester@email.com')->first();
		$token = Password::createToken($user);

		$response = $this->get(route('password.reset', [
			'token' => $token,
			'email' => 'tester@email.com',
		]));

		$response->assertStatus(200);

		$response->assertViewIs('password-reset.newpassword');

		$response->assertSee(['token' => $token, 'email' => 'tester@email.com']);
	}

	public function test_reset_password()
	{
		User::factory()->create(
			[
				'email'    => 'tester@email.com',
			]
		);
		$user = User::where('email', 'tester@email.com')->first();

		$token = Password::createToken($user);

		$password = 'password';

		$request = ResetRequest::create(route('password.update'), 'POST', [
			'email'                 => $user->email,
			'password'              => $password,
			'password_confirmation' => $password,
			'token'                 => $token,
		]);

		$response = $this->post(route('password.update'), $request->all());

		$response->assertStatus(302);

		$this->assertTrue(Hash::check($password, $user->fresh()->password));

		$this->assertNotNull($user->fresh()->remember_token);

		$response->assertRedirect(route('password.successfull'));
	}
}
