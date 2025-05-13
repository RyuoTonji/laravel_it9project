<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\RoomServiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LoyaltyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/explore', [PageController::class, 'explore'])->name('explore');
Route::get('/rooms', [PageController::class, 'rooms'])->name('rooms');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
// Route::get('/booking', [PageController::class, 'booking'])->name('booking'); 

Route::post('/register', [AuthController::class, 'RegisterUser'])->name('register');
Route::post('/login', [AuthController::class, 'LoginUser'])->name('login');
Route::post('/logout', [AuthController::class, 'LogoutUser'])->name('logout');

Route::resource('bookings', BookingController::class);
Route::post('bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
Route::post('bookings/check-availability', [BookingController::class, 'checkAvailability'])->name('bookings.checkAvailability');

Route::post('bookings/{booking}/check-in', [CheckInController::class, 'store'])->name('check-ins.store');
Route::post('bookings/{booking}/check-out', [CheckInController::class, 'update'])->name('check-ins.update');

Route::get('bookings/{booking}/room-services/create', [RoomServiceController::class, 'create'])->name('room-services.create');
Route::post('bookings/{booking}/room-services', [RoomServiceController::class, 'store'])->name('room-services.store');
Route::patch('room-services/{roomService}', [RoomServiceController::class, 'update'])->name('room-services.update');

Route::get('bookings/{booking}/payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('bookings/{booking}/payments', [PaymentController::class, 'store'])->name('payments.store');

Route::get('reports/reservations', [ReportController::class, 'reservations'])->name('reports.reservations');
Route::get('reports/revenue', [ReportController::class, 'revenue'])->name('reports.revenue');
Route::get('reports/reservations/export', [ReportController::class, 'exportReservations'])->name('reports.reservations.export');

Route::get('loyalty', [LoyaltyController::class, 'index'])->name('loyalty.index');
Route::post('bookings/{booking}/apply-discount', [LoyaltyController::class, 'applyDiscount'])->name('loyalty.applyDiscount');