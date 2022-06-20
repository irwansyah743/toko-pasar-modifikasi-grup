<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubSubCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// USER AUTH
Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified'
])->controller(UserController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/user/profile', 'profile')->name('profile');
    Route::put('/user/profile/{user}', 'store');
    Route::get('/user/profile/change-password', 'editPassword')->name('user.password');
    Route::put('/user/profile/change-password/{user}', 'changePassword');
});
// END USER AUTH

// ADMIN AUTH

Route::middleware('admin:admin')->controller(AdminController::class)->group(function () {
    Route::get('/admin/login', 'loginForm')->name('loginformAdmin');
    Route::post('/admin/login', 'store')->name('admin.login');
});


Route::middleware([
    'auth.admin:admin',
    config('jetstream.auth_session'),
    'verified'
])->controller(AdminController::class)->group(function () {
    Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::get('/admin/profile/edit', 'profileEdit')->name('admin.profile.edit');
    Route::put('/admin/profile/{admin}', 'profileUpdate');
    Route::post('/admin/profile/{admin}', 'changePassword');
});

Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

// END ADMIN AUTH

// ADMIN BRAND
Route::middleware([
    'auth.admin:admin',
    config('jetstream.auth_session'),
    'verified'
])->controller(BrandController::class)->prefix('brand')->group(function () {
    Route::get('/', 'index')->name('all.brand');
    Route::post('/', 'store')->name('brand.store');
    Route::get('/{brand}', 'edit');
    Route::put('/{brand}', 'update');
    Route::post('/{brand}', 'destroy')->name('brand.delete');
});
// END ADMIN BRAND

// ADMIN CATEGORY
Route::middleware([
    'auth.admin:admin',
    config('jetstream.auth_session'),
    'verified'
])->controller(CategoryController::class)->prefix('category')->group(function () {
    Route::get('/', 'index')->name('all.category');
    Route::post('/', 'store')->name('category.store');
    Route::get('/{category}', 'edit');
    Route::put('/{category}', 'update');
    Route::post('/{category}', 'destroy')->name('category.delete');
});

Route::middleware([
    'auth.admin:admin',
    config('jetstream.auth_session'),
    'verified'
])->controller(SubCategoryController::class)->prefix('subcategory')->group(function () {
    Route::get('/', 'index')->name('all.subcategory');
    Route::post('/', 'store')->name('subcategory.store');
    Route::get('/{subCategory}', 'edit');
    Route::put('/{subCategory}', 'update');
    Route::post('/{subCategory}', 'destroy')->name('subcategory.delete');
    Route::get('/ajax/{id}', 'getSubCategory');
});

Route::middleware([
    'auth.admin:admin',
    config('jetstream.auth_session'),
    'verified'
])->controller(SubSubCategoryController::class)->prefix('subsubcategory')->group(function () {
    Route::get('/', 'index')->name('all.subsubcategory');
    Route::post('/', 'store')->name('subsubcategory.store');
    Route::get('/ajax/{id}', 'getSubSubCategory');
    Route::get('/{subSubCategory}', 'edit');
    Route::put('/{subSubCategory}', 'update');
    Route::post('/{subSubCategory}', 'destroy')->name('subsubcategory.delete');
});
// END ADMIN CATEGORY

// ADMIN PRODUCT
Route::middleware([
    'auth.admin:admin',
    config('jetstream.auth_session'),
    'verified'
])->controller(ProductController::class)->prefix('product')->group(function () {
    Route::get('/', 'index')->name('manage.product');
    Route::get('/create', 'create')->name('create.product');
    Route::post('/', 'store')->name('product.store');
    Route::get('/edit/{product}', 'edit')->name('product.edit');
    Route::put('/{product}', 'update')->name('product.update');
    Route::put('/images', 'updateMultiImage')->name('update.product.images');
    Route::post('/images', 'storeImages')->name('product.images.store');
    Route::put('/thumbnail/{product}', 'updateThumbnail')->name('update.product.thumbnail');
    Route::put('/activate/{product}', 'ProductInactive')->name('product.inactive');
    Route::put('/inactivate/{product}', 'ProductActive')->name('product.active');
    Route::post('/{product}', 'destroy')->name('product.delete');
});

Route::post('/images/{multiimg}', [ProductController::class, 'destroyImages']);
// END ADMIN PRODUCT

// ADMIN SLIDER
Route::middleware([
    'auth.admin:admin',
    config('jetstream.auth_session'),
    'verified'
])->controller(SliderController::class)->prefix('slider')->group(function () {
    Route::get('/', 'index')->name('manage.slider');
    Route::get('/create', 'create')->name('create.slider');
    Route::post('/', 'store')->name('slider.store');
    Route::get('/edit/{slider}', 'edit')->name('slider.edit');
    Route::put('/{slider}', 'update')->name('slider.update');
    Route::put('/activate/{slider}', 'SliderInactive')->name('slider.inactive');
    Route::put('/inactivate/{slider}', 'SliderActive')->name('slider.active');
    Route::post('/{slider}', 'destroy')->name('slider.delete');
});
// END ADMIN SLIDER

// MAIN CONTENT
Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/product/detail/{slug}', 'productDetail');
    Route::get('/product/category/{category}', 'productCategory');
    Route::get('/product/tags/{keyword}', 'productTag');
    Route::get('/product/subcategory/{subcategory}', 'productSubcategory');
    Route::get('/product/view/modal/{id}', 'productViewAjax');
});

Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);
// Get Data from mini cart
Route::get('/cart/products', [CartController::class, 'addMiniCart']);
Route::post('/cart/products/{rowId}', [CartController::class, 'removeMiniCart']); 
// END MAIN CONTENT