
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\User\Dashboard\UserController;

use App\Http\Controllers\Escort\EscortController as DataTableController;


Route::get('/', [StaffController::class, 'index'])->name('staff.dashboard');
