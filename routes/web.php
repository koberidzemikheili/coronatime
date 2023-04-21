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
Route::middleware('locale')->group(function () {
	Route::middleware(['auth', 'verified'])->group(function () {
		Route::get('/', [StatisticController::class, 'show'])->name('landing');
		Route::get('/bycountry', [StatisticController::class, 'index'])->name('bycountry');
	});
	Route::middleware('guest')->group(function () {
		Route::get('login', function () {return view('session.login'); })->name('login.view');
		Route::get('register', function () {return view('session.register'); })->name('register.view');
		Route::controller(AuthController::class)->group(function () {
			Route::post('register', 'store')->name('register');
			Route::post('logout', 'destroy')->name('logout');
			Route::post('login', 'login')->name('login');
		});
	});
	Route::middleware('guest')->group(function () {
		Route::prefix('/email')->group(function () {
			Route::get('/verify', function () { return view('auth.verify-email'); })->name('verification.notice');
			Route::get('/verified', function () {return view('auth.verified'); })->name('verification.verified');
			Route::get('/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');
		});
		Route::prefix('/forgot-password')->group(function () {
			Route::get('/', function () {return view('password-reset.email'); })->name('password.request');
			Route::post('/', [PasswordController::class, 'PostResetEmail'])->name('password.email');
			Route::get('/confirmation', function () {return view('password-reset.confirmation'); })->name('password.confirmation');
			Route::get('/successfull', function () {return view('password-reset.successfull'); })->name('password.successfull');
		});
		Route::controller(PasswordController::class)->prefix('/reset-password')->group(function () {
			Route::get('/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
			Route::post('/', [PasswordController::class, 'reset'])->name('password.update');
		});
	});
});
