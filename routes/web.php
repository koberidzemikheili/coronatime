<?php

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
	return view('welcome');
})->name('landing');

Route::get('login', function () {
	return view('session.login');
})->name('login.view');
Route::get('register', function () {
	return view('session.register');
})->name('register.view');

Route::prefix('password-reset-')->group(function () {
	Route::get('email', function () {
		return view('session.password-reset.email');
	})->name('reset-email.view');
	Route::get('newpassword', function () {
		return view('session.password-reset.newpassword');
	})->name('reset-newpassword.view');
	Route::get('successfull', function () {
		return view('session.password-reset.successfull');
	})->name('reset-successfull');
	Route::get('confirmation', function () {
		return view('session.password-reset.confirmation');
	})->name('reset-confirmation');
	Route::get('verified', function () {
		return view('session.verified');
	})->name('verified');
});
