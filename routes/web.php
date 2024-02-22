<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ProductOptionController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\Frontend\CartController;
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

        // Pengaturan slider produk
        Route::resource('slider', SliderController::class);

        // Pengaturan bagian "Mengapa Memilih Kita"
        Route::put('why-choose-title-update', [WhyChooseUsController::class, 'updateTitle'])->name('why-choose-title.update');
        Route::resource('why-choose-us', WhyChooseUsController::class);

        // Pengaturan Produk

        /* Produk kategori */
        Route::resource('product-category', ProductCategoryController::class);
        /* Produk */
        Route::resource('product', ProductController::class);
        /* Produk Galeri */
        Route::get('product-gallery/{product}', [ProductGalleryController::class, 'index'])->name('product-gallery.show.index');
        Route::resource('product-gallery', ProductGalleryController::class);
        /* Variasi Ukuran Produk */
        Route::get('product-size/{product}', [ProductSizeController::class, 'index'])->name('product-size.show.index');
        Route::resource('product-size', ProductSizeController::class);
        /* Opsi Tambahan Produk */
        Route::resource('product-option', ProductOptionController::class);
    });
});

// Frontend index
Route::get('/', [FrontendController::class, 'index'])->name('index');
// Frontend tampilkan detil produk
Route::get('/product/{slug}', [FrontendController::class, 'showProduct'])->name('product.show');
// Frontend modal
Route::get('/load-product-modal/{productId}', [FrontendController::class, 'loadProductModal'])->name('load-product-modal');
// Tambah ke keranjang produk di sidebar
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('get-cart-products', [CartController::class, 'getCartProducts'])->name('get-cart-products');
// Hapus dari keranjang produk di sidebar
Route::get('cart-product-remove/{rowId}', [CartController::class, 'cartProductRemove'])->name('cart-product-remove');

// Frontend user dashboard
Route::prefix('dashboard')->as('user.')->middleware('auth')->controller(FrontendDashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard');
    Route::put('/updateDataProfile', 'updateDataProfile')->name('dashboard.updateDataProfile');
    Route::put('/updatePassword', 'updatePassword')->name('dashboard.updatePassword');
    Route::post('/updateAvatar', 'updateAvatar')->name('dashboard.updateAvatar');
});

require __DIR__ . '/auth.php';
