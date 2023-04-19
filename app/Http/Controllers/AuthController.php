<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Login\LoginRequest;
use App\Http\Requests\Register\RegisterRequest;

class AuthController extends Controller
{
	public function login(LoginRequest $request): RedirectResponse
	{
		if (auth()->attempt($request->validated(), $request->has('remember'))) {
			session()->regenerate();

			return redirect()->route('landing')->with('success', 'Welcome Back!');
		}

		throw ValidationException::withMessages([
			'email'=> trans('validation.email'),
		]);
	}

	public function destroy(): RedirectResponse
	{
		auth()->logout();

		return redirect()->route('landing')->with('success', 'Goodbye!');
	}

	public function store(RegisterRequest $request): RedirectResponse
	{
		$user = User::create($request->validated());
		$user->sendEmailVerificationNotification();
		return redirect()->route('verification.notice')->with('success', 'Your account has been created.');
	}
}
