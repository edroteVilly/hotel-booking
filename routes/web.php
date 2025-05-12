<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthenticatedSessionController;

// **Invoice Routes**
Route::get('/bookings/{booking}/invoice-preview', [InvoiceController::class, 'showInvoicePage'])->name('invoice.preview');
Route::get('/invoice/{id}/preview', [InvoiceController::class, 'viewInvoice'])->name('invoice.view');
Route::get('/invoice/{id}/download', [InvoiceController::class, 'downloadInvoice'])->name('invoice.download');

// Routes for the Admin area with middleware protection
Route::middleware(['auth'])->group(function () {
    Route::resource('rooms', RoomController::class);  // Only admin can access room management
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Routes for viewing bookings and invoices
Route::get('/bookings/{booking}/invoice', [InvoiceController::class, 'generate'])
    ->name('bookings.invoice');

// Routes for bookings
Route::get('/my-bookings', [BookingController::class, 'myBookings'])
    ->middleware('auth')
    ->name('bookings.my');

// Routes for room creation
Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');

// Post route for booking a room
Route::post('/book-room/{id}', [BookingController::class, 'book'])->name('bookRoom');

// Logout route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');

    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

// Home route (accessible to all)
Route::get('/', [BookingController::class, 'index'])->name('home');

// Room show route
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

// Route for showing available rooms
Route::get('/available-rooms', [BookingController::class, 'showAvailableRooms'])->name('available.rooms');

// Profile routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('bookings/create/{room}', [BookingController::class, 'create'])->name('bookings.create');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('rooms', RoomController::class);
    Route::resource('bookings', BookingController::class)->except(['create']);
});

// Authentication routes (already defined in auth.php)
require __DIR__.'/auth.php';
