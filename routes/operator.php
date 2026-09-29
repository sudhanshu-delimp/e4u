<?php

use App\Http\Controllers\Operator\OperatorController;
use App\Http\Controllers\Operator\OperatorstaffController;
use App\Http\Controllers\User\Dashboard\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Operator\AgentMonthlyReportController;

//Route::get('operator-login', [App\Http\Controllers\Admin\AuthController::class,'showOperatorLoginForm'])->name('operator.login');
Route::get('/', [OperatorController::class, 'index'])->name('operator.index');

/** My Account */
Route::get('/edit-my-account', [OperatorController::class, 'editMyaccount'])->name('operator.edit-my-account');
Route::post('/update-account', [OperatorController::class, 'update'])->name('operator.account.update');
Route::get('/change-password', [OperatorController::class, 'editPassword'])->name('operator.change-password');
Route::get('/upload-avatar', [OperatorController::class, 'uploadAvatar'])->name('operator.upload-avatar');
Route::post('upload-avatar/{id}', [OperatorController::class, 'storeMyAvatar'])->name('operator.save.avatar');
Route::post('remove-avatar', [OperatorController::class, 'removeMyAvatar'])->name('operator.avatar.remove');
Route::post('/update-staff-account', [OperatorController::class, 'updateStaff'])->name('operator.staff.account.update');
Route::post('/update-password', [OperatorController::class, 'changePassword'])->name('operator.update-password');
Route::post('/change-password', [UserController::class, 'updatePassword'])->name('operator.update.password');
Route::post('/change-password-expiry', [UserController::class, 'updatePasswordExpiry'])->name('operator.update.password.expiry');

Route::get('/view-my-account', [OperatorController::class, 'myOperator'])->name('operator.my-operator');

Route::get('/bank-account', [OperatorController::class, 'bankAccount'])->name('operator.bank-account');
Route::post('save-bank-details',[OperatorController::class,'saveBankDetails'])->name('operator.save.bank.details');
Route::post('check-bank-otp',[OperatorController::class,'checkOTP'])->name('agent.checkOTP');
Route::post('delete-agent-bank',[OperatorController::class,'deleteOperatorBank'])->name('operator.delete-operator-bank');
Route::get('bank-details',[OperatorController::class,'BankDataTable'])->name('operator.bankDetail.dataTable');
//Route::get('/agents-monthly-report', [OperatorController::class, 'agentMonthlyreport'])->name('operator.agents-monthly-report');
//Route::get('/operator-monthly-report', [OperatorController::class, 'e4uMonthlyreport'])->name('operator.operator-monthly-report');

/** Operator Staff */
Route::get('/management/staff', [OperatorstaffController::class, 'staff_list'])->name('operator.operator.staff');
Route::post('/management/operator-add-staff', [OperatorstaffController::class, 'add_sfaff'])->name('operator.operator.add-staff');
Route::get('operator-staff_list_data_table', [OperatorstaffController::class, 'staff_data_list'])->name('operator.operator.staff_list_data_table');
Route::post('/suspend-operator-staff', [OperatorstaffController::class, 'suspend_staff'])->name('operator.operator.suspend-staff');
Route::post('/active-operator-staff-account', [OperatorstaffController::class, 'activate_user'])->name('operator.operator.active-staff-account');
Route::get('/edit-operator-staff/{id}', [OperatorstaffController::class, 'editStaff'])->name('operator.operator.edit-staff');
Route::post('/store-operator-staff', [OperatorstaffController::class, 'update_staff'])->name('operator.operator.store-staff');
Route::get('/view-operator-staff/{id}', [OperatorstaffController::class, 'viewStaff'])->name('operator.operator.view-staff');
Route::post('/approve-operator-staff-account', [OperatorstaffController::class, 'approve_staff_account'])->name('operator.operator.approve_staff_account');
Route::post('/print-operator-staff', [OperatorstaffController::class, 'printStaffDetails'])->name('operator.operator.print_staff');
Route::get('back-to-parent', [App\Http\Controllers\Admin\ImpersonateController::class, 'backToParent'])->name('operator.back-to-parent');

Route::get('get-notification', [NotificationController::class, 'getNotification'])->name('operator.get-notification');
Route::post('notification-seen', [NotificationController::class, 'makeNotificationSeen'])->name('operator.notification-seen');

//Route::get('/agents-monthly-report', [AgentMonthlyReportController::class, 'agentMonthlyreport'])->name('operator.agents-monthly-report');

//Agent Monthly Repors
Route::get('management/reports/agents-monthly-report', [AgentMonthlyReportController::class, 'agentMonthlyreport'])->name('operator.agents-monthly-report');

Route::get('management/fees/monthly-report-list', [AgentMonthlyReportController::class, 'monthlyReportAjax'])->name('operator.agents.fees.monthly-report-ajax');
Route::post('management/fees/view-monthly-report', [AgentMonthlyReportController::class, 'viewMonthlyReport'])->name('operator.agents.fees.view.detail');
Route::post('management/fees/update-monthly-report', [AgentMonthlyReportController::class, 'updateMonthlyReportStatus'])->name('operator.agents.fees.update.status.detail');
Route::post('management/fees/print-monthly-report', [AgentMonthlyReportController::class, 'printMonthlyFee'])->name('operator.agents.print.monthly.fee');
Route::post('management/fees/query', [AgentMonthlyReportController::class, 'viewQuery'])->name('operator.agents.fees.view.query');
Route::post('management/fees/pay-detail', [AgentMonthlyReportController::class, 'viewPayAgentreport'])->name('operator.agents.fees.view.pay-detail');
Route::post('management/fees/print-pay-detail', [AgentMonthlyReportController::class, 'printPayAgentreport'])->name('operator.agents.fees.print.pay-detail');

//Operator Monthly Repors
Route::get('management/reports/operator-monthly-report', [OperatorController::class, 'e4uMonthlyreport'])->name('operator.operator-monthly-report');
