<?php
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Middleware\EnsureAdmin;
use App\Http\Middleware\EnsureIdentified;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'show'])->name('login');
Route::post('/login/admin', [AuthController::class, 'admin'])->name('login.admin');
Route::post('/login/customer', [AuthController::class, 'customer'])->name('login.customer');
Route::post('/login/guest', [AuthController::class, 'guest'])->name('login.guest');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(EnsureIdentified::class)->group(function () {
    Route::get('/', [BookingController::class, 'create'])->name('book');
    Route::post('/book', [BookingController::class, 'store'])->name('book.store');
});

Route::middleware(EnsureAdmin::class)->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/reservations');
    Route::resource('reservations', ReservationController::class)->except('show');
    Route::resource('customers', CustomerController::class)->except('show');
});
