<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RootDashboard;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StaffDashboard;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('root')->prefix('root')->group(function () {
        Route::get('/dashboard', [RootDashboard::class, 'index']);
        
        Route::get('/vehicles', [VehicleController::class, 'index']);

        Route::get('/drivers', [DriverController::class, 'index']);

        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/create', [OrderController::class, 'create'])->name('root-order-create');
        Route::post('/orders/create', [OrderController::class, 'store'])->name('root-order-store');

        Route::get('/users', [UserController::class, 'index']);
    });
    Route::middleware(['admin', 'root'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index']);

        Route::get('/vehicles', [VehicleController::class, 'index']);
        
        Route::get('/drivers', [DriverController::class, 'index']);
        
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/create', [OrderController::class, 'create'])->name('admin-order-create');
        Route::post('/orders/create', [OrderController::class, 'store'])->name('admin-order-store');
        
        Route::get('/staffs', [UserController::class, 'index']);
    });

    Route::middleware('staff', 'root')->prefix('staff')->group(function () {
        Route::get('/dashboard', [StaffDashboard::class, 'index']);
    });
    
});


require __DIR__.'/auth.php';
