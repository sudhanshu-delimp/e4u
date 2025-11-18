<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shareholder\ShareholderController;

Route::get('/', [ShareholderController::class, 'index'])->name('shareholder.index');