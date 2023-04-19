<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomEmailVerificationRequest;

class VerificationController extends Controller
{
	public function verifyEmail(CustomEmailVerificationRequest $request)
	{
		$request->fulfill();

		return redirect(route('verification.verified'));
	}
}
