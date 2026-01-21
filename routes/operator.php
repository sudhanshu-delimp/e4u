<?php

use App\Http\Controllers\Operator\OperatorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('operator-login', [App\Http\Controllers\Admin\AuthController::class,'showOperatorLoginForm'])->name('operator.login');
Route::get('/', [OperatorController::class, 'index'])->name('operator.index');
Route::get('/edit-my-account', [OperatorController::class, 'editMyaccount'])->name('operator.edit-my-account');
Route::get('/change-password', [OperatorController::class, 'changePassword'])->name('operator.change-password');
Route::get('/upload-avatar', [OperatorController::class, 'uploadAvatar'])->name('operator.upload-avatar');
Route::get('/bank-account', [OperatorController::class, 'bankAccount'])->name('operator.bank-account');
Route::get('/agents-monthly-report', [OperatorController::class, 'agentMonthlyreport'])->name('operator.agents-monthly-report');
Route::get('/operator-monthly-report', [OperatorController::class, 'e4uMonthlyreport'])->name('operator.operator-monthly-report');