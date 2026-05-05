<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Route Autentikasi
Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'store')->name('register.store');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginAuth')->name('login.auth');
    Route::post('/logout', 'logout')->name('logout');
});

// Route Dashboard dengan Proteksi Multi-Role
// Middleware 'role' menerima parameter: admin, dosen, pimpinan, mahasiswa
Route::middleware(['auth', 'role:admin,dosen,pimpinan,mahasiswa'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        
        // Tambahkan Route Profil
        Route::get('/profile', 'profile')->name('profile');
        Route::put('/profile', 'updateProfile')->name('profile.update');
    });
});