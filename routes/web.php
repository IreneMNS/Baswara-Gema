<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;

// =======================
// Auth
// =======================
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::get('/password', [AuthController::class, 'password'])->name('password');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// =======================
// Dashboard (FIXED)
// =======================
Route::get('/dashboard', function () {
    return view('dashboard.index');   // ← perbaikan disini
})->name('dashboard');

// =======================
// Room Management
// =======================
Route::get('/room', [RoomController::class, 'index']);
Route::post('/room', [RoomController::class, 'store']);
Route::get('/room/{room}/edit', [RoomController::class, 'edit']);
Route::put('/room/{room}', [RoomController::class, 'update']);
Route::delete('/room/{room}', [RoomController::class, 'destroy']);

// =======================
// Reservation Management
// =======================
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');

Route::get('/list-book', [ReservationController::class, 'list'])->name('reservation.list');

Route::get('/reservation/{id}/edit', [ReservationController::class, 'edit'])->name('reservation.edit');
Route::put('/reservation/{id}', [ReservationController::class, 'update'])->name('reservation.update');

Route::delete('/reservation/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
Route::patch('/reservation/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservation.cancel');
