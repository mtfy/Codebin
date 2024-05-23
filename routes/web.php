<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Log;


Route::get('/', function () {
    return view('home');
})->name('home');


/*Route::middleware('guest')->group(function () {
	Route::prefix('accounts')->name('auth.')->group(function () {
		Route::get('/login', [LoginController::class, 'create'])->name('login');	
		Route::post('/login', [LoginController::class, 'store']);

		Route::get('/register', [RegisterController::class, 'create'])->name('register');
		Route::post('/register', [RegisterController::class, 'store']);
	});
});*/


Route::name('paste.')->group(function() {

	Route::prefix('view')->group(function() {
		Route::get('/{token}', [PasteController::class, 'create'])->name('view');
	});

	Route::prefix('raw')->group(function() {
		Route::get('/{token}', [PasteController::class, 'createRaw'])->name('raw');
	});

	Route::prefix('paste')->group(function() {
		Route::post('/create', [PasteController::class, 'store'])->name('create');
		Route::post('/auth/{token}', [PasteController::class, 'auth'])->name('auth');
	});

});