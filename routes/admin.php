<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Agent\AgentRequestController;
use App\Http\Controllers\Admin\SupportTicketsController;
use App\Http\Controllers\Admin\AdvertiserReportContoller;
use App\Http\Controllers\Admin\AdvertiserReviewsController;
use App\Http\Controllers\Admin\GlobalMonitoringController;
use App\Http\Controllers\Admin\Analytics\ConsolesController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\Mannagement\SetFeesVariablesUsers;
use App\Http\Controllers\Admin\GlobalMonitoringLoggedInController;
use App\Http\Controllers\Admin\ReportAdvertiserSuspensionContoller;
use App\Http\Controllers\MyAdvertiser\PricingsummariesController;

####### Track user info like device last page visit city ip address etc ########
Route::middleware(['TrackLoginUserInfo'])->group(function () {  
    Route::get('', 'DashboardController@index')->name('admin.index');
});
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
  
# Logged in users monitoring routes
Route::get('logged-in-users', [GlobalMonitoringLoggedInController::class, "index"])->name('admin.logged-in-users');
Route::get('get-logged-in-users-by-ajax', [GlobalMonitoringLoggedInController::class, "getLoggedInUserDataTableListingAjax"])->name('admin.get-logged-in-users-by-ajax');
Route::get('get-logged-in-single-user-deatils-ajax/{id}', [GlobalMonitoringLoggedInController::class, "getLoggedInSingleUserDetailsAjax"])->name('admin.get-logged-in-single-user-detail-with-ajax');
Route::post('print-logged-in-single-user-deatils', [GlobalMonitoringLoggedInController::class, "printLoggedInUserSingleDetails"])->name('print.logged.user.single-details');
Route::get('logged-user-status-update/{id}', [GlobalMonitoringLoggedInController::class, "loggedUserStatusUpdate"])->name('logged-user-status-update');


// Route::get('logged-in-users', function(){
//     return view('admin.logged-in-users');
// })->name('admin.logged-in-users');
 
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


# Advertiser report section
Route::get('advertiser-reports',[AdvertiserReportContoller::class, 'index'])->name('admin.advertiser-reports');
Route::get('advertiser-reports-ajax',[AdvertiserReportContoller::class, 'getReportByAjax'])->name('admin.advertiser-reports.ajax');
Route::get('member-single-escort-reports-ajax',[AdvertiserReportContoller::class, 'getSingleMemberEscortReport'])->name('admin.single-member-reports.ajax');
Route::get('print-single-escort-reports',[AdvertiserReportContoller::class, 'printSingleMemberEscortReport'])->name('admin.print.single-member-reports');
Route::post('advertiser-report-status',[AdvertiserReportContoller::class, 'updateMemberReportStatus'])->name('admin.advertiser.report-status');

# Advertiser reviews section
Route::get('advertiser-reviews',[AdvertiserReviewsController::class, 'index'])->name('admin.advertiser-reviews');
Route::get('advertiser-reviews-ajax',[AdvertiserReviewsController::class, 'getReviewsByAjax'])->name('admin.advertiser-reviews.ajax');
Route::get('member-single-escort-reviews-ajax',[AdvertiserReviewsController::class, 'getSingleMemberEscortReviews'])->name('admin.single-member-reviews.ajax');
Route::get('print-single-reviews',[AdvertiserReviewsController::class, 'printSingleMemberEscortReviews'])->name('admin.print.single-member-reviews');
Route::post('advertiser-reviews-status',[AdvertiserReviewsController::class, 'updateMemberReviewsStatus'])->name('admin.advertiser.reviews-status');

// Route::get('advertiser-reviews',function(){
//     return view('admin.advertiser-reviews');
// })->name('admin.advertiser-reviews');

Route::get('registrations-reports',function(){
    return view('admin.reporting.registrations');
})->name('admin.registrations-reports');


Route::get('management/commission-statements',function(){
    return view('admin.management.operator.commission-statements');
})->name('admin.commission-statements');

Route::get('management/commission-summary',function(){
    return view('admin.management.operator.commission-summary');
})->name('admin.commission-summary');

Route::get('management/operator-manage',function(){
    return view('admin.management.operator.operator-manage');
})->name('admin.operator-manage');


Route::get('management/tours',function(){
    return view('admin.management.statistics.tours');
})->name('admin.tours');

Route::get('management/profile',function(){
    return view('admin.management.statistics.profile');
})->name('admin.profile');

Route::get('/admin-dashboard/management/statistics/num',function(){
    return view('admin.management.statistics.num');
})->name('admin.num');

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




Route::get('management/manage-suppliers',function(){
    return view('admin.management/manage-suppliers');
})->name('admin.manage-suppliers');


Route::get('database/manage-email',function(){
    return view('admin.database.manage-email');
})->name('manage-email');


Route::get('database/manage-sim',function(){
    return view('admin.database.manage-sim');
})->name('manage-sim');


Route::get('reports/agent-requests',function(){
    return view('admin.reports.agent-requests');
})->name('admin.agent-requests');

Route::get('reports/transaction-summary',function(){
    return view('admin.reports.transaction-summary');
})->name('admin.transaction-summary');

// Route::get('reports/advertiser-suspensions',function(){
//     return view('admin.reports.advertiser-suspensions');
// })->name('admin.advertiser-suspensions');
Route::get('reports/advertiser-suspensions',[ReportAdvertiserSuspensionContoller::class,'index'])->name('admin.advertiser-suspensions');
Route::get('reports/advertiser-suspensions-list-ajax',[ReportAdvertiserSuspensionContoller::class,'advertiserSuspensionDataTableListingAjax'])->name('admin.advertiser-suspensions-list-ajax');

Route::get('admin/dataTable', [AgentRequestController::class, 'dataTable'])->name('admin.dataTable');
Route::post('send-notiification', [NotificationController::class, 'sendNotification'])->name('admin.send-notiification');



Route::get('/management/agent',[AgentController::class,'agent_list'])->name('admin.agent');
Route::post('/suspend-agent',[AgentController::class,'suspend_agent'])->name('admin.suspend-agent');
Route::post('/update-agent',[AgentController::class,'update_agent'])->name('admin.update-agent');
Route::post('/add-agent',[AgentController::class,'add_agent'])->name('admin.add-agent');
Route::post('/check-agent-email',[AgentController::class,'check_agent_email'])->name('admin.check-agent-email');
Route::post('/approve-agent-account',[AgentController::class,'approve_agent_account'])->name('admin.approve-agent-account');

Route::get('agent_list_data_table', [AgentController::class, 'agent_data_list'])->name('admin.agent_list_data_table');


// Blog Management
Route::get('/blog', [BlogController::class, 'list'])->name('admin.blog.list');


