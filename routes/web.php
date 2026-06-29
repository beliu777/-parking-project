<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;

Route::get('/', [ParkingController::class, 'home'])->name('home');

Route::get('/parking', [ParkingController::class, 'index'])->name('parking.index');
Route::get('/parking/{lot}/book', [BookingController::class, 'createForLot'])->name('booking.lot.create');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

Route::get('/payment/{booking}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/{booking}', [PaymentController::class, 'pay'])->name('payment.pay');
Route::get('/payment/{booking}/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/{booking}/mobile', [PaymentController::class, 'mobile'])->name('payment.mobile');
Route::get('/booking/{booking}/receipt', [PaymentController::class, 'receipt'])->name('booking.receipt');

Route::get('/admin/login', [AdminAuthController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::post('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

Route::post('/admin/bookings/{booking}/cancel-refund', [AdminController::class, 'cancelAndRefund'])->name('admin.bookings.cancelRefund');
Route::post('/admin/spots/{spot}/free', [AdminController::class, 'freeSpot'])->name('admin.spots.free');
Route::get('/admin/spots/{spot}/status', [AdminController::class, 'changeSpotStatus'])->name('admin.spots.status');
Route::post('/admin/spots/{spot}/status', [AdminController::class, 'updateSpotStatus'])->name('admin.spots.updateStatus');

Route::get('/make-me-admin/{email}', function ($email) {
    $user = \App\Models\User::where('email', $email)->first();
    if (!$user) {
        return "Пользователь с email {$email} не найден";
    }
    $user->is_admin = true;
    $user->save();
    return "Готово! {$user->name} ({$user->email}) теперь админ.";
});
