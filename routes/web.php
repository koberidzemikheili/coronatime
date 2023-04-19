<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
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
})->middleware(['auth', 'verified'])->name('landing')->middleware('locale');

Route::get('/bycountry', [StatisticController::class, 'index'])->name('bycountry')->middleware('locale');

Route::get('login', function () {
	return view('session.login');
})->name('login.view')->middleware('guest');
Route::get('register', function () {
	return view('session.register');
})->name('register.view')->middleware('guest');

Route::post('register', [AuthController::class, 'store'])->middleware('guest')->name('register');
Route::post('logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');
Route::post('login', [AuthController::class, 'login'])->middleware('guest')->name('login');

Route::get('/email/verify', function () { return view('auth.verify-email'); })->middleware('guest')->name('verification.notice');
Route::get('/email/verified', function () {return view('auth.verified'); })->middleware('guest')->name('verification.verified');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');

Route::get('/forgot-password', function () {return view('password-reset.email'); })->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordController::class, 'PostResetEmail'])->middleware('guest')->name('password.email');
Route::get('/forgot-password/confirmation', function () {return view('password-reset.confirmation'); })->middleware('guest')->name('password.confirmation');
Route::get('/forgot-password/successfull', function () {return view('password-reset.successfull'); })->middleware('guest')->name('password.successfull');

Route::get('/reset-password/{token}', [PasswordController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [PasswordController::class, 'reset'])->middleware('guest')->name('password.update');
