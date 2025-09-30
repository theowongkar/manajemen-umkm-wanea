<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UrbanVillageController as DashboardUrbanVillageController;
use App\Http\Controllers\Dashboard\UserController as DashboardUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->middleware('throttle:5,5')->name('authenticate');
});

Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('throttle:5,5')->name('logout');

    // Default URL
    Route::get('/', fn() => redirect()->route('dashboard'));

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard User
    Route::get('/dashboard/user', [DashboardUserController::class, 'index'])->name('dashboard.user.index');
    Route::post('/dashboard/user/tambah', [DashboardUserController::class, 'store'])->middleware('throttle:10,5')->name('dashboard.user.store');
    Route::put('/dashboard/user/{id}/ubah', [DashboardUserController::class, 'update'])->middleware('throttle:10,5')->name('dashboard.user.update');
    Route::delete('/dashboard/user/{id}/hapus', [DashboardUserController::class, 'destroy'])->middleware('throttle:10,5')->name('dashboard.user.destroy');

    // Dashboard Kelurahan
    Route::get('/dashboard/kelurahan', [DashboardUrbanVillageController::class, 'index'])->name('dashboard.urban-village.index');
    Route::post('/dashboard/kelurahan/tambah', [DashboardUrbanVillageController::class, 'store'])->middleware('throttle:10,5')->name('dashboard.urban-village.store');
    Route::put('/dashboard/kelurahan/{slug}/ubah', [DashboardUrbanVillageController::class, 'update'])->middleware('throttle:10,5')->name('dashboard.urban-village.update');
    Route::delete('/dashboard/kelurahan/{slug}/hapus', [DashboardUrbanVillageController::class, 'destroy'])->middleware('throttle:10,5')->name('dashboard.urban-village.destroy');
});
