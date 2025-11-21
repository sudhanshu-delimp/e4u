
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\User\Dashboard\UserController;
use App\Http\Controllers\Admin\GlobalMonitoringController;
use App\Http\Controllers\Staff\AgentController;
use App\Http\Controllers\Escort\EscortController as DataTableController;
use App\Http\Controllers\Staff\PDF\AgentPdfController;

Route::get('/', [StaffController::class, 'index'])->name('staff.dashboard');
Route::get('/update-account', [StaffController::class, 'edit'])->name('staff.account.edit');
Route::post('/update-account', [StaffController::class, 'update'])->name('staff.account.update');
Route::get('/change-password', [StaffController::class, 'editPassword'])->name('staff.change.password');
Route::post('/change-password', [StaffController::class, 'updatePassword'])->name('staff.update.password');
Route::get('/upload-avatar', [StaffController::class, 'uploadAvatar'])->name('staff.profile.avatar');
Route::post('upload-avatar/{id}',[StaffController::class,'storeMyAvatar'])->name('staff.save.avatar');
Route::post('remove-avatar',[StaffController::class,'removeMyAvatar'])->name('staff.avatar.remove');

Route::get('escort-listings',[GlobalMonitoringController::class,'escortListing'])->name('staff.escort-listings');
Route::get('/data-table-escort-listing/{type?}', [GlobalMonitoringController::class, 'dataTableEscortListingAjax'])->name('escort.current.list.escort-dataTableListing');
Route::get('/data-table-escort-single-listing/{id?}', [GlobalMonitoringController::class, 'dataTableEscortSingleListingAjax'])->name('escort.current.single-list.escort-dataTableListing');

 Route::get('massage-centre-listings',[GlobalMonitoringController::class,'massageCenterListing'])->name('staff.massage-centre-listings');
 Route::get('/data-table-listing/{type?}', [GlobalMonitoringController::class, 'dataTableListingAjax'])->name('escort.current.list.dataTableListing');
 Route::get('/data-table-single-listing/{id?}', [GlobalMonitoringController::class, 'dataTableSingleListingAjax'])->name('escort.current.single-list.dataTableListing');
 Route::get('/get-pinup-listing', [GlobalMonitoringController::class, 'getPinupListing'])->name('admin.global_monitoring.get_pinup_listing');
Route::get('pinup-listings', function(){
    return view('admin.pin-up-listings');
})->name('staff.pin-up-listings');

Route::post('/update-password', [StaffController::class, 'changePassword'])->name('staff.update-password');
/** Agent management */
Route::get('/management/agent',[AgentController::class,'agent_list'])->name('staff.agent');
Route::post('/suspend-agent',[AgentController::class,'suspend_agent'])->name('staff.suspend-agent');
Route::post('/update-agent',[AgentController::class,'update_agent'])->name('staff.update-agent');
Route::post('/add-agent',[AgentController::class,'add_agent'])->name('staff.add-agent');
Route::post('/check-agent-email',[AgentController::class,'check_agent_email'])->name('staff.check-agent-email');
Route::post('/approve-agent-account',[AgentController::class,'approve_agent_account'])->name('staff.approve-agent-account');
Route::post('/active-agent-account',[AgentController::class,'activate_user'])->name('staff.active-agent-account');
Route::get('agent_list_data_table', [AgentController::class, 'agent_data_list'])->name('staff.agent_list_data_table');
Route::post('/generate-agent-info-pdf', [AgentPdfController::class, 'generate_agent_info_pdf'])->name('staff.generate-agent-info-pdf');
