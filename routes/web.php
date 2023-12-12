<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FrontendController::class, 'index'])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('login', [DashboardController::class, 'login']);
    Route::middleware(['auth', 'role:superadmin,admin'])->group(function () {
        Route::prefix('profile')->as('profile.')->controller(ProfileController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/update', 'updateProfile')->name('updateProfile');
            Route::put('/updatePassword', 'updatePassword')->name('updatePassword');
        });
    });
});

Route::get('admin/dashboard', [DashboardController::class, 'index'])->middleware(['auth','role:superadmin,admin'])->name('admin.dashboard');

require __DIR__.'/auth.php';
