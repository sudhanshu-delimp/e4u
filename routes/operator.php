<?php

use App\Http\Controllers\Operator\OperatorController;
use App\Http\Controllers\User\Dashboard\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('operator-login', [App\Http\Controllers\Admin\AuthController::class,'showOperatorLoginForm'])->name('operator.login');
Route::get('/', [OperatorController::class, 'index'])->name('operator.index');

/** My Account */
Route::get('/edit-my-account', [OperatorController::class, 'editMyaccount'])->name('operator.edit-my-account');
Route::post('/update-account', [OperatorController::class, 'update'])->name('operator.account.update');
Route::get('/change-password', [OperatorController::class, 'editPassword'])->name('operator.change-password');
Route::get('/upload-avatar', [OperatorController::class, 'uploadAvatar'])->name('operator.upload-avatar');
Route::post('upload-avatar/{id}', [OperatorController::class, 'storeMyAvatar'])->name('operator.save.avatar');
Route::post('remove-avatar', [OperatorController::class, 'removeMyAvatar'])->name('operator.avatar.remove');

Route::post('/update-password', [OperatorController::class, 'changePassword'])->name('operator.update-password');
Route::post('/change-password', [UserController::class, 'updatePassword'])->name('operator.update.password');
Route::post('/change-password-expiry', [UserController::class, 'updatePasswordExpiry'])->name('operator.update.password.expiry');

Route::get('/bank-account', [OperatorController::class, 'bankAccount'])->name('operator.bank-account');
Route::get('/agents-monthly-report', [OperatorController::class, 'agentMonthlyreport'])->name('operator.agents-monthly-report');
Route::get('/operator-monthly-report', [OperatorController::class, 'e4uMonthlyreport'])->name('operator.operator-monthly-report');
