<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\KategoriKerajinanController;
use App\Http\Controllers\KerajinanTanganController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

Route::get('/reload-captcha', [RegisterController::class, 'reloadCaptcha']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [BerandaController::class, 'index'])->name('beranda');

/* Route yang berkaitan dengan user */
// Route::resource('user', UserController::class);

Route::group(['middleware' => ['auth']], function(){
    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);
    // Route::get('/user', [UserController::class, 'index'])->name('user.index');
    // Route::get('/user/{user}', ['as' => 'user.edit', 'uses' => 'App\Http\Controllers\UserController@edit']);
    // Route::patch('/user/{user}/update', ['as' => 'user.update', 'uses' => 'App\Http\Controllers\UserController@update']);

    /* Seluruh route yang berkaitan dengan kerajinan */
    Route::resource('kerajinan', KerajinanTanganController::class);
    Route::get('/kerajinan/kategori/{id}', [KerajinanTanganController::class, 'perKategori'])->name('kerajinan.kategori');
    Route::get('/kerajinan/user/{id}', [KerajinanTanganController::class, 'user'])->name('kerajinan.user');

    /* Route yang berkaitan dengan keranjang */
    Route::resource('keranjang', KeranjangController::class);

    /* Seluruh route yang berkaitan dengan order */
    Route::resource('order', OrderController::class);
    Route::post('/order/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
    Route::get('/oreder/pdf/{id}',[OrderController::class, 'pdf'])->name('order.pdf');
});