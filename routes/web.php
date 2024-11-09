<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoworkingSpaceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('coworking-spaces', CoworkingSpaceController::class);
    Route::resource('reservations', ReservationController::class)->only(['index', 'store']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/reservations', [AdminController::class, 'reservations'])->name('admin.reservations');
    Route::post('admin/reservations/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.reservations.updateStatus');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
