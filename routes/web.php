<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\FlowerController;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class , 'index'])->name('dashboard');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
Route::post('/auth/firebase-login', [AuthController::class, 'firebaseLogin']);

// Google Login via Socialite (Optional, if you want to use Socialite too)
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('/venues', [VenueController::class , 'index'])->name('venues.index');
Route::get('/venues/{id}', [VenueController::class , 'show'])->name('venues.show');

Route::get('/flowers', [FlowerController::class , 'index'])->name('flowers.index');
Route::get('/flowers/{id}', [FlowerController::class , 'show'])->name('flowers.show');

Route::get('/checkout/{venue_id?}', [\App\Http\Controllers\BookingController::class , 'checkout'])->name('checkout')->middleware('auth');
Route::post('/checkout/pay', [\App\Http\Controllers\BookingController::class , 'pay'])->name('checkout.pay')->middleware('auth');

Route::get('/orders', [\App\Http\Controllers\BookingController::class , 'orders'])->name('orders')->middleware('auth');

// Profile Routes
Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::post('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::get('/rating', function () {
    return view('rating');
})->name('rating')->middleware('auth');

Route::get('/saran', function () {
    return view('saran');
})->name('saran')->middleware('auth');

Route::post('/saran', function (\Illuminate\Http\Request $request) {
    return redirect()->route('dashboard')->with('success', 'Terima kasih! Saran Anda telah kami terima.');
})->name('saran.store')->middleware('auth');

Route::get('/studycase', function () {
    $venues = \App\Models\Venue::paginate(10);
    return view('studycase', compact('venues'));
})->name('studycase')->middleware('auth');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
