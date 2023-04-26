<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class RegisterTest extends TestCase
{
	use RefreshDatabase;

	public function test_register_page_is_accessible()
	{
		$response = $this->get(route('register.view'));
		$response->assertSuccessful();
	}

	public function test_register_should_give_us_errors_if_input_is_not_provided()
	{
		$response = $this->post(route('register'));
		$response->assertSessionHasErrors(
			[
				'username',
				'email',
				'password',
			]
		);
	}

	public function test_register_should_give_us_email_error_if_we_wont_provide_email_input()
	{
		$response = $this->post(route('register'), [
			'username'                 => 'testusername',
			'password'                 => 'my-so-secret-password',
			'password_confirmation'    => 'my-so-secret-password',
		]);
		$response->assertSessionHasErrors(
			[
				'email',
			]
		);
		$response->assertSessionDoesntHaveErrors(['password', 'username', 'password_confirmation']);
	}

	public function test_register_should_give_us_username_error_if_we_wont_provide_username_input()
	{
		$response = $this->post(route('register'), [
			'email'                    => 'testmail@gmail.com',
			'password'                 => 'my-so-secret-password',
			'password_confirmation'    => 'my-so-secret-password',
		]);
		$response->assertSessionHasErrors(
			[
				'username',
			]
		);
		$response->assertSessionDoesntHaveErrors(['password', 'email', 'password_confirmation']);
	}

	public function test_register_should_give_us_password_error_if_we_wont_provide_password_input()
	{
		$response = $this->post(route('register'), [
			'email'                    => 'testmail@gmail.com',
			'username'                 => 'testusername',
		]);
		$response->assertSessionHasErrors(
			[
				'password',
			]
		);
		$response->assertSessionDoesntHaveErrors(['username', 'email']);
	}

	public function test_register_should_give_us_email_error_when_email_field_is_not_correct()
	{
		$response = $this->post(route('register'), [
			'email'                    => 'emailredberry.ge',
		]);
		$response->assertSessionHasErrors(
			[
				'email',
			]
		);
	}

	public function test_register_should_give_us_username_error_when_username_field_is_not_correct()
	{
		$response = $this->post(route('register'), [
			'username'                    => 'em',
		]);
		$response->assertSessionHasErrors(
			[
				'username',
			]
		);
	}

	public function test_register_should_give_us_password_error_when_password_and_passwordrepeat_are_not_matched()
	{
		$response = $this->post(route('register'), [
			'email'                       => 'testmail@gmail.com',
			'username'                    => 'testusername',
			'password'                    => 'my-so-secret-password',
			'password_confirmation'       => 'my-so-secret-passwo',
		]);
		$response->assertSessionHasErrors(
			[
				'password',
			]
		);
		$response->assertSessionDoesntHaveErrors(['username', 'email', 'password_confirmation']);
	}

	public function test_register_should_redirect_to_login_page_after_successful_register()
	{
		$response = $this->post(route('register'), [
			'email'                       => 'testmail@gmail.com',
			'username'                    => 'testusername',
			'password'                    => 'my-so-secret-password',
			'password_confirmation'       => 'my-so-secret-password',
		]);
		$this->assertDatabaseHas('users', [
			'username' => 'testusername',
			'email'    => 'testmail@gmail.com',
		]);

		$response->assertRedirect(route('verification.notice'));
	}

	public function test_after_registration_verify_email_is_sent()
	{
		User::factory()->create(
			[
				'email'    => 'tester@email.com',
			]
		);
		Notification::fake();
		$user = User::where('email', 'tester@email.com')->first();
		$user->sendEmailVerificationNotification();

		Notification::assertSentTo(
			$user,
			CustomVerifyEmail::class,
			1
		);
	}

	public function test_EmailVerification()
	{
		$user = User::factory()->create();

		$verificationUrl = URL::temporarySignedRoute(
			'verification.verify',
			now()->addMinutes(60),
			['id' => $user->id, 'hash' => sha1($user->email)]
		);

		$response = $this->get($verificationUrl);
		$response->assertStatus(302);

		$this->assertTrue($user->fresh()->hasVerifiedEmail());
		$this->assertNotNull($user->email_verified_at);
		$response->assertRedirect(route('verification.verified'));
	}
}
