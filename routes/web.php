<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [TourController::class, 'index']);
Route::get('/show/{id}', [TourController::class, 'show']);

use App\Http\Controllers\AdminController;

use App\Http\Controllers\BookingController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/bookings', [BookingController::class, 'myBookings'])->name('my-bookings');
    Route::get('/book/{id}', [BookingController::class, 'create'])->name('book.create');
    Route::post('/book/{id}', [BookingController::class, 'store'])->name('book.store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/create', [TourController::class, 'create']);
    Route::post('/store', [TourController::class, 'store']);
    Route::get('/edit/{id}', [TourController::class, 'edit']);
    Route::put('/update/{id}', [TourController::class, 'update']);
    Route::get('/delete/{id}', [TourController::class, 'delete']);
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users/{id}/toggle-role', [AdminController::class, 'toggleRole'])->name('admin.toggle-role');
    Route::post('/admin/users/{id}/update-password', [AdminController::class, 'updatePassword'])->name('admin.update-password');
});