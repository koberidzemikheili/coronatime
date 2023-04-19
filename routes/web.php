<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
	return view('worldwide-content');
})->middleware('auth')->name('landing');

Route::get('/bycountry', [StatisticController::class, 'index'])->name('bycountry')->middleware('locale');

Route::get('login', function () {
	return view('session.login');
})->name('login.view')->middleware('guest');
Route::get('register', function () {
	return view('session.register');
})->name('register.view')->middleware('guest');

Route::prefix('password-reset')->group(function () {
	Route::get('email', function () {
		return view('password-reset.email');
	})->name('reset-email.view');
	Route::get('newpassword', function () {
		return view('password-reset.newpassword');
	})->name('reset-newpassword.view');
	Route::get('successfull', function () {
		return view('password-reset.successfull');
	})->name('reset-successfull');
	Route::get('confirmation', function () {
		return view('password-reset.confirmation');
	})->name('reset-confirmation');
});

Route::post('register', [AuthController::class, 'store'])->middleware('guest')->name('register');
Route::post('logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');
Route::post('login', [AuthController::class, 'login'])->middleware('guest')->name('login');

Route::get('/email/verify', function () { return view('auth.verify-email'); })->middleware('guest')->name('verification.notice');
Route::get('/email/verified', function () {return view('auth.verified'); })->middleware('guest')->name('verificatione.verified');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');
