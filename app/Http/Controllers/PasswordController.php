<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest\EmailRequest;
use App\Http\Requests\PasswordRequest\ResetRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
	public function postResetEmail(EmailRequest $request)
	{
		$request->validate(['email' => 'required|email']);

		$status = Password::sendResetLink(
			$request->only('email')
		);

		return $status === Password::RESET_LINK_SENT
					? redirect()->route('password.confirmation')->with('status', __($status))
					: back()->withErrors(['email' => __($status)]);
	}

	public function showResetForm(Request $request, $token = null)
	{
		return view('password-reset.newpassword')->with(
			['token' => $token, 'email' => $request->email]
		);
	}

	public function reset(ResetRequest $request)
	{
		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function (User $user, string $password) {
				$user->forceFill([
					'password' => $password,
				])->setRememberToken(Str::random(60));

				$user->save();

				event(new PasswordReset($user));
			}
		);

		return $status === Password::PASSWORD_RESET
					? redirect()->route('password.successfull')->with('status', __($status))
					: back()->withErrors(['email' => [__($status)]]);
	}
}
