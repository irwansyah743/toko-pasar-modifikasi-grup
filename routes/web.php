<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

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

// Login Admin

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
// Akhir login admin

// MAIN CONTENT
Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index');
});
// Akhir MAIN CONTENT