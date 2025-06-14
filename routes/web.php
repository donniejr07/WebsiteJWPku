<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\UserController;


// Admin Authentication & Protected Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest routes (belum login)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Authenticated routes (sudah login)
    Route::middleware('admin.auth')->group(function () {
        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        
        // Redirect root admin ke layanan
        Route::get('/', function () {
            return redirect()->route('admin.layanan.index');
        });

        // CRUD Layanan
        Route::resource('/layanan', LayananController::class);

        // Pesan Masuk
        Route::get('/pesan/masuk', [MessageController::class, 'index'])
             ->name('pesan.order');
        Route::patch('/pesan/{id}/status', [MessageController::class, 'updateStatus'])
             ->name('pesan.updateStatus');
        Route::delete('/pesan/{id}', [MessageController::class, 'destroy'])
             ->name('pesan.destroy');


    });
});

// User Routes (Public)
Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/services', [UserController::class, 'services'])->name('services');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::post('/contact', [UserController::class, 'submitContact'])->name('contact.submit');
Route::get('/check-order', [UserController::class, 'checkOrder'])->name('check.order');
Route::post('/check-order', [UserController::class, 'checkOrder'])->name('check.order.submit');
