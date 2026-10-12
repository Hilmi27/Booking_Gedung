<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\PaymentDetailController;
use App\Http\Controllers\Admin\VenueController as AdminVenueController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenueController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Import middleware langsung

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication routes
Auth::routes();

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/venues', [VenueController::class, 'index'])->name('venues.index');
Route::get('/venues/{venue}', [VenueController::class, 'show'])->name('venues.show');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// User routes (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    Route::post('/bookings/{booking}/upload-payment', [BookingController::class, 'uploadPayment'])->name('bookings.upload-payment');
    Route::get('/check-availability', [BookingController::class, 'checkAvailability'])->name('bookings.check-availability');
});

// Admin routes (protected) - HANYA menggunakan class middleware langsung
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Venue management
    Route::resource('venues', AdminVenueController::class);
    Route::delete('/venues/images/{image}', [AdminVenueController::class, 'destroyImage'])->name('venues.images.destroy');

    // Facility management
    Route::resource('facilities', FacilityController::class);

    // Payment details management
    Route::resource('payment-details', PaymentDetailController::class);

    // User management
    Route::resource('users', UserController::class);

    // Booking management
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{booking}/update-status', [AdminBookingController::class, 'updateStatus'])->name('bookings.approve');
    Route::patch('/bookings/{booking}/reject-booking', [AdminBookingController::class, 'rejectBooking'])->name('bookings.reject');
});

// Tambahkan route untuk profile jika diperlukan
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');

    Route::put('/profile', function (Illuminate\Http\Request $request) {
        $user = Auth::user();

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone'   => 'nullable|string|max:15',
            'address' => 'nullable|string',
        ]);

        $user->update($validated);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    })->name('profile.update');
});
