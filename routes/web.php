<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

Route::middleware('web')->group(function() {

	Route::get('/', function() {
		return redirect()->route('user_login');
	});

	Route::get('/user_login', function () {
	   	return view('01_user_login');
	})->name('user_login');

	Route::post('/user_login', [UserController::class, 'login']);

	Route::get('/user_new_registration', function() {
		return view('02_user_new_registration');
	})->name('user_new.registration');

	Route::post('/user_register', [UserController::class, 'register']);

	Route::get('/debug-session', function() {
		Log:info('デバッグセッション', [
			'secure' => env('SESSION_SECURE_COOKIE', false),
			'session_data' => session()->all(),
			'auth_check' => Auth::check(),
			'user' => Auth::user()
		]);
		return 'OK';
	});

	Route::get('/product_list', function () {
		Log::info('商品一覧画面');
	    Log::info('セッション確認', [
	        'user' => Auth::user(),
	        'session_id' => session()->getId(),
	        'session_data' => session()->all(),
	    ]);
		return view('03_product_list');
	})->middleware('auth:web')->name('product_list');

	Route::get('/product_new_registration', function () {
	   	return view('04_product_new_registration');
	})->name('product_new_registration');

	Route::get('/product_detail', function () {
	   	return view('05_product_detail');
	})->name('product_detail');

	Route::get('/product_edit', function () {
	   	return view('06_product_edit');
	})->name('product_edit');

	require __DIR__.'/auth.php';

});