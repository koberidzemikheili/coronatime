<?php

use App\Http\Controllers\AuthController;
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

Route::get('/bycountry', function () {
	return view('bycountry-content');
})->name('bycountry');

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
	Route::get('verified', function () {
		return view('session.verified');
	})->name('verified');
});

Route::post('register', [AuthController::class, 'store'])->middleware('guest')->name('register');
Route::post('logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');
Route::post('login', [AuthController::class, 'login'])->middleware('guest')->name('login');
