<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Frontend\DashboardController as FrontendDashboardController;
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

// Admin Routes
Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('login', [DashboardController::class, 'login']);
    Route::middleware(['auth', 'role:superadmin,admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Pengaturan profil admin
        Route::prefix('profile')->as('profile.')->controller(ProfileController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/update', 'updateProfile')->name('updateProfile');
            Route::put('/updatePassword', 'updatePassword')->name('updatePassword');
        });

        Route::resource('slider', SliderController::class);
    });
});

// Frontend index route
Route::get('/', [FrontendController::class, 'index'])->name('index');

// Frontend user dashboard route
Route::prefix('dashboard')->as('user.')->middleware('auth')->controller(FrontendDashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard');
    Route::put('/updateDataProfile', 'updateDataProfile')->name('dashboard.updateDataProfile');
    Route::put('/updatePassword', 'updatePassword')->name('dashboard.updatePassword');
    Route::post('/updateAvatar', 'updateAvatar')->name('dashboard.updateAvatar');
});

require __DIR__.'/auth.php';
