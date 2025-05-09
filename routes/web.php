<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



// Public welcome page
Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');


Route::get('/available-rooms', [BookingController::class, 'showAvailableRooms'])->name('available.rooms');
Route::get('/bookings/create/{room_id}', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');



// Dashboard (requires login and verification)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Room and Booking resources
    Route::resource('rooms', RoomController::class);
    Route::resource('bookings', BookingController::class);
});

require __DIR__.'/auth.php';
