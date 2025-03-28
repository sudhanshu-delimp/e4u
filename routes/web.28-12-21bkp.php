<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\Auth\Advertiser\RegisterController as AdvertiserRegisterController;
use Illuminate\Http\Request;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\Escort\Auth\LoginController as EscortLogin;
use App\Http\Controllers\Auth\Advertiser\LoginController as AdvertiserLoginController;
use App\Http\Controllers\Escort\EscortController;
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

//Route::get('/', [RegisterController::class,'home'])->name('home');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/register', [RegisterController::class,'register']);//->name('register.create');
Route::post('/logout', [LoginController::class,'logout'])->name('logout');
Route::post('/login', [LoginController::class,'login'])->name('login');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'intendedRedirect'])->name('dashboard');

/********** ADMIN **********/
Route::get('/advertiser-register', [AdvertiserRegisterController::class,'index'])->name('advertiser.register');
Route::post('/advertiser-register', [AdvertiserRegisterController::class,'register']);
Route::get('/advertiser-login', [AdvertiserLoginController::class,'index'])->name('advertiser.login');
Route::post('/advertiser-login', [AdvertiserLoginController::class, 'login']);
Route::post('/advertiser-logout', [AdvertiserLoginController::class,'logout'])->name('advertiser.logout');
//Route::get('/advertiser',function() { return view('escort.index_escort'); });
//Route::resource('/agentdashboard',EscortController::class);

/********** ADMIN **********/
Route::get('admin-login', [App\Http\Controllers\Admin\AuthController::class,'showLoginForm'])->name('admin.login');
Route::post('/admin-login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
Route::post('/admin-logout', [App\Http\Controllers\Admin\AuthController::class,'logout'])->name('admin.logout');

