<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\AdminNumsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportingController;
use App\Http\Controllers\Admin\PostOfficeController;
use App\Http\Controllers\Admin\PDF\AgentPdfController;
use App\Http\Controllers\Agent\AgentRequestController;
use App\Http\Controllers\Admin\SupportTicketsController;
use App\Http\Controllers\Admin\AdvertiserReportContoller;
use App\Http\Controllers\Admin\GlobalMonitoringController;
use App\Http\Controllers\Admin\AdvertiserReviewsController;
use App\Http\Controllers\Admin\AgentNotificationController;
use App\Http\Controllers\Admin\Analytics\ConsolesController;
use App\Http\Controllers\Admin\CenterNotificationController;
use App\Http\Controllers\Admin\EscortNotificationController;
use App\Http\Controllers\Admin\GlobalNotificationController;
use App\Http\Controllers\Admin\ViewerNotificationController;
use App\Http\Controllers\Admin\AdminMakeNotificationController;
use App\Http\Controllers\Admin\Mannagement\SetFeesVariablesUsers;
use App\Http\Controllers\MyAdvertiser\PricingsummariesController;
use App\Http\Controllers\Admin\GlobalMonitoringLoggedInController;
use App\Http\Controllers\Admin\ReportAdvertiserSuspensionContoller;
####### Track user info like device last page visit city ip address etc ########
Route::middleware(['TrackLoginUserInfo'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('admin.index');
});
Route::get('/update-account', [DashboardController::class, 'edit'])->name('admin.account.edit');
Route::post('/update-account', [DashboardController::class, 'update'])->name('admin.account.update');
Route::get('/change-password', [DashboardController::class, 'editPassword'])->name('admin.change.password');
Route::post('/change-password', [DashboardController::class, 'updatePassword'])->name('admin.update.password');
//Route::get('/profile-information', [EscortController::class, 'ProfileInformation'])->name('escort.profile.information');
Route::get('/upload-my-avatar', [DashboardController::class, 'uploadAvatar'])->name('admin.profile.avatar');
Route::post('upload-avatar/{id}', [DashboardController::class, 'storeMyAvatar'])->name('admin.save.avatar');
Route::post('remove-avatar', [DashboardController::class, 'removeMyAvatar'])->name('admin.avatar.remove');

Route::post('submit_ticket', [SupportTicketsController::class, 'submit_ticket'])->name('admin.support-ticket.create');
Route::get('support_tickets', [SupportTicketsController::class, 'index'])->name('admin.support-ticket.list');
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
Route::get('service/data-table', 'ServiceController@dataTable')->name('admin.service.datatable');
Route::post('service/save/{id?}', 'ServiceController@save')->name('admin.service.save');

Route::delete('service/delete/{id?}', 'ServiceController@delete')->name('admin.service.delete');
Route::get('pages', 'PageController@index')->name('admin.page.index');
Route::get('pages-details/{slug}', 'PageController@show')->name('admin.page.show');
Route::get('pages-edit/{id?}', 'PageController@edit')->name('admin.page.edit');
Route::get('pages-duplicate/{id}', 'PageController@duplicate')->name('admin.page.duplicate');
Route::get('create-page', 'PageController@create')->name('admin.page.create');
Route::post('pages-edit/{id?}', 'PageController@update')->name('admin.page.update');
Route::get('pages/{id}', 'PageController@destroy')->name('admin.page.destroy');
Route::get('page-listing/data-table', 'PageController@pageListAjaxdatatable')->name('admin.pages.dataTable');
Route::post('pages-published/{id?}', 'PageController@published')->name('admin.page.published');

Route::get('/management/All-user', 'AttemptLoginController@showAllUsers')->name('admin.management.allUser');
Route::get('all-user/data-table', 'AttemptLoginController@allUserDatatable')->name('admin.management.allUserDatatable');
Route::get('change-security-level/{id}', 'AttemptLoginController@changeSecurityLevel')->name('admin.management.changeSecurityLevel');
Route::post('/update-user/{id}', 'AttemptLoginController@updateSecurityLevel')->name('admin.update.updateSecurityLevel');
Route::post('/check-otp/{id}', 'AttemptLoginController@checkOTP')->name('admin.checkOTP');
Route::get('/management/set-fees', [SetFeesVariablesUsers::class, 'setFees'])->name('admin.set-fees');
Route::get('Analytics/consoles', [ConsolesController::class, 'consoles'])->name('consoles');
Route::get('consoles-list-all-users', [ConsolesController::class, 'allUserDatatable'])->name('admin.Analytics.consolesDataTable');

Route::get('global-monitoring', function () {
    return view('admin.global-monitoring');
})->name('admin.global-monitoring');

//  Route::get('massage-centre-listings', function(){
//      return view('admin.massage-centre-listings');
//  })->name('admin.massage-centre-listings');

Route::get('massage-centre-listings', [GlobalMonitoringController::class, 'massageCenterListing'])->name('admin.massage-centre-listings');
Route::get('/data-table-listing/{type?}', [GlobalMonitoringController::class, 'dataTableListingAjax'])->name('escort.current.list.dataTableListing');
Route::get('/data-table-single-listing/{id?}', [GlobalMonitoringController::class, 'dataTableSingleListingAjax'])->name('escort.current.single-list.dataTableListing');
Route::get('/get-pinup-listing', [GlobalMonitoringController::class, 'getPinupListing'])->name('admin.global_monitoring.get_pinup_listing');

//  Route::get('escort-listings', function(){
//     return view('admin.escort-listings');
// })->name('admin.escort-listings');

Route::get('escort-listings', [GlobalMonitoringController::class, 'escortListing'])->name('admin.escort-listings');
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

# Visitors module
Route::get('visitors', [VisitorController::class, 'index'])->name('admin.visitors');
Route::get('get-visitors-by-ajax', [VisitorController::class, "getVisitorsByAjax"])->name('admin.visitors-by-ajax');
// Route::get('visitors', function(){
//     return view('admin.visitors');
// })->name('admin.visitors');

// OC(M) Shareholder

Route::get('shareholders/annual-report', function () {
    return view('admin.management.shareholders.annual-report');
})->name('admin.annual-report');

Route::get('shareholders/annual-profit-and-loss', function () {
    return view('admin.management.shareholders.annual-profit-and-loss');
})->name('admin.annual-profit-and-loss');

Route::get('shareholders/balance-sheet', function () {
    return view('admin.management.shareholders.balance-sheet');
})->name('admin.balance-sheet');

Route::get('shareholders/constitution', function () {
    return view('admin.management.shareholders.constitution');
})->name('admin.constitution');

Route::get('shareholders/minutes', function () {
    return view('admin.management.shareholders.minutes');
})->name('admin.minutes');

Route::get('shareholders/newsletter', function () {
    return view('admin.management.shareholders.newsletter');
})->name('admin.newsletter');

Route::get('shareholders/shareholder-notices', function () {
    return view('admin.management.shareholders.shareholder-notices');
})->name('admin.shareholder-notices');

Route::get('shareholders/subsidiaries-balance-sheet', function () {
    return view('admin.management.shareholders.subsidiaries-balance-sheet');
})->name('admin.subsidiaries-balance-sheet');

Route::get('shareholders/subsidiaries-annual-profit-and-loss', function () {
    return view('admin.management.shareholders.subsidiaries-annual-profit-and-loss');
})->name('admin.subsidiaries-annual-profit-and-loss');

Route::get('shareholders/updates', function () {
    return view('admin.management.shareholders.updates');
})->name('admin.updates');




Route::get('pinup-listings', function () {
    return view('admin.pin-up-listings');
})->name('admin.pin-up-listings');

Route::get('database', function () {
    return view('admin.database');
})->name('admin.database');

Route::get('accounting-reports', function () {

    return view('admin.accounting-reports');
})->name('admin.accounting-reports');

Route::get('reporting', function () {
    return view('admin.reporting');
})->name('admin.reporting');


Route::get('cms/email-templates', function () {
    return view('admin.management.cms.email-templates');
})->name('admin.email-templates');


# Advertiser report section
Route::get('reports/advertiser-reports', [AdvertiserReportContoller::class, 'index'])->name('admin.advertiser-reports');
Route::get('advertiser-reports-ajax', [AdvertiserReportContoller::class, 'getReportByAjax'])->name('admin.advertiser-reports.ajax');
Route::get('member-single-escort-reports-ajax', [AdvertiserReportContoller::class, 'getSingleMemberEscortReport'])->name('admin.single-member-reports.ajax');
Route::get('print-single-escort-reports', [AdvertiserReportContoller::class, 'printSingleMemberEscortReport'])->name('admin.print.single-member-reports');
Route::post('advertiser-report-status', [AdvertiserReportContoller::class, 'updateMemberReportStatus'])->name('admin.advertiser.report-status');

# Advertiser reviews section
Route::get('reports/advertiser-reviews', [AdvertiserReviewsController::class, 'index'])->name('admin.advertiser-reviews');
Route::get('advertiser-reviews-ajax', [AdvertiserReviewsController::class, 'getReviewsByAjax'])->name('admin.advertiser-reviews.ajax');
Route::get('member-single-escort-reviews-ajax', [AdvertiserReviewsController::class, 'getSingleMemberEscortReviews'])->name('admin.single-member-reviews.ajax');
Route::get('print-single-reviews', [AdvertiserReviewsController::class, 'printSingleMemberEscortReviews'])->name('admin.print.single-member-reviews');
Route::post('advertiser-reviews-status', [AdvertiserReviewsController::class, 'updateMemberReviewsStatus'])->name('admin.advertiser.reviews-status');

// Route::get('advertiser-reviews',function(){
//     return view('admin.advertiser-reviews');
// })->name('admin.advertiser-reviews');

Route::get('get_registration_report', [ReportingController::class, 'getRegistrationReport'])->name('admin.get_registration_report');
Route::get('reports/registrations-reports', [ReportingController::class, 'userRegistrationReport'])->name('admin.registrations-reports');
Route::post('change-user-status', [ReportingController::class, 'changeUserStatus'])->name('admin.change-user-status');
// Route::get('registrations-reports',function(){
//     return view('admin.reporting.registrations');
// })->name('admin.registrations-reports');


Route::get('management/dashboard', function () {
    return view('admin.management.management');
})->name('admin.management');

Route::get('management/monthly-fee-reports', function () {
    return view('admin.management.operator.monthly-fee-reports');
})->name('admin.monthly-fee-reports');



Route::get('management/commission-summary', function () {
    return view('admin.management.operator.commission-summary');
})->name('admin.commission-summary');

Route::get('management/operator-manage', function () {
    return view('admin.management.operator.operator-manage');
})->name('admin.operator-manage');


Route::get('management/tours', function () {
    return view('admin.management.statistics.tours');
})->name('admin.tours');

Route::get('management/profile', function () {
    return view('admin.management.statistics.profile');
})->name('admin.profile');

Route::get('/management/statistics/num', function () {
    return view('admin.management.statistics.num');
})->name('admin.num');

Route::get('support-tickets', function () {
    return view('admin.support-tickets');
})->name('admin.support-tickets');


Route::post('update-pricing-detail', [PricingsummariesController::class, 'storePricingDetail'])->name('admin.save.pricing.details');
Route::get('pricingsummaries-datatable', [PricingsummariesController::class, 'PricingDataTable'])->name('admin.myPricing.dataTable');
Route::get('concierge_services_datatable', [PricingsummariesController::class, 'concierge_services_datatable'])->name('admin.concierge_services_datatable');
Route::post('update_fees_data', [PricingsummariesController::class, 'update_fees_data'])->name('admin.update_fees_data');

Route::get('fee_support_services', [PricingsummariesController::class, 'fee_support_services_datatable'])->name('admin.fee_support_services');
Route::get('loyalty_program_advertisers', [PricingsummariesController::class, 'loyalty_program_datatable'])->name('admin.loyalty_program_advertisers');
Route::get('agent_operator_fees', [PricingsummariesController::class, 'agent_operator_fees_datatable'])->name('admin.agent_operator_fees');
Route::get('commision_playbox_fees', [PricingsummariesController::class, 'commision_playbox_fees_datatable'])->name('admin.commision_playbox_fees');



Route::get('management/manage-suppliers', function () {
    return view('admin.management/manage-suppliers');
})->name('admin.manage-suppliers');


Route::get('database/manage-email', function () {
    return view('admin.database.manage-email');
})->name('manage-email');


Route::get('database/manage-sim', function () {
    return view('admin.database.manage-sim');
})->name('manage-sim');


Route::get('reports/agent-requests', function () {
    return view('admin.reports.agent-requests');
})->name('admin.agent-requests');



// Route::get('reports/num',function(){
//     return view('admin.reports.num');
// })->name('admin.num');

Route::get('/post-office/reports', [PostOfficeController::class, 'addPostOfficeReport'])->name('admin.reports');
Route::get('/post-office/send-reports', [PostOfficeController::class, 'listingPostOfficeReport'])->name('admin.send-reports');

Route::get('reports/num', [AdminNumsController::class, 'index'])->name('admin.num');
Route::get('reports-num-ajax', [AdminNumsController::class, 'showReportOnDashboardAjax'])->name('admin.num.ajax');
Route::post('reports-num-status', [AdminNumsController::class, 'updateStatus'])->name('admin.num.status.ajax');
Route::get('reports-num-email', [AdminNumsController::class, 'viewReport'])->name('admin.num.status.email');

Route::get('reports/transaction-summary', function () {
    return view('admin.reports.transaction-summary');
})->name('admin.transaction-summary');

// Route::get('reports/advertiser-suspensions',function(){
//     return view('admin.reports.advertiser-suspensions');
// })->name('admin.advertiser-suspensions');
Route::get('reports/advertiser-suspensions', [ReportAdvertiserSuspensionContoller::class, 'index'])->name('admin.advertiser-suspensions');
Route::get('reports/advertiser-suspensions-list-ajax', [ReportAdvertiserSuspensionContoller::class, 'advertiserSuspensionDataTableListingAjax'])->name('admin.advertiser-suspensions-list-ajax');

Route::get('admin/dataTable', [AgentRequestController::class, 'dataTable'])->name('admin.dataTable');
Route::post('send-notiification', [NotificationController::class, 'sendNotification'])->name('admin.send-notiification');
/** Staff */
Route::get('/management/staff', [StaffController::class, 'staff_list'])->name('admin.staff');
Route::post('/management/add-staff', [StaffController::class, 'add_sfaff'])->name('admin.add-staff');
Route::get('staff_list_data_table', [StaffController::class, 'staff_data_list'])->name('admin.staff_list_data_table');
Route::post('/suspend-staff', [StaffController::class, 'suspend_staff'])->name('admin.suspend-staff');
Route::post('/active-staff-account', [StaffController::class, 'activate_user'])->name('admin.active-staff-account');
Route::get('/edit-staff/{id}', [StaffController::class, 'editStaff'])->name('admin.edit-staff');
Route::post('/store-staff', [StaffController::class, 'update_staff'])->name('admin.store-staff');
Route::get('/view-staff/{id}', [StaffController::class, 'viewStaff'])->name('admin.view-staff');
Route::post('/approve-staff-account', [StaffController::class, 'approve_staff_account'])->name('admin.approve_staff_account');
Route::post('/print-staff', [StaffController::class, 'printStaffDetails'])->name('admin.print_staff');


Route::get('/management/agent', [AgentController::class, 'agent_list'])->name('admin.agent');
Route::post('/suspend-agent', [AgentController::class, 'suspend_agent'])->name('admin.suspend-agent');
Route::post('/update-agent', [AgentController::class, 'update_agent'])->name('admin.update-agent');
Route::post('/add-agent', [AgentController::class, 'add_agent'])->name('admin.add-agent');
Route::post('/check-agent-email', [AgentController::class, 'check_agent_email'])->name('admin.check-agent-email');
Route::post('/approve-agent-account', [AgentController::class, 'approve_agent_account'])->name('admin.approve-agent-account');
Route::post('/active-agent-account', [AgentController::class, 'activate_user'])->name('admin.active-agent-account');

Route::get('agent_list_data_table', [AgentController::class, 'agent_data_list'])->name('admin.agent_list_data_table');

Route::get('management/agents-monthly-report', [AgentController::class, 'agent_monthly_report'])->name('admin.agents-monthly-report');


//Centres Notification system for admin

Route::get('notifications/centres/list', [CenterNotificationController::class, 'index'])->name('admin.centres.notifications.index');
Route::post('/notifications/centres/store', [CenterNotificationController::class, 'store'])->name('admin.centres.notifications.store');
Route::get('/notifications/centres/{id}/show', [CenterNotificationController::class, 'show'])->name('admin.centres.notifications.show');
Route::post('/notifications/centres/{id}/status', [CenterNotificationController::class, 'updateStatus'])->name('admin.centres.notifications.status');
Route::get('/notifications/centres/pdf-download/{id}', [CenterNotificationController::class, 'pdfDownload'])->name('admin.centres.pdf.download');
Route::get('/notifications/centres/{id}/edit', [CenterNotificationController::class, 'edit'])->name('admin.centres.notifications.edit');
Route::post('/notifications/centres/{id}/update', [CenterNotificationController::class, 'update'])->name('admin.centres.notifications.update');

//Agent Notification system for admin
Route::get('notifications/agents/list', [AgentNotificationController::class, 'index'])->name('admin.agent.notifications.index');
Route::post('/notifications/agent/store', [AgentNotificationController::class, 'store'])->name('admin.agent.notifications.store');
Route::get('/notifications/agent/{id}', [AgentNotificationController::class, 'show'])->name('admin.agent.notifications.show');
Route::post('/notifications/agent/{id}/suspend', [AgentNotificationController::class, 'updateStatus'])->name('admin.agent.notifications.suspend');
Route::post('/notifications/agent/{id}/status', [AgentNotificationController::class, 'changeStatus'])->name('admin.agent.notifications.status');
Route::get('/notifications/agent/pdf-download/{id}', [AgentNotificationController::class, 'pdfDownload'])->name('admin.agent.pdf.download');
Route::get('/notifications/agent/{id}/edit', [AgentNotificationController::class, 'edit'])->name('admin.agent.notifications.edit');
Route::post('/notifications/agent/{id}/update', [AgentNotificationController::class, 'update'])->name('admin.agent.notifications.update');


//Viewer Notification system for admin

Route::get('notifications/viewer/list', [ViewerNotificationController::class, 'index'])->name('admin.viewer.notification.index');
Route::post('/notifications/viewer/store', [ViewerNotificationController::class, 'store'])->name('admin.viewer.notification.store');
Route::get('/notifications/viewer/{id}', [ViewerNotificationController::class, 'show'])->name('admin.viewer.notifications.show');
Route::post('/notifications/viewer/{id}/suspend', [ViewerNotificationController::class, 'updateStatus'])->name('admin.viewer.notifications.suspend');
Route::post('/notifications/viewer/{id}/status', [ViewerNotificationController::class, 'changeStatus'])->name('admin.viewer.notifications.status');
Route::get('/notifications/viewer/pdf-download/{id}', [ViewerNotificationController::class, 'pdfDownload'])->name('admin.viewer.pdf.download');
Route::get('/notifications/viewer/{id}/edit', [ViewerNotificationController::class, 'edit'])->name('admin.viewer.notifications.edit');
Route::post('/notifications/viewer/{id}/update', [ViewerNotificationController::class, 'update'])->name('admin.viewer.notifications.update');

//Global Notification system for admin

Route::get('notifications/global/list', [GlobalNotificationController::class, 'index'])->name('admin.global.notification.index');
Route::post('/notifications/global/store', [GlobalNotificationController::class, 'store'])->name('admin.global.notification.store');
Route::get('/notifications/global/{id}', [GlobalNotificationController::class, 'show'])->name('admin.global.notifications.show');
Route::post('/notifications/global/{id}/suspend', [GlobalNotificationController::class, 'changeStatus'])->name('admin.global.notifications.suspend');
Route::post('/notifications/global/{id}/status', [GlobalNotificationController::class, 'updateStatus'])->name('admin.global.notifications.status');
Route::get('/notifications/global/pdf-download/{id}', [GlobalNotificationController::class, 'pdfDownload'])->name('admin.global.pdf.download');
Route::get('/notifications/global/{id}/edit', [GlobalNotificationController::class, 'edit'])->name('admin.global.notifications.edit');
Route::post('/notifications/global/{id}/update', [GlobalNotificationController::class, 'update'])->name('admin.global.notifications.update');

//Escort Notification system for admin

Route::get('notifications/escort/list', [EscortNotificationController::class, 'index'])->name('admin.escort.notifications.index');
Route::post('/notifications/escort/store', [EscortNotificationController::class, 'store'])->name('admin.escort.notifications.store');
Route::get('/notifications/escort/{id}/show', [EscortNotificationController::class, 'show'])->name('admin.escort.notifications.show');
Route::post('/notifications/escort/{id}/status', [EscortNotificationController::class, 'updateStatus'])->name('admin.escort.notifications.status');
Route::get('/notifications/escort/pdf-download/{id}', [EscortNotificationController::class, 'pdfDownload'])->name('admin.escort.pdf.download');
Route::get('/notifications/escort/{id}/edit', [EscortNotificationController::class, 'edit'])->name('admin.escort.notifications.edit');
Route::post('/notifications/escort/{id}/update', [EscortNotificationController::class, 'update'])->name('admin.escort.notifications.update');


// Route::get('/admin-dashboard/notifications/global',function(){
//     return view('admin.notifications.global');
// })->name('admin.global');


################### PDF ###################
Route::post('/generate-agent-info-pdf', [AgentPdfController::class, 'generate_agent_info_pdf'])->name('admin.generate-agent-info-pdf');

Route::get('/management/credits', function () {
    return view('admin.management.reports.credits');
})->name('admin.credits');

Route::get('/management/revenue', function () {
    return view('admin.management.reports.revenue');
})->name('admin.revenue');

Route::get('/management/email-management', function () {
    return view('admin.management.email-management');
})->name('email-management');

Route::get('/management/sim-management', function () {
    return view('admin.management.sim-management');
})->name('sim-management');


Route::get('/support/pricing', function () {
    return view('admin.support.pricing');
})->name('pricing');

Route::get('/support/abbreviations', function () {
    return view('admin.support.abbreviations');
})->name('abbreviations');

Route::get('/support/classification-laws', function () {
    return view('admin.support.classification-laws');
})->name('classification-laws');

Route::get('/support/laws', function () {
    return view('admin.support.laws');
})->name('laws');

Route::get('/support/post', function () {
    return view('admin.support.post');
})->name('post');

Route::get('/website/global-notifications', function () {
    return view('admin.website.global-notifications');
})->name('global-notifications');

Route::get('/website/maintenance', function () {
    return view('admin.website.maintenance');
})->name('maintenance');

Route::get('/Analytics/publicpages', function () {
    return view('admin.Analytics.publicpages');
})->name('publicpages');

// Route::get('/Analytics/consoles',function(){
//     return view('admin.Analytics.consoles');
// })->name('consoles');

Route::get('/Concierge/email-service-request', function () {
    return view('admin.Concierge.email-service-request');
})->name('email-service-request');

Route::get('/Concierge/mobile-sim-request', function () {
    return view('admin.Concierge.mobile-sim-request');
})->name('mobile-sim-request');

Route::get('/Concierge/product-request', function () {
    return view('admin.Concierge.product-request');
})->name('product-request');

Route::get('/Concierge/visa-migration-request', function () {
    return view('admin.Concierge.visa-migration-request');
})->name('visa-migration-request');

Route::get('/reporting/email-request', function () {
    return view('admin.reporting.email-request');
})->name('admin.email-request');

Route::get('/reporting/mobile-request', function () {
    return view('admin.reporting.mobile-request');
})->name('admin.mobile-request');

Route::get('/reporting/admin-product-request', function () {
    return view('admin.reporting.admin-product-request');
})->name('admin.admin-product-request');

Route::get('reports/punterbox',function(){
    return view('admin.reports.punterbox');
})->name('admin.punterbox');

Route::get('reports/communications',function(){
    return view('admin.reports.communications');
})->name('admin.communications');

Route::get('/management/competitor-database',function(){
    return view('admin.management.competitor-database');
})->name('admin.competitor-database');

Route::get('/management/memberships', function () {
    return view('admin.management.memberships');
})->name('admin.memberships');

Route::get('/reports/credit', function () {
    return view('admin.reports.credit');
})->name('admin.credit');



Route::get('/management/statistics/listings', function () {
    return view('admin.management.statistics.listings');
})->name('admin.listings');


Route::get('/management/legbox-report', function () {
    return view('admin.management.legbox-report');
})->name('admin.legbox-report');

Route::get('/management/logs-staff', function () {
    return view('admin.management.logs-staff');
})->name('admin.logs-staff');

/* Route::get('/management/staff',function(){
    return view('admin.management.staff');
})->name('admin.staff'); */

Route::get('/management/application', function () {
    return view('admin.management.logs.application');
})->name('admin.application');

Route::get('/management/revision', function () {
    return view('admin.management.logs.revision');
})->name('admin.revision');

Route::get('/management/security', function () {
    return view('admin.management.logs.security');
})->name('admin.security');


Route::get('/management/email-management', function () {
    return view('admin.management.email-management');
})->name('admin.email-management');

Route::get('/management/advertiser-templates', function () {
    return view('admin.management.cms.advertiser-templates');
})->name('admin.advertiser-templates');

Route::get('/management/operator-templates', function () {
    return view('admin.management.cms.operator-templates');
})->name('admin.operator-templates');

Route::get('/management/agent-templates', function () {
    return view('admin.management.cms.agent-templates');
})->name('admin.agent-templates');

Route::get('/management/shareholder-templates', function () {
    return view('admin.management.cms.shareholder-templates');
})->name('admin.shareholder-templates');

Route::get('/management/viewer-templates', function () {
    return view('admin.management.cms.viewer-templates');
})->name('admin.viewer-templates');

Route::get('/management/e4u-templates', function () {
    return view('admin.management.cms.e4u-templates');
})->name('admin.e4u-templates');

Route::get('/management/post-office', function () {
    return view('admin.management.post-office');
})->name('admin.post-office');


// Route::get('/notifications/global',function(){
//     return view('admin.notifications.global');
// })->name('admin.global');


// Route::get('/notifications/agents',function(){
//     return view('admin.notifications.agents');
// })->name('admin.agents');

// Route::get('/notifications/viewers',function(){
//     return view('admin.notifications.viewers');
// })->name('admin.viewers');


Route::get('/notifications/escorts', function () {
    return view('admin.notifications.escorts');
})->name('admin.escorts');

Route::get('/publications/blog', function () {
    return view('admin.publications.blog');
})->name('admin.blog');

Route::get('publications/alerts', function () {
    return view('admin.publications.alerts');
})->name('admin.alerts');


Route::get('/management/punterbox-reports', function () {
    return view('admin.management.punterbox-report');
})->name('admin.punterbox-reports');
