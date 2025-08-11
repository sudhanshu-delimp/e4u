<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Analytics\ConsolesController;
use App\Http\Controllers\Admin\GlobalMonitoringController;
use App\Http\Controllers\Admin\Mannagement\SetFeesVariablesUsers;
use App\Http\Controllers\MyAdvertiser\PricingsummariesController;
use App\Http\Controllers\Admin\SupportTicketsController;
use App\Http\Controllers\Admin\TaskController;

Route::get('', 'DashboardController@index')->name('admin.index');
Route::get('/update-account', [DashboardController::class, 'edit'])->name('admin.account.edit');
Route::post('/update-account', [DashboardController::class, 'update'])->name('admin.account.update');
Route::get('/change-password', [DashboardController::class, 'editPassword'])->name('admin.change.password');
Route::post('/change-password', [DashboardController::class, 'updatePassword'])->name('admin.update.password');
//Route::get('/profile-information', [EscortController::class, 'ProfileInformation'])->name('escort.profile.information');
Route::get('/upload-my-avatar', [DashboardController::class, 'uploadAvatar'])->name('admin.profile.avatar');
Route::post('upload-avatar/{id}',[DashboardController::class,'storeMyAvatar'])->name('admin.save.avatar');
Route::post('remove-avatar',[DashboardController::class,'removeMyAvatar'])->name('admin.avatar.remove');

Route::post('submit_ticket', [SupportTicketsController::class,'submit_ticket'])->name('admin.support-ticket.create');
Route::get('support_tickets',[SupportTicketsController ::class, 'index'])->name('admin.support-ticket.list');
Route::get('support_tickets/dataTable', [SupportTicketsController::class, 'dataTable'])->name('admin.support-ticket.dataTable');
Route::get('support_tickets/conversations/{id?}', [SupportTicketsController::class, 'conversations'])->name('admin.support-ticket.conversations');
Route::post('support_tickets/save_message', [SupportTicketsController::class, 'save_message'])->name('admin.support-ticket.saveMessage');
Route::put('support_tickets/status/{id}/{statusId}', [SupportTicketsController::class, 'status_update'])->name('support-ticket.status.update');


Route::get('service-category', 'ServiceCategoryController@index')->name('admin.service.categories.index');

Route::get('global-monitoring', 'AttemptLoginController@index')->name('admin.global-monitoring');
// Route::get('global-monitoring', 'AttemptLoginController@index')->name('admin.monitor');
Route::get('global-online-monitoring', 'AttemptLoginController@showOnlieUsers')->name('admin.monitor.online');

Route::get('online-monitoring-staff', 'AttemptLoginController@showOnlieStaff')->name('admin.monitor.onlineStaff');
Route::get('online-monitoring-staff/data-table', 'AttemptLoginController@OnlineStaff')->name('admin.monitor.showOnlineStaff');
Route::get('global-online-monitoring/data-table', 'AttemptLoginController@dataTable')->name('admin.monitor.onlineUser');
Route::get('global-monitoring/data-table', 'AttemptLoginController@dataTable')->name('admin.monitor.attemptLogin');
Route::get('service', 'ServiceController@index')->name('admin.service.index');
Route::get('service/data-table','ServiceController@dataTable')->name('admin.service.datatable');
Route::post('service/save/{id?}', 'ServiceController@save')->name('admin.service.save');

Route::delete('service/delete/{id?}', 'ServiceController@delete')->name('admin.service.delete');
Route::get('pages', 'PageController@index')->name('admin.page.index');
Route::get('pages-details/{slug}', 'PageController@show')->name('admin.page.show');
Route::get('pages-edit/{id?}', 'PageController@edit')->name('admin.page.edit');
Route::get('pages-duplicate/{id}', 'PageController@duplicate')->name('admin.page.duplicate');
Route::get('create-page', 'PageController@create')->name('admin.page.create');
Route::post('pages-edit/{id?}', 'PageController@update')->name('admin.page.update');
Route::get('pages/{id}', 'PageController@destroy')->name('admin.page.destroy');
Route::get('page-listing/data-table','PageController@pageListAjaxdatatable')->name('admin.pages.dataTable');
Route::post('pages-published/{id?}', 'PageController@published')->name('admin.page.published');

Route::get('All-user', 'AttemptLoginController@showAllUsers')->name('admin.management.allUser');
Route::get('all-user/data-table','AttemptLoginController@allUserDatatable')->name('admin.management.allUserDatatable');
Route::get('change-security-level/{id}','AttemptLoginController@changeSecurityLevel')->name('admin.management.changeSecurityLevel');
Route::post('/update-user/{id}', 'AttemptLoginController@updateSecurityLevel')->name('admin.update.updateSecurityLevel');
Route::post('/check-otp/{id}', 'AttemptLoginController@checkOTP')->name('admin.checkOTP');
Route::get('/management/set-fees', [SetFeesVariablesUsers::class,'setFees'])->name('admin.set-fees');
Route::get('Analytics/consoles',[ConsolesController::class,'consoles'])->name('consoles');
Route::get('consoles-list-all-users',[ConsolesController::class,'allUserDatatable'])->name('admin.Analytics.consolesDataTable');

Route::get('global-monitoring',function(){
return view('admin.global-monitoring');
 })->name('admin.global-monitoring');

//  Route::get('massage-centre-listings', function(){
//      return view('admin.massage-centre-listings');
//  })->name('admin.massage-centre-listings');

 Route::get('massage-centre-listings',[GlobalMonitoringController::class,'massageCenterListing'])->name('admin.massage-centre-listings');
 Route::get('/data-table-listing/{type?}', [GlobalMonitoringController::class, 'dataTableListingAjax'])->name('escort.current.list.dataTableListing');
 Route::get('/data-table-single-listing/{id?}', [GlobalMonitoringController::class, 'dataTableSingleListingAjax'])->name('escort.current.single-list.dataTableListing');
 Route::get('/get-pinup-listing', [GlobalMonitoringController::class, 'getPinupListing'])->name('admin.global_monitoring.get_pinup_listing');
  
//  Route::get('escort-listings', function(){
//     return view('admin.escort-listings');
// })->name('admin.escort-listings');

Route::get('escort-listings',[GlobalMonitoringController::class,'escortListing'])->name('admin.escort-listings');
Route::get('/data-table-escort-listing/{type?}', [GlobalMonitoringController::class, 'dataTableEscortListingAjax'])->name('escort.current.list.escort-dataTableListing');
Route::get('/data-table-escort-single-listing/{id?}', [GlobalMonitoringController::class, 'dataTableEscortSingleListingAjax'])->name('escort.current.single-list.escort-dataTableListing');
  
 
Route::get('logged-in-users', function(){
    return view('admin.logged-in-users');
})->name('admin.logged-in-users');
 
Route::get('visitors', function(){
    return view('admin.visitors');
})->name('admin.visitors');

Route::get('pinup-listings', function(){
    return view('admin.pin-up-listings');
})->name('admin.pin-up-listings');
 
Route::get('database',function(){
    return view('admin.database');
})->name('admin.database');

Route::get('accounting-reports',function(){

    return view('admin.accounting-reports');
})->name('admin.accounting-reports');

Route::get('reporting',function(){
    return view('admin.reporting');
})->name('admin.reporting');

Route::get('advertiser-reports',function(){
    return view('admin.advertiser-reports');
})->name('admin.advertiser-reports');

Route::get('advertiser-reviews',function(){
    return view('admin.advertiser-reviews');
})->name('admin.advertiser-reviews');

Route::get('support-tickets',function(){
    return view('admin.support-tickets');
})->name('admin.support-tickets');
Route::post('update-pricing-detail',[PricingsummariesController::class ,'storePricingDetail'])->name('admin.save.pricing.details');
Route::get('pricingsummaries-datatable',[PricingsummariesController::class ,'PricingDataTable'])->name('admin.myPricing.dataTable');
// Route::get('/admin-dashboard/management/set-fees',function(){
//     return view('admin.management.set-fees');
// })->name('admin.set-fees');
// Route::get('/my-legbox-list', function(){
// 	return view('admin.legbox.list');
// 	//echo "lsflkshdflsdf";
// });
// Route::get('/my-legbox-notes', function(){
// 	return view('admin.legbox.notes');
// });
