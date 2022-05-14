<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
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
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
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
    Route::get('/admin/profile/{admin}', 'profile');
    Route::get('/admin/profile/edit/{admin}', 'profileEdit')->name('admin.profile.edit');
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