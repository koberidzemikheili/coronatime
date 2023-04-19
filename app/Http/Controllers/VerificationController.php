<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomEmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerificationController extends Controller
{
	public function verifyEmail(CustomEmailVerificationRequest $request): RedirectResponse
	{
		$request->fulfill();

		return redirect()->route('verification.verified');
	}
}
