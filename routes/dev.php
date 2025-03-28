<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['ipinfo'], 'prefix' => 'dev'], function() {

    Route::get('login', 'LoginController@index')->name('dev.login');

    Route::post('login', 'LoginController@login')->name('dev.login');

    Route::get('dashboard', 'DashboardController@index')->name('dev.dashboard');

    Route::get('roles', 'RoleController@index')->name('dev.role.index');
});