<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GentengController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// LANDING PAGE
Route::get('/', function () {
    return view('landing-page');
});

// LOGIN
Route::get('/login', [LoginController::class, 'index'])
    ->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

// LOGOUT
Route::get('/logout', [LoginController::class, 'logout'])
    ->name('logout');

// GROUP ADMIN (WAJIB LOGIN)
Route::middleware(['auth.login'])->prefix('admin')->group(function () {
    // ================= DASHBOARD =================
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // ================= USER =================
    Route::get('/user', [UserController::class, 'index'])
        ->name('admin.user');
    Route::post('/user/store', [UserController::class, 'store'])
        ->name('admin.user.store');
    Route::post('/user/update/{id}', [UserController::class, 'update'])
        ->name('admin.user.update');
    Route::get('/user/delete/{id}', [UserController::class, 'destroy'])
        ->name('admin.user.delete');

    // ================= GENTENG =================
    Route::get('/genteng', [GentengController::class, 'index'])
        ->name('admin.genteng');
    Route::post('/genteng/store', [GentengController::class, 'store'])
        ->name('admin.genteng.store');
    Route::post('/genteng/update/{id}', [GentengController::class, 'update'])
        ->name('admin.genteng.update');
    Route::get('/genteng/delete/{id}', [GentengController::class, 'destroy'])
        ->name('admin.genteng.delete');

    // ================= SETTING =================
    Route::view('/setting', 'admin.setting.index')
        ->name('admin.setting');
});