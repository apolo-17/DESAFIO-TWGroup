<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoworkingSpaceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\CoworkingSpace;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('reservations', ReservationController::class)->only(['index', 'create', 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::resource('coworking-spaces', CoworkingSpaceController::class);
    Route::get('admin/reservations', [AdminController::class, 'reservations'])->name('admin.reservations');
    Route::post('admin/reservations/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.reservations.updateStatus');
});

require __DIR__ . '/auth.php';
