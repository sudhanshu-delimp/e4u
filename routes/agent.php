
<?php

use App\Http\Controllers\Agent\AgentAccountController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\AgentRequestController;
use App\Http\Controllers\Agent\AgentTaskController;
use App\Http\Controllers\Agent\AgentTourPaymentController;
use App\Http\Controllers\Agent\AnalyticsController;
use App\Http\Controllers\Agent\AppointmentController;
use App\Http\Controllers\Agent\DatabaseCentreController;
use App\Http\Controllers\Agent\FeesSummaryController;
use App\Http\Controllers\Agent\EscortController;
use App\Http\Controllers\Agent\FeesSummeryController;
use App\Http\Controllers\Agent\ImpersonateController;
use App\Http\Controllers\Agent\MonthlyReportController;
use App\Http\Controllers\Agent\ProspectListController;
use App\Http\Controllers\Escort\ArchivesController;
use App\Http\Controllers\Escort\EscortController as DataTableController;
use App\Http\Controllers\Escort\EscortGalleryController;
use App\Http\Controllers\Escort\EscortPolyPaymentController;
use App\Http\Controllers\Escort\Profile\CreateController;
use App\Http\Controllers\Escort\Profile\UpdateController;
use App\Http\Controllers\Escort\TourController;
use App\Http\Controllers\MyAdvertiser\ListAdvertiserController;
use App\Http\Controllers\MyAdvertiser\PricingsummariesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\User\Dashboard\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


    Route::get('/', [AgentController::class, 'index'])->name('agent.dashboard');
   

    Route::post('/escorts-list', [AgentController::class, 'onlyEscortList'])->name('agent.only.escorts.list');

    //tour manage
    Route::post('/edit-tour',[AgentController::class, 'viewTourList'])->name('agent.EscortTour.list');
    Route::get('/agent-tours-dataTable/data-table/{id}',[ListAdvertiserController::class, 'TourDataTable'])->name('agent.tour.dataTable');

    Route::post('/create-tour/{id?}',[AgentController::class, 'createStoreTour'])->name('agent.store.tour');
    Route::post('/edit-store-tour/{id}',[AgentController::class, 'editStoreTour'])->name('agent.edit.tour');
    Route::get('create-tour',[TourController::class, 'createTour']);
    Route::post('/delete-tour/{id}',[TourController::class, 'DeleteTour'])->name('agent.delete.tour');
    Route::get('/archive-tours-list',[TourController::class, 'viewTourList'])->name('agent.tour.view');

    Route::post('/agent-manage-tours-edit/{id?}',[AgentController::class, 'viewTourEdit'])->name('agent.tour.edit');
    Route::post('/agent-manage-tours-apend/{id}',[AgentController::class, 'viewTourApend'])->name('agent.tour.apend');
    Route::post('/agent-create-tours-apend',[AgentController::class, 'createTourApend'])->name('agent.createTour.apend');
    Route::post('/agent-eidt-tours-apend',[AgentController::class, 'editTourApend'])->name('agent.editTour.apend');
    //endtour manage

    // Route::get('/escorts-lsit', [AgentController::class, 'onlyEscortList'])->name('agent.only.escorts.list');

    //Route::get('/lsit', [AgentController::class, 'escortList'])->name('agent.list');
    Route::get('/escorts-list/data-table', [AgentController::class, 'escortDataTable'])->name('agent.escort.dataTable');
    Route::get('/user-escorts-list/data-table', [ListAdvertiserController::class, 'escortDataTable'])->name('agent.userEscort.dataTable');

    Route::get('/only-escorts-list/data-table/{id}', [ListAdvertiserController::class, 'onlyDataTable'])->name('agent.onlyEscort.dataTable');

    Route::get('/list/data-table', [AgentController::class, 'dataTable'])->name('agent.list.dataTable');
    //Route::get('profile/{id}',[AgentController::class,'updateProfile'])->name('agent.update.profile');
    Route::post('delete-profile/{id}',[AgentController::class,'deleteProfile'])->name('agent.delete.profile');
    Route::post('save-member-type/{id}',[AgentController::class,'saveMembership'])->name('agent.save.memberType');

    /*aget account */
    Route::get('/update-account', [AgentAccountController::class, 'edit'])->name('agent.account.edit');
    Route::post('/update-account', [AgentAccountController::class, 'update'])->name('agent.account.update');
    Route::get('/change-password', [AgentAccountController::class, 'editPassword'])->name('agent.change.password');
    
    Route::post('/update-password', [AgentAccountController::class, 'changePassword'])->name('agent.update-password');

    Route::post('/change-password', [UserController::class, 'updatePassword'])->name('agent.update.password');
    Route::post('/change-password-expiry', [UserController::class, 'updatePasswordExpiry'])->name('agent.update.password.expiry');
    /*end aget account */

    Route::post('policy/{id}',[AgentController::class,'updatePolicy'])->name('agent.update.policy');
    //Route::post('profile/{id}',[AgentController::class,'storeAboutMe'])->name('agent.about.me');
    Route::post('update-read-more/{id}',[AgentController::class,'storeReadMore'])->name('agent.read.more');
    Route::post('update-about/{id}',[AgentController::class,'storeAbout'])->name('agent.about');
    Route::post('services/{id}',[AgentController::class,'storeServices'])->name('agent.store.services');
    Route::post('rates/{id}',[AgentController::class,'storeRates'])->name('agent.store.rate');
    Route::post('availability/{id}',[AgentController::class,'storeAvailability'])->name('agent.store.availability');

    //Route::get('create-profile/{id?}',[EscortController::class,'create'])->name('agent.create.profile');
    //Route::get('create-profile/{id?}',[EscortController::class,'index'])->name('agent.profile');
    Route::post('create-profile',[EscortController::class,'createProfile'])->name('agent.create.profile');
    Route::get('create-escort-profile/{id?}',[EscortController::class,'create'])->name('agent.create.escort.profile');
    Route::get('user-list',[EscortController::class,'userList'])->name('agent.user.list');

    Route::post('upload-media',[EscortController::class,'saveMedia'])->name('upload.media');

    Route::delete('delete-media/{id}',[EscortController::class,'deleteMedia'])->name('agent.delete.media');
    Route::post('mark-default/{id}',[EscortController::class,'markDefault'])->name('agent.media.mark.default');
    Route::get('next-step/{id}',[EscortController::class,'nextStep'])->name('agent.next.step');

    Route::get('playmates/{id}', [EscortController::class, 'escortsPlayMates'])->name('escort.playmates');
    Route::post('find-playmates-id/{id}', [EscortController::class, 'findPlaymatesId'])->name('agent.playmatesId.find');
    Route::post('find-playmates/', [EscortController::class, 'findPlaymates'])->name('agent.playmates.find');
    Route::post('add-playmate', [EscortController::class, 'addPlaymate'])->name('agent.playmates.add');
    Route::post('remove-playmate', [EscortController::class, 'removePlaymate'])->name('agent.playmates.remove');


     Route::get('Advertisers/new-requests', [AgentRequestController::class, 'newRequest'])->name('agent.new-requests');
     Route::post('process-request', [AgentRequestController::class, 'processRequest'])->name('agent.process-request');
     Route::get('get-notification', [NotificationController::class, 'getNotification'])->name('agent.get-notification');
     Route::post('notification-seen', [NotificationController::class, 'makeNotificationSeen'])->name('agent.notification-seen');
    

     Route::get('Advertisers/history-requests', [AgentRequestController::class, 'historyRequests'])->name('agent.history-requests');

    //Prospect List
    Route::get('marketing/prospect-list', [ProspectListController::class, 'prospectList'])->name('agent.marketing.prospect.list');


    //Marketing Database (Centres)
    Route::get('marketing/database-centres', [DatabaseCentreController::class, 'databaseCentres'])->name('agent.marketing.database.centres');
    Route::get('marketing/view-database-centre/{id}', [DatabaseCentreController::class, 'viewDataSummery'])->name('agent.marketing.database.view');
    Route::get('marketing/download-database-centre/{id}', [DatabaseCentreController::class, 'downloadExcel'])->name('agent.marketing.database.download');
    Route::get('marketing/count-active-post-code', [DatabaseCentreController::class, 'countActivePostCode'])->name('agent.marketing.database.active.count');
    Route::get('marketing/database-download-pdf/{id}', [DatabaseCentreController::class, 'downloadPdf'])->name('agent.marketing.database.download.pdf');
    //gettting postcodes data
    Route::get('marketing/prospect-lists/postcodes', [ProspectListController::class, 'postcodes'])->name('agent.marketing.prospect.postcodes');
    Route::get('marketing/prospect-lists/generate', [ProspectListController::class, 'generateList'])->name('agent.marketing.prospect.generate');
    Route::get('marketing/prospect-lists/recipients', [ProspectListController::class, 'showRecipients'])->name('agent.marketing.prospect.recipients');
    Route::get('marketing/prospect-lists/reports', [ProspectListController::class, 'getReports'])->name('agent.marketing.prospect.reports');
    Route::post('marketing/prospect-lists/store-report', [ProspectListController::class, 'storeReport'])->name('agent.marketing.prospect.store-report');
    Route::post('marketing/prospect-lists/report-action', [ProspectListController::class, 'reportAction'])->name('agent.marketing.prospect.report-action');
    Route::post('marketing/prospect-lists/clear-reports', [ProspectListController::class, 'clearReports'])->name('agent.marketing.prospect.clear-reports');
    Route::get('marketing/prospect-list/save-report', [ProspectListController::class, 'saveReport'])->name('agent.marketing.prospect.save-report');
    //Report List action 
    Route::post('marketing/prospect-list/report-action', [ProspectListController::class, 'reportAction'])->name('agent.marketing.prospect.report.action');

    //Gener pdf
    Route::post('marketing/prospect-list/generate-pdf', [ProspectListController::class, 'generatePDF'])->name('agent.marketing.prospect.generate.pdf');
    //show progressbar for save report and prospect list
    Route::get('marketing/prospect-list/progress/{id}', [ProspectListController::class, 'progress'])->name('agent.marketing.prospect.progress')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);;
    Route::get('marketing/prospect-list/download/{id}', [ProspectListController::class, 'download'])->name('agent.marketing.prospect.download');
    Route::post('marketing/prospect-list/update-save-report', [ProspectListController::class, 'updateSaveReport'])->name('agent.marketing.prospect.update.save.report');

    //View generate center list
    Route::get('marketing/prospect-list/view-centerlist/{id}', [ProspectListController::class, 'viewCenterList'])->name('agent.marketing.prospect.view.centerlist');
    //print view page
    Route::get('marketing/prospect-list/print-view/{id}', [ProspectListController::class, 'printView'])->name('agent.marketing.prospect.print.view');
    //Information Package
    //Route::get('marketing/information-packages/list', [ProspectListController::class, 'informationPackageList'])->name('agent.marketing.information.package.list');



    Route::get('advertiser-profiles',function(){return view('agent.dashboard.Annalytics.advertiser-profiles');})->name('agent.advertiser-profiles');
    Route::get('analytic-profiles-list-ajax/{advertiserType}', [AnalyticsController::class, 'analytic_profiles_list_ajax'])->name('agent.analytic-profiles-list-ajax');



    //Demo
    Route::get('marketing/prospect-list/demo1', function(){
       return view('agent.dashboard.marketing.modal.doc1');
    });

    //Testing generate PDF using HTML
    Route::get('marketing/prospect-list/demo-pdf', [ProspectListController::class, 'testPDF']);
    Route::post('marketing/prospect-list/generate-pdf-demo', [ProspectListController::class, 'pdfGenerate'])->name('pdf.generate');
 

    //Save Report
    Route::get('marketing/save-report/report-list', [ProspectListController::class, 'saveReportList'])->name('agent.marketing.save.report.list');
    Route::get('marketing/save-report/view-appointment-list/{id}', [ProspectListController::class, 'appointmentList'])->name('agent.marketing.save.report.appointment.list');
    //search Center using id
    Route::post('marketing/save-report/search-center-by-id', [ProspectListController::class, 'searchCenterById'])->name('agent.marketing.save.report.search.center');
    
/*      Route::get('advertiser-list',function(){
        return view('agent.dashboard.Advertisers.advertiser-list');
     })->name('agent.advertiser-list'); */
    Route::get('/advertiser-list', [AgentRequestController::class, 'advertiserList'])->name('agent.advertiser-list');
    Route::get('/accepted_advertiser_datatable', [AgentRequestController::class, 'accepted_advertiser_datatable'])->name('agent.accepted_advertiser_datatable');

    //Fee summary
    Route::get('fees/summary', [FeesSummaryController::class, 'feesSummary'])->name('agent.fees.summary');
    Route::get('single-advertiser-fees-summary', [FeesSummaryController::class, 'singleAdvertiserFeeSummary'])->name('single-advertiser-summary');
    Route::get('advertiser/fees/summery', [FeesSummaryController::class, 'fetchFeeSummeryAdvertiserData'])->name('agent.advertiser.fees.summary');
     
    Route::get('/multi-merge-report',function(){
    return view('agent.dashboard.marketing.multi-merge-report');
})->name('agent.multi-merge-report');

    Route::get('/single-merge-report',function(){
    return view('agent.dashboard.marketing.single-merge-report');
})->name('agent.single-merge-report');


    Route::get('advertiser-social-media',function(){
    return view('agent.dashboard.Annalytics.advertiser-social-media');
})->name('agent.advertiser-social-media');

    Route::get('prospets-memberships',function(){
    return view('agent.dashboard.Annalytics.prospets-memberships');
})->name('agent.prospets-memberships');

Route::get('toursummary',function(){
    return view('agent.dashboard.Annalytics.toursummary');
})->name('agent.toursummary');


//     Route::get('Marketing/create-prospect',function(){
//     return view('agent.dashboard.marketing.create-prospect');
// })->name('marketing.agencreate-prospect');



Route::get('Marketing/printreport',function(){
    return view('agent.dashboard.marketing.printreport');
})->name('printreport');


Route::get('agent-messages',function(){
    return view('agent.dashboard.agent-messages');
})->name('agent.agent-messages');



Route::get('guidelines',function(){
    return view('agent.dashboard.Communication.guidelines');
})->name('agent.guidelines');


Route::get('forms',function(){
    return view('agent.dashboard.Communication.forms');
})->name('agent.forms');


    //     Route::get('Fees/summary',function(){
    //     return view('agent.dashboard.Fees.summary');
    // })->name('Fees.summary');




Route::get('my-statistics',function(){
    return view('agent.dashboard.my-statistics');
})->name('agent.my-statistics');

Route::get('advertisers',function(){
    return view('agent.dashboard.advertisers');
})->name('agent.advertisers');







// Route::get('Marketing/database-centers',function(){
//     return view('agent.dashboard.marketing.database-centers');
// })->name('agent.database-centers');

// Route::get('Marketing/saved-reports',function(){
//     return view('agent.dashboard.marketing.saved-reports');
// })->name('agent.saved-reports');


// Route::get('notifications-and-features',function(){
//     return view('agent.dashboard.notifications-and-features');
// })->name('agent.notifications-and-features');

Route::get('notifications-and-features',[AgentController::class,'notificationsFeatures'])->name('agent.notifications-and-features');
Route::post('/update-notifications-features', [AgentController::class, 'updateNotificationsFeatures'])->name('agent.update_notifications');

Route::get('agent-task-list',[AgentTaskController::class,'index'])->name('agent.task-list'); 



# Agent tasks
Route::get('/agent/task-fetch',[AgentTaskController::class,'fetchTask'])->name('agent.dashboard.ajax-fetch-task');
Route::post('agent/task-add',[AgentTaskController::class,'addTask'])->name('agent.dashboard.ajax-add-task');
Route::post('agent/task-edit',[AgentTaskController::class,'editTask'])->name('agent.dashboard.ajax-edit-task');
Route::post('agent/task-update',[AgentTaskController::class,'updateTask'])->name('agent.dashboard.ajax-update-task');
Route::post('agent/task-status',[AgentTaskController::class,'statusTask'])->name('agent.dashboard.ajax-change-status');
Route::post('agent/task-open',[AgentTaskController::class,'openTask'])->name('agent.dashboard.ajax-open-task');
Route::post('agent/task-delete',[AgentTaskController::class,'destroy'])->name('agent.dashboard.ajax-delete-task');

Route::get('pricingsummaries',[PricingsummariesController::class ,'showPricingsummary'])->name('pricingsummaries');
Route::get('pricingsummaries-datatable',[PricingsummariesController::class ,'PricingDataTable'])->name('agent.myPricing.dataTable');
Route::post('update-pricing-detail',[PricingsummariesController::class ,'storePricingDetail'])->name('agent.save.pricing.details');
Route::get('calculate-reckoner',[PricingsummariesController::class ,'showPricingsummary'])->name('pricingsummaries');
Route::post('calculate-reckoner', [PricingsummariesController::class, 'calculate'])->name('agent.reckoner-calculate');


Route::get('bank_account',[AgentAccountController::class,'bankDetails'])->name('bank_account');
Route::post('save-bank-details',[AgentAccountController::class,'saveBankDetails'])->name('agent.save.bank.details');
Route::post('check-bank-otp',[AgentAccountController::class,'checkOTP'])->name('agent.checkOTP');
Route::post('delete-agent-bank',[AgentAccountController::class,'deleteAgentBank'])->name('agent.delete-agent-bank');
Route::get('bank-details',[AgentAccountController::class,'BankDataTable'])->name('agent.bankDetail.dataTable');

Route::post('agent-state-name/{id}',[AgentController::class, 'nameByState'])->name('agent.stateId');

////////////tour payment status

Route::post('tour-paymentUrl/{id}',[AgentTourPaymentController::class,'polyPaymentUrl'])->name('agent.tour.paymentUrl');
Route::post('tour-eidt-paymentUrl/{id}',[AgentTourPaymentController::class,'EditPolyPaymentUrl'])->name('agent.tour.edit.paymentUrl');
Route::get('tour-paymentUrl-status-success/{id}/{uid}',[AgentTourPaymentController::class,'successUrl'])->name('agent.tour.paymentUrl.status.success');
Route::get('tour-paymentUrl-status-FailureURL/{id}/{uid}',[AgentTourPaymentController::class,'FailureURL'])->name('agent.tour.paymentUrl.status.FailureURL');
Route::get('tour-paymentUrl-status-CancellationURL/{id}/{uid}',[AgentTourPaymentController::class,'CancellationURL'])->name('agent.tour.paymentUrl.status.CancellationURL');
Route::get('tour-paymentUrl-status-NotificationURL/{id}/{uid}',[AgentTourPaymentController::class,'NotificationURL'])->name('agent.tour.paymentUrl.status.NotificationURL');
///escort profile by agent
Route::get('create-profile/{id?}',[CreateController::class,'agentIndex'])->name('agent.profile');
Route::get('profile/{id}/{uid}',[UpdateController::class,'agentUpdateProfile'])->name('agentby.update.profile');
Route::post('agentByprofile-poli-paymentUrl/{id}',[EscortPolyPaymentController::class,'AgentPolyPaymentUrl'])->name('agent.poli.paymentUrl');
Route::post('setting-profile/{id?}/{uid?}',[UpdateController::class,'agentCreateBySetting'])->name('agent.setting.profile');
Route::post('states-by-cities/{id}', [CreateController::class, 'cities'])->name('agent.stateByCity');


Route::get('profileByAgent-paymentUrl-status-success/{id}',[EscortPolyPaymentController::class,'successUrl_ByAgent'])->name('agent.poly.paymentUrl.status.success');
Route::get('profileByAgent-paymentUrl-status-FailureURL/{id}',[EscortPolyPaymentController::class,'FailureURL_ByAgent'])->name('agent.poly.paymentUrl.status.FailureURL');
Route::get('profileByAgent-paymentUrl-status-CancellationURL/{id}',[EscortPolyPaymentController::class,'CancellationURL_ByAgent'])->name('agent.poly.paymentUrl.status.CancellationURL');
Route::get('profileByAgent-paymentUrl-status-NotificationURL/{id}',[EscortPolyPaymentController::class,'NotificationURL_ByAgent'])->name('agent.poly.paymentUrl.status.NotificationURL');
Route::post('get-default-photos/{id}', [EscortGalleryController ::class, 'agentgetDefaultImages'])->name('agent.get.default.images');


// Upload the avatar
Route::get('upload-avatar', [AgentController::class, 'uploadAvatar'])->name('upload-avatar');
Route::post('agent-save-avatar/{id}', [AgentController::class, 'agentSaveAvatar'])->name('agent.save.avatar');
Route::post('remove-avatar',[AgentController::class, 'agentRemoveAvatar'])->name('agent.avatar.remove');



Route::get('logs-and-status', [AgentDashboardController::class, 'LogsAndStatus'])->name('agent.logs-and-status');
Route::post('agent-update-password-duration', [AgentDashboardController::class, 'updatePasswordDuration'])->name('agent.update.password.duration');

//Appointment Planner
Route::get('my-appointments', [AppointmentController::class, 'index'])->name('agent.my.appointment.list');
Route::get('appointment-booking-list', [AppointmentController::class, 'appointmentBookingList'])->name('agent.appointment.booking.list');
Route::get('appointment-calendar-events', [AppointmentController::class, 'calendarEvents'])->name('agent.appointment.calendar.events');
Route::get('appointment-count-day-week-month', [AppointmentController::class, 'appointmentcountDayWeekMonth'])->name('agent.appointment.count.day.week.month');
Route::get('appointment-details/{id}', [AppointmentController::class, 'appointmentDetails'])->name('agent.appointment.details');
Route::get('get-advertiser',[AppointmentController::class, 'getAdverser'])->name('get.adverser');
Route::get('/get-slots', [AppointmentController::class, 'getSlotList'])->name('get.slot.list');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('agent.appointments.store');
Route::get('/appointments/datatable', [AppointmentController::class, 'datatable'])->name('agent.appointments.datatable');
Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('agent.appointments.show');
Route::post('/appointments/{id}', [AppointmentController::class, 'update'])->name('agent.appointments.update');
Route::post('/appointments/{id}/reschedule', [AppointmentController::class, 'reschedule'])->name('agent.appointments.reschedule');
Route::post('/appointments/{id}/complete', [AppointmentController::class, 'complete'])->name('agent.appointments.complete');
Route::get('/appointments-count', [AppointmentController::class, 'appointmentCount'])->name('agent.appointment.count');
Route::get('/appointment-pdf-download/{id}', [AppointmentController::class, 'appointmentPdfDownload'])->name('agent.appointment.pdf.download');
Route::get('/dashboard/notifications', [\App\Http\Controllers\Agent\AppointmentController::class, 'showAgentNotifications'])->name('agent.dashboard.notifications');
Route::get('/dashboard/notifications/datatable', [\App\Http\Controllers\Agent\AppointmentController::class, 'notificationsDatatable'])->name('agent.dashboard.notifications.datatable');
Route::get('/switch-login/{id}', [ImpersonateController::class, 'switchLogin'])->name('agent.switch-to-child');
Route::get('/back-to-parent', [ImpersonateController::class, 'backToParent'])->name('agent.back-to-parent');

Route::get('fees/monthly-report', [MonthlyReportController::class, 'monthlyReport'])->name('Fees.monthly-report');
Route::get('fees/monthly-report-list', [MonthlyReportController::class, 'monthlyReportAjax'])->name('agent.fees.monthly-report-ajax');
Route::post('fees/view-monthly-report', [MonthlyReportController::class, 'viewMonthlyReport'])->name('agent.fees.view.detail');
Route::post('fees/update-monthly-report', [MonthlyReportController::class, 'updateMonthlyReportStatus'])->name('agent.fees.update.status.detail');
Route::post('fees/print-monthly-report', [MonthlyReportController::class, 'printMonthlyFee'])->name('agent.print.monthly.fee');
Route::post('fees/query', [MonthlyReportController::class, 'viewQuery'])->name('agent.fees.view.query');

Route::get('fees/my-income', [MonthlyReportController::class, 'myIncome'])->name('Fees.my-income');




