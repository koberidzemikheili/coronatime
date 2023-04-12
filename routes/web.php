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
});

Route::get('login', function () {
	return view('session.login');
});
Route::get('register', function () {
	return view('session.register');
});
Route::get('password-reset-email', function () {
	return view('session.password-reset.email');
});
Route::get('password-reset-newpassword', function () {
	return view('session.password-reset.newpassword');
});
Route::get('password-reset-successfull', function () {
	return view('session.password-reset.successfull');
});
Route::get('password-reset-confirmation', function () {
	return view('session.password-reset.confirmation');
});
Route::get('password-reset-successfull', function () {
	return view('session.verified');
});
