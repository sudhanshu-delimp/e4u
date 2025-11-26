
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\User\Dashboard\UserController;
use App\Http\Controllers\Staff\GlobalMonitoringController;
use App\Http\Controllers\Staff\AgentController;
use App\Http\Controllers\Staff\EscortController as DataTableController;
use App\Http\Controllers\Staff\PDF\AgentPdfController;
use App\Http\Controllers\Staff\VisitorController;
use App\Http\Controllers\Staff\GlobalMonitoringLoggedInController;

Route::get('/', [StaffController::class, 'index'])->name('staff.dashboard');
Route::get('/update-account', [StaffController::class, 'edit'])->name('staff.account.edit');
Route::post('/update-account', [StaffController::class, 'update'])->name('staff.account.update');
Route::get('/change-password', [StaffController::class, 'editPassword'])->name('staff.change.password');
Route::post('/change-password', [StaffController::class, 'updatePassword'])->name('staff.update.password');
Route::get('/upload-avatar', [StaffController::class, 'uploadAvatar'])->name('staff.profile.avatar');
Route::post('upload-avatar/{id}',[StaffController::class,'storeMyAvatar'])->name('staff.save.avatar');
Route::post('remove-avatar',[StaffController::class,'removeMyAvatar'])->name('staff.avatar.remove');

/**Global monitoring */
Route::get('escort-listings',[GlobalMonitoringController::class,'escortListing'])->name('staff.escort-listings');
Route::get('/data-table-escort-listing/{type?}', [GlobalMonitoringController::class, 'dataTableEscortListingAjax'])->name('staff.current.list.escort-dataTableListing');
Route::get('/data-table-escort-single-listing/{id?}', [GlobalMonitoringController::class, 'dataTableEscortSingleListingAjax'])->name('staff.current.single-list.escort-dataTableListing');

 Route::get('massage-centre-listings',[GlobalMonitoringController::class,'massageCenterListing'])->name('staff.massage-centre-listings');
 Route::get('/data-table-listing/{type?}', [GlobalMonitoringController::class, 'dataTableListingAjax'])->name('staff.current.list.dataTableListing');
 Route::get('/data-table-single-listing/{id?}', [GlobalMonitoringController::class, 'dataTableSingleListingAjax'])->name('staff.current.single-list.dataTableListing');
 Route::get('/get-pinup-listing', [GlobalMonitoringController::class, 'getPinupListing'])->name('staff.global_monitoring.get_pinup_listing');
Route::get('pinup-listings', function(){
    return view('staff.pin-up-listings');
})->name('staff.pin-up-listings');

/**Agent */
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

# Logged in users monitoring routes
Route::get('logged-in-users', [GlobalMonitoringLoggedInController::class, "index"])->name('staff.logged-in-users');
Route::get('get-logged-in-users-by-ajax', [GlobalMonitoringLoggedInController::class, "getLoggedInUserDataTableListingAjax"])->name('staff.get-logged-in-users-by-ajax');
Route::get('get-logged-in-single-user-deatils-ajax/{id}', [GlobalMonitoringLoggedInController::class, "getLoggedInSingleUserDetailsAjax"])->name('staff.get-logged-in-single-user-detail-with-ajax');
Route::post('print-logged-in-single-user-deatils', [GlobalMonitoringLoggedInController::class, "printLoggedInUserSingleDetails"])->name('staff.print.logged.user.single-details');
Route::get('logged-user-status-update/{id}', [GlobalMonitoringLoggedInController::class, "loggedUserStatusUpdate"])->name('staff.logged-user-status-update');

# Visitors module
Route::get('visitors', [VisitorController::class,'index'])->name('staff.visitors');
Route::get('get-visitors-by-ajax', [VisitorController::class, "getVisitorsByAjax"])->name('staff.visitors-by-ajax');

/** Staff */
Route::get('/management/staff',[StaffController::class,'staff_list'])->name('staff.staff');
Route::post('/management/add-staff',[StaffController::class,'add_sfaff'])->name('staff.add-staff');
Route::get('staff_list_data_table', [StaffController::class, 'staff_data_list'])->name('staff.staff_list_data_table');
Route::post('/suspend-staff',[StaffController::class,'suspend_staff'])->name('staff.suspend-staff');
Route::post('/active-staff-account',[StaffController::class,'activate_user'])->name('staff.active-staff-account');
Route::get('/edit-staff/{id}',[StaffController::class,'editStaff'])->name('staff.edit-staff');
Route::post('/store-staff',[StaffController::class,'update_staff'])->name('staff.store-staff');
Route::get('/view-staff/{id}',[StaffController::class,'viewStaff'])->name('staff.view-staff');
Route::post('/approve-staff-account',[StaffController::class,'approve_staff_account'])->name('staff.approve_staff_account');
Route::post('/print-staff',[StaffController::class,'printStaffDetails'])->name('staff.print_staff');

