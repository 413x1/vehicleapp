<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RootDashboard;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\StaffDashboard;

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
    });
    Route::middleware('admin', 'root')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index']);
    });
    Route::middleware('staff', 'root')->prefix('staff')->group(function () {
        Route::get('/dashboard', [StaffDashboard::class, 'index']);
    });
    
});


require __DIR__.'/auth.php';
