<?php

use App\Http\Controllers\AccountSettingController;
use App\Http\Controllers\Admin\GlobalMonitoringController;
use App\Http\Controllers\Admin\ManagePeopleStaffController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\AdvertiserSpamReportController;
use App\Http\Controllers\Agent\AgentAccountController;
use App\Http\Controllers\Agent\AgentRegisterController;
use App\Http\Controllers\Agent\AgentRequestController;
use App\Http\Controllers\Auth\Advertiser\LoginController as AdvertiserLoginController;
use App\Http\Controllers\Auth\Advertiser\RegisterController as AdvertiserRegisterController;
use App\Http\Controllers\Auth\RegisterController  as GuestRegisterController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\Center\CenterController;
use App\Http\Controllers\Center\Profile\MassageController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Escort\Auth\LoginController as EscortLogin;
use App\Http\Controllers\Escort\ConciergeController;
use App\Http\Controllers\Escort\EscortController;
use App\Http\Controllers\Escort\EscortMyLegboxViewerController;
use App\Http\Controllers\Escort\EscortStatisticsController;
use App\Http\Controllers\Escort\EscortTourScheduleContoller;
use App\Http\Controllers\Escort\EscortViewerInteractionController;
use App\Http\Controllers\Escort\MyPlaymatesContoller;
use App\Http\Controllers\Escort\PinUpsController;
use App\Http\Controllers\GetCurrentUserGeolocationController;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\MassageCentre;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSetting;
use App\Http\Controllers\ReportMassageController;
use App\Http\Controllers\SupportTicketsController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\Dashboard\UserController;
use App\Http\Controllers\Viewer\ViewerController;
use App\Http\Controllers\Viewer\ViewerEscortInteractionController;
use App\Http\Controllers\Viewer\ViewerMassageInteractionController;
use App\Http\Controllers\Viewer\ViewerPrefrenceController;
use App\Http\Controllers\Viewer\ViewerTaskListController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\PageController;
use App\Mail\sendPlaymateAccountDisableMail;
use App\Models\Pricing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\ImpersonateController;
use App\Http\Controllers\Viewer\PunterBoxController;
use App\Http\Controllers\Viewer\ViewerReviewsController;
use App\Http\Controllers\Escort\EscortAccountController;
/*
|--------------------------------------------------------------------------
| Web Routes    
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', [RegisterController::class,'home'])->name('home');

############## Guest Url ####################
Route::middleware('guest')->group(function () {

    Route::get('/login', function () {
        return redirect('/');
    })->name('login');
    Route::get('/advertiser-login', [AdvertiserLoginController::class, 'index'])->name('advertiser.login');
    Route::get('/viewer-login', [AdvertiserLoginController::class, 'indexViewer'])->name('viewer.login');
    //Route::get('/agent-login', [AdvertiserLoginController::class,'indexAgent'])->name('agent.login');
    Route::match(array('GET', 'POST'), '/agent-login', [AdvertiserLoginController::class, 'indexAgent'])->name('agent.login');
    Route::get('/register', [GuestRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/staff-login', [AdvertiserLoginController::class, 'indexStaff'])->name('staff.login');
});

############## End Put All Guest Url Here ####################

Route::post('update-bank-pin', [EscortAccountController::class, 'updateBankPin'])->name('web.update.bank.pin');
Route::post('/get-pinup-profile', [PinUpsController::class, 'getPinupProfile'])->name('web.get_pinup_profile');
Route::post('/welcome-popup-closed', [UserController::class, 'welcomePopupClosed'])->name('welcome-popup-closed');
Route::middleware('auth')->group(function () {

    ################ All Authencated User Url #################################
    Route::prefix('user-dashboard')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.dashboard');
        // Route::get('/edit-profile', [UserController::class, 'edit'])->name('user.edit');
        Route::get('/update-account', [UserController::class, 'edit'])->name('user.account.edit');
        Route::post('/update-account', [UserController::class, 'update'])->name('user.account.update');
        Route::get('/upload-my-avatar', [UserController::class, 'uploadAvatar'])->name('user.profile.avatar');
        Route::get('/change-password', [UserController::class, 'editPassword'])->name('user.change.password');
        Route::post('/change-password', [UserController::class, 'updatePassword'])->name('user.update.password');
        Route::post('/change-password-expiry', [UserController::class, 'updatePasswordExpiry'])->name('user.update.password.expiry');
        Route::get('/notifications-features', [UserController::class, 'notificationsFeatures'])->name('user.profile.notifications');
        Route::get('/legbox-notification-list', [NotificationController::class, 'legbox_notification_list'])->name('user.legbox-notification-list');
        Route::post('/enable-disable-legbox-notification', [NotificationController::class, 'enable_disable_legbox_notification'])->name('user.enable-disable-legbox-notification');

        Route::post('update-notification-setting', [AccountSettingController::class, 'viewer_update_setting'])->name('user.update_notification_setting');

        Route::post('upload-avatar/{id}', [UserController::class, 'storeMyAvatar'])->name('user.save.avatar');
        Route::post('remove-avatar', [UserController::class, 'removeMyAvatar'])->name('user.avatar.remove');
        Route::post('/update-profile/{id}', [UserController::class, 'update'])->name('user.update.profile');
        Route::get('/update-available-playmate', [UserController::class, 'updateAvailablePlaymate'])->name('user.update.playmate');


        Route::get('/escort-list', [UserController::class, 'myLegboxList'])->name('user.legbox.escort-list');
        Route::get('/my-legbox-list', [UserController::class, 'myLegboxList'])->name('user.legbox.list');
        Route::get('/massage', [UserController::class, 'massageLegboxList'])->name('user.massage.legbox.list');
        Route::post('/save-my-legbox/{id}', [UserController::class, 'saveMyLegbox'])->name('user.save.legbox');
        Route::post('/delete-my-legbox/{id}', [UserController::class, 'deleteMyLegbox'])->name('user.delete.legbox');
        //massage legbox
        Route::post('/save-my-massage-legbox/{id}', [UserController::class, 'saveMyMassageLegbox'])->name('user.save.massage.legbox');
        Route::post('/delete-my-massage-legbox/{id}', [UserController::class, 'deleteMyMassageLegbox'])->name('user.delete.massage.legbox');

        Route::get('/delete-legbox/{id}', [UserController::class, 'deleteLegbox'])->name('user.console.delete.legbox');
        Route::get('/legbox-listing', [UserController::class, 'legboxDataTable'])->name('user.legbox.dataTable');
        Route::get('/massage-legbox-listing', [UserController::class, 'legboxMassageDataTable'])->name('user.legbox.massagedataTable');




        Route::get('/my-legbox-notes', function () {
            return view('user.dashboard.legbox.notes');
        })->name('user.notes');

        Route::get('/submitticket', function () {
            return view('user.dashboard.supportticket.submitticket');
        });
        Route::get('/view-and-reply-ticket', function () {
            return view('user.dashboard.supportticket.view-and-reply-ticket');
        })->name('user.view-and-reply-ticket');

        Route::get('/abbreviations', function () {
            return view('user.dashboard.Community.abbreviations');
        })->name('user.abbreviations');

        Route::get('/communication', function () {
            return view('user.dashboard.communication.advertiser');
        })->name('user.advertiser');

        Route::get('/laws', function () {
            return view('user.dashboard.Community.laws');
        })->name('user.laws');

        Route::get('/Community', function () {
            return view('user.dashboard.Community.help');
        })->name('user.help');


        Route::get('/viewer-statistics', function () {
            return view('user.dashboard.viewer-statistics');
        })->name('user.viewer-statistics');

        # Escort viewer interaction routes
        Route::get('/my-legbox/{type?}', [EscortMyLegboxViewerController::class, 'dashboard'])->name('user.my-legbox');
        Route::get('/my-escort-legbox-ajax', [EscortMyLegboxViewerController::class, 'escortViewersAjaxList'])->name('escort.viewer-legbox-list');
        Route::post('/escort/viewer-interaction-update', [EscortViewerInteractionController::class, 'escortUpdateViewerInteraction'])->name('escort.viewer-interaction.update');

        # Viewer escort interaction routes
        Route::get('/my-viwer-escort-legbox-ajax', [ViewerEscortInteractionController::class, 'dashboardEscortListAjax'])->name('user.my-legbox-escort-list');
        Route::get('/my-viewer-escort-legbox-ajax', [ViewerEscortInteractionController::class, 'viewersEscortAjaxList'])->name('viewer.escort-legbox-list');
        Route::post('/viewer/escort-interaction-update', [ViewerEscortInteractionController::class, 'viewerUpdateEscortInteraction'])->name('viewer.escort-interaction.update');
        Route::get('/viewer/escort-profile-view/{id?}', [GlobalMonitoringController::class, 'dataTableSingleListingAjax'])->name('viewer.escort.profile-view');
        Route::post('/viewer/escort-remove-from-legbox', [ViewerEscortInteractionController::class, 'viewerRemoveEscortFromLegbox'])->name('viewer.escort-remove');

        # Viewer massage interaction routes
        Route::get('/my-viwer-massage-legbox-ajax', [ViewerMassageInteractionController::class, 'dashboardMassageListAjax'])->name('user.my-legbox-massage-list');
        Route::get('/my-viewer-massage-legbox-ajax', [ViewerMassageInteractionController::class, 'viewersMassageAjaxList'])->name('viewer.massage-legbox-list');
        Route::post('/viewer/massage-interaction-update', [ViewerMassageInteractionController::class, 'viewerUpdateMassageInteraction'])->name('viewer.massage-interaction.update');
        Route::get('/viewer/massage-profile-view/{id?}', [ViewerMassageInteractionController::class, 'dataTableSingleMassageListingAjax'])->name('viewer.massage.profile-view');
        Route::post('/viewer/massage-remove-from-legbox', [ViewerMassageInteractionController::class, 'viewerRemoveMassageFromLegbox'])->name('viewer.massage-remove');

        # Dashboard Logs & Status
        Route::get('logs-and-statistics', [ViewerController::class, 'logsAndStatistics'])->name('user.logs-and-statistics');
        Route::post('update-password-duration', [ViewerController::class, 'updatePasswordDuration'])->name('user.update.password.duration');

        # View tasks list
        Route::get('task-list', [ViewerTaskListController::class, 'index'])->name('viewer.task-list');
        Route::get('task-fetch', [ViewerTaskListController::class, 'fetchTask'])->name('viewer.dashboard.ajax-fetch-task');
        Route::post('task-add', [ViewerTaskListController::class, 'addTask'])->name('viewer.dashboard.ajax-add-task');
        Route::post('task-edit', [ViewerTaskListController::class, 'editTask'])->name('viewer.dashboard.ajax-edit-task');
        Route::post('task-update', [ViewerTaskListController::class, 'updateTask'])->name('viewer.dashboard.ajax-update-task');
        Route::post('task-status', [ViewerTaskListController::class, 'statusTask'])->name('viewer.dashboard.ajax-change-status');
        Route::post('task-open', [ViewerTaskListController::class, 'openTask'])->name('viewer.dashboard.ajax-open-task');
        Route::post('task-delete', [ViewerTaskListController::class, 'destroy'])->name('viewer.dashboard.ajax-delete-task');


        # Dashboard > Favorites Online
        Route::get('favorites-online', [UserController::class, 'favoritesOnline'])->name('user.favorites-online');


        // Route::get('/favorites-online',function(){
        //     return view('user.dashboard.favorites-online');
        // })->name('user.favorites-online');

        Route::get('/punterbox', function () {
            return view('user.dashboard.punterbox');
        })->name('user.punterbox');

        // Route::get('/logs-and-statistics',function(){ return view('user.dashboard.logs-and-statistics');})->name('user.logs-and-statistics');

        Route::get('/my-statistics', function () {
            return view('user.dashboard.my-statistics');
        })->name('user.my-statistics');

        // Route::get('/task-list',function(){
        //     return view('user.dashboard.task-list');
        // })->name('user.task-list');


        Route::get('/guide', function () {
            return view('user.dashboard.Community.guide');
        })->name('user.guide');

        Route::get('/notebox/new', function () {
            return view('user.dashboard.notebox.new');
        })->name('user.new');

        Route::get('/notebox/list', function () {
            return view('user.dashboard.notebox.list');
        })->name('user.list');

        Route::get('/notebox/edit', function () {
            return view('user.dashboard.notebox.edit-notebox');
        })->name('user.edit-notebox');

        Route::get('/punterbox/dashboard', function () {
            return view('user.dashboard.punterbox.dashboard');
        })->name('user.punterbox.dashboard');

        Route::get('/punterbox/add-report', [PunterBoxController::class, 'addReport'])->name('user.add-report');
        Route::post('add-report', [PunterBoxController::class, 'storeReport'])->name('user.store-report');
        Route::get('my-reports', [PunterBoxController::class, 'showMyReportByAjax'])->name('user.my-reports');
        Route::get('edit-my-reports/{id}', [PunterBoxController::class, 'editMyReport'])->name('user.edit-my-reports');
        Route::post('update-my-reports', [PunterBoxController::class, 'updateMyReportByAjax'])->name('user.update-my-reports');
        Route::delete('my-report/{id}', [PunterBoxController::class, 'destroy'])->name('user.my-report.delete');
        Route::get('num-dashboard', [PunterBoxController::class, 'showReportOnDashboardAjax'])->name('user.punterboxdashboard');


        Route::get('/punterbox/my-report', function () {
            return view('user.dashboard.punterbox.my-report');
        })->name('user.my-report');

        Route::get('/punterbox/code-of-conduct', function () {
            return view('user.dashboard.punterbox.code-of-conduct');
        })->name('user.code-of-conduct');

        Route::get('/change-features', [AccountSettingController::class, 'get_viewer_features'])->name('change-features');
        Route::post('/change-features', [AccountSettingController::class, 'viewer_change_features'])->name('change-features');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('view-reviews', [ViewerReviewsController::class, 'viewReviews'])->name('user.view-reviews');
        Route::get('reviews-by-ajax', [ViewerReviewsController::class, 'getProfileReviewsByAjax'])->name('user.reviews-profile-by-ajax');
        Route::post('user-review-status-update', [ViewerReviewsController::class, "updateUserReviewStatus"])->name('user.user-review-status-update');
        Route::get('get-user-review-details/{id}', [ViewerReviewsController::class, "getSingleUserReviewDetails"])->name('user.get-single-user-review-details');
    });
    ################ End All Authencated User Url #################################
    Route::get('back-to-agent', [ImpersonateController::class, 'backToParent'])->name('agent.back-to-parent');
});

Route::post('state-name', [App\Http\Controllers\HomeController::class, 'getGioLocation'])->name('web.state.name');


//**************SUPPORT TICKET*******************//
Route::get('submit_ticket', [SupportTicketsController::class, 'create'])->name('support-ticket.form_create');
Route::post('submit_ticket', [SupportTicketsController::class, 'submit_ticket'])->name('support-ticket.create');
Route::get('support_tickets/ticket-list/{id?}', [SupportTicketsController::class, 'index'])->name('support-ticket.list');
Route::get('support_tickets/dataTable', [SupportTicketsController::class, 'dataTable'])->name('support-ticket.dataTable');
Route::get('support_tickets/conversations/{id?}', [SupportTicketsController::class, 'conversations'])->name('support-ticket.conversations');
Route::put('support_tickets/withdraw/{id}', [SupportTicketsController::class, 'withdraw'])->name('support-ticket.withdraw');
Route::post('support_tickets/save_message', [SupportTicketsController::class, 'save_message'])->name('support-ticket.saveMessage');

Route::get('contact-us', [ContactUsController::class, 'index'])->name('contactus.index');
Route::post('contact-us-send', [ContactUsController::class, 'sendContact'])->name('contactus.send');



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'intendedRedirect'])->name('dashboard');

Route::get('country-list', [App\Http\Controllers\CountryController::class, 'countryList'])->name('country.list');
Route::get('city-list', [App\Http\Controllers\CityController::class, 'cityList'])->name('city.list');
Route::get('select-city-list', [App\Http\Controllers\CityController::class, 'SelectedCityList'])->name('selected.cities.list');
Route::get('state-list', [App\Http\Controllers\StateController::class, 'stateList'])->name('state.list');

//Route::get('/escorts', [App\Http\Controllers\HomeController::class, 'intendedRedirect'])->name('dashboard');

Route::get('/dmca', [App\Http\Controllers\HomeController::class, 'noticeDmca'])->name('notice.dmca');
Route::get('/influencer', [InfluencerController::class, 'becomeInfluencer'])->name('become.influencer');
Route::post('/save-influencer', [InfluencerController::class, 'store'])->name('store.influencer');



/********** Advertiser **********/
Route::get('/agent-register', [AgentRegisterController::class, 'index'])->name('agent.register');
Route::post('/agent-register', [AgentRegisterController::class, 'register']);

Route::get('/advertiser-register', [AdvertiserRegisterController::class, 'index'])->name('advertiser.register');
Route::post('/advertiser-register', [AdvertiserRegisterController::class, 'register']);
Route::post('/check-otp', [AdvertiserLoginController::class, 'checkOTP'])->name('web.checkOTP');
Route::post('send-otp-for-pin-change', [AdvertiserLoginController::class, 'sendOtpForPinChange'])->name('send-otp-for-pin-change');



Route::get('/advertiser-forgot', [AdvertiserLoginController::class, 'forgotpassword'])->name('advertiser.forgot');

Route::get('/viewer-forgot/{token?}', [AdvertiserLoginController::class, 'viewerForgotPassword'])->name('viewer.forgot');
Route::get('/agent-forgot/{token?}', [AdvertiserLoginController::class, 'agentForgotPassword'])->name('agent.forgot');
Route::get('/admin-forgot/{token?}', [AdvertiserLoginController::class, 'adminForgotPassword'])->name('admin.forgot');
Route::get('/advertiser-forgot/{token?}', [AdvertiserLoginController::class, 'escortForgotPassword'])->name('escort.forgot');
//Route::post('/reset-forgot', [AdvertiserLoginController::class,'viewerResetPassword'])->name('web.reset.password.viewer');
Route::post('/reset-forgot', [App\Http\Controllers\SendForgotPasswordController::class, 'viewerResetPassword'])->name('web.reset.password.viewer');
Route::get('/staff-forgot/{token?}', [AdvertiserLoginController::class, 'staffForgotPassword'])->name('staff.forgot');

Route::post('/advertiser-login', [AdvertiserLoginController::class, 'login']);
Route::post('/advertiser-logout', [AdvertiserLoginController::class, 'logout'])->name('advertiser.logout');
//this url no longer used. 
Route::get('/all-escorts-list', [App\Http\Controllers\WebController::class, 'allEscortList'])->name('find.all');
// Route::get('/all-escorts-list/{gender?}', [App\Http\Controllers\WebController::class,'allEscortList'])->name('find.all');

//Route::get('/search-filter', [App\Http\Controllers\WebController::class,'searchfilter'])->name('web.search.filter');
Route::post('/location/filter', [App\Http\Controllers\WebController::class, 'filterLocation'])->name('location.filter');


Route::get('/grid-escort-list', [App\Http\Controllers\WebController::class, 'gridEscortList'])->name('grid.escort.list');

/****************************************************all-escorts-list**********************************************/
Route::get('/all-escorts-listing', [App\Http\Controllers\EscortListingController::class, 'allEscortListing'])->name('public.web.escort.listing');
Route::get('/fetch-escort-services', [App\Http\Controllers\EscortListingController::class, 'fetchEscortServices'])->name('public.web.fecth.services');
// New route 
Route::post('/escort-add-to-shortlist/{id}', [App\Http\Controllers\EscortListingController::class, 'addtocart'])->name('web.public.save.addtocart');
Route::post('/escort-remove-shortlist', [App\Http\Controllers\EscortListingController::class, 'removeShortList'])->name('web.public.remove.shortlist');
Route::get('/escort-clear-short-list', [App\Http\Controllers\EscortListingController::class, 'clearShortList'])->name('web.public.shortlist.clear');



/********** ADMIN **********/
Route::get('admin-login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin-login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
Route::post('/admin-logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

/********** Operator **********/
Route::get('operator-login', [App\Http\Controllers\Admin\AuthController::class, 'showOperatorLoginForm'])->name('operator.login');
Route::post('/operator-login', [App\Http\Controllers\Admin\AuthController::class, 'operatorLogin']);
Route::post('/operator-logout', [App\Http\Controllers\Admin\AuthController::class, 'OperatorLogout'])->name('operator.logout');


/********** Shareholder Login **********/
Route::get('shareholder-login', [App\Http\Controllers\Admin\AuthController::class, 'showShareholderLoginForm'])->name('shareholder.login');


/************ END ************/
// start shortlist
Route::post('/shortlist', [App\Http\Controllers\WebController::class, 'saveShortList'])->name('web.save.shortlist'); //currently this route is not working.
Route::post('/add-to-shortlist/{id}', [App\Http\Controllers\WebController::class, 'addtocart'])->name('web.save.addtocart'); // remove after working new route.
Route::post('/remove-shortlist', [App\Http\Controllers\WebController::class, 'removeShortList'])->name('web.remove.shortlist'); // remove after working new route.
//end shortlist


Route::get('/my-shortlist', [App\Http\Controllers\WebController::class, 'shortList'])->name('web.show.shortlist');
Route::get('/showList', [App\Http\Controllers\WebController::class, 'showAddList'])->name('web.show.showAddList');
Route::get('/clear-short-list', [App\Http\Controllers\WebController::class, 'clearShortList'])->name('shortlist.clear-list');

Route::get('admin-dashboard/e4u-cms/pages', function () {
    return view('admin.e4u-cms.pages');
})->name('admin.e4u-cms.pages');
Route::get('test_page', function () {
    return view('test_page');
});
Route::get('admin-dashboard/contact-database/advertisers', function () {
    return view('admin.contact-database.advertisers');
})->name('admin.contact-database.advertisers');
Route::get('admin-dashboard/e4u-database/escorts', function () {
    return view('admin.e4u-database.escorts');
})->name('admin.e4u-database.escorts');




/********** escort profile description **********/
Route::get('/escort-profile/{id}/{city?}/{membershipId?}', [App\Http\Controllers\WebController::class, 'profileDescription'])->name('profile.description');
Route::get('/center-profile/{id}', [App\Http\Controllers\WebController::class, 'centerProfileDescription'])->name('center.profile.description');
Route::post('/store-message/{id}', [App\Http\Controllers\Escort\MessageReviewController::class, 'saveMessage'])->name('store.message');
Route::post('/review-advertiser/{id}', [App\Http\Controllers\Escort\MessageReviewController::class, 'SaveReviewAdvertiser'])->name('review.advertiser');
Route::get('/save-advertiser-stats', [WebController::class, 'saveAdvertiserStats'])->name('save.escort.stats');

/********** Advertiser spam report by viewer **********/
Route::get('/advertiser-get-spam-report', [AdvertiserSpamReportController::class, 'getSpamReportForAdvertiser'])->name('advertiser.get.spam.report');
Route::post('/advertiser-spam-report', [AdvertiserSpamReportController::class, 'saveSpamReportForAdvertiser'])->name('advertiser.spam.report');

/*************User *********************/


Route::get('/page/{slug}', [App\Http\Controllers\WebController::class, 'showFooterLink'])->name('page.show');
Route::get('/acceptable-usage-policy', function () {
    return view('web.pages.acceptable-use-policy');
});




// Other Pages
Route::get('alerts', [WebController::class, 'alerts'])->name('alerts');

Route::get('/acceptable-usages-policy', function () {
    return view('web.pages.acceptable-usages-policy');
});
Route::get('/copyright-statement', function () {
    return view('web.pages.copyright-statement');
});
Route::get('/covid-19-statement', function () {
    return view('web.pages.covid-19-statement');
});
Route::get('/disclaimer-statement', function () {
    return view('web.pages.disclaimer-statement');
});
Route::get('/law-enforcement', function () {
    return view('web.pages.law-enforcement');
});
Route::get('/privacy-policy', function () {
    return view('web.pages.privacy-policy');
});
Route::get('/privacy-collection-notice', function () {
    return view('web.pages.privacy-collection-notice');
});
Route::get('/refund-policy', function () {
    return view('web.pages.refund-policy');
});
Route::get('/spam-policy', function () {
    return view('web.pages.spam-policy');
});

Route::get('/terms-conditions', [PageController::class, 'termsConditions'])->name('pages.terms-conditions');
Route::get('/abbreviations', function () {
    return view('web.pages.abbreviations');
});
//Route::get('/alerts', function() { return view('web.pages.alerts'); });

//Route::get('/contact-us', function() { return view('web.pages.contact-us'); })

Route::get('/etiquette', function () {
    return view('web.pages.etiquette');
});
Route::get('/faqs', function () {
    return view('web.pages.faqs');
});
Route::get('/parent-control', function () {
    return view('web.pages.parent-control');
});
Route::get('/feedback', function () {
    return view('web.pages.feedback');
});
Route::get('/thankyou', function () {
    return view('web.pages.thankyou');
})->name('feedback.thankyou');

Route::get('help-for-escorts', [App\Http\Controllers\WebController::class, 'help_for_escort'])->name('web.help-for-advertisers');

//Route::get('/help-for-escorts', function() { return view('web.pages.help-for-advertisers'); })->name('web.help-for-advertisers');


Route::get('/help-for-agents', function () {
    return view('web.pages.help-for-agents');
});
Route::get('/help-for-massage-centres', function () {
    return view('web.pages.help-for-massage-centres');
});
Route::get('/help-for-viewers', function () {
    return view('web.pages.help-for-viewers');
});

Route::get('/become-a-pin-up', [PageController::class, 'becomePinUp'])->name('page.become-pin-up');

Route::get('/agents', [PageController::class, 'agents'])->name('page.agents');

Route::get('/centres', [PageController::class, 'centres'])->name('page.centres');

Route::get('/playbox', [PageController::class, 'playbox'])->name('page.playbox');
Route::get('/escorts4U', [PageController::class, 'escorts4U'])->name('page.escorts4U');


Route::get('/e4u-verified', [PageController::class, 'e4uVerified'])->name('page.e4u-verified');

Route::get('/accommodation', [PageController::class, 'accommodation'])->name('page.accommodation');

Route::get('/email-hosting', [PageController::class, 'emailHosting'])->name('page.email-hosting');

Route::get('/mobile-read-sim', [PageController::class, 'mobileReadSim'])->name('page.mobile-read-sim');

Route::get('/professional-product', [PageController::class, 'professionalProduct'])->name('page.professional-product');

Route::get('/travel', [PageController::class, 'travel'])->name('page.travel');
// Route::get('/blogsingle', function() { return view('web.pages.blogs'); });

Route::get('/visa-migration', [PageController::class, 'visaMigration'])->name('page.visa-migration');
Route::get('/cookie-policy', function () {
    return view('web.pages.cookie-policy');
})->name('web.cookie-policy');
Route::get('/pin-up/{escort_id}', [PinUpsController::class, 'index'])->name('web.pinup');


Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs.index');
Route::post('/blogs-list', [BlogsController::class, 'blogsList'])->name('blogs.list');

Route::get('/blogs-detail/{slug}', [BlogsController::class, 'blogsDetail'])->name('blogs.detail');


Route::post('/mobile-read-sim', [ConciergeController::class, 'mobileReadSim'])->name('mobile-read-sim');
Route::post('/mobile-order-sim-payment', [ConciergeController::class, 'mobileOrderSimPayment'])->name('mobile-order-sim-payment');

Route::post('/feedback-data', [App\Http\Controllers\FeedbackController::class, 'showOption'])->name('web.option');
Route::post('/feedback', [App\Http\Controllers\FeedbackController::class, 'store'])->name('web.feedback.save');
Route::post('/viewer-send-mail-forgot-passord', [App\Http\Controllers\SendForgotPasswordController::class, 'sendMail'])->name('web.sendMail.viewer');
Route::post('/send-mail-forgot-passord', [App\Http\Controllers\SendForgotPasswordController::class, 'sendMail'])->name('web.sendMail.agent');
Route::post('/escort-send-mail-forgot-passord', [App\Http\Controllers\SendForgotPasswordController::class, 'sendMail'])->name('web.sendMail.escort');
Route::post('/admin-send-mail-forgot-passord', [App\Http\Controllers\SendForgotPasswordController::class, 'sendMail'])->name('web.sendMail.admin');
Route::post('/staff-send-mail-forgot-passord', [App\Http\Controllers\SendForgotPasswordController::class, 'sendMail'])->name('web.sendMail.staff');
Route::post('/asend-otpt-passord', [App\Http\Controllers\SendForgotPasswordController::class, 'sendOtp'])->name('web.send.otp');


Route::post('/like-dislike', [App\Http\Controllers\WebController::class, 'likeDislike'])->name('web.likeDislike');



Route::post('/add-to-massage-shortlist/{id}', [App\Http\Controllers\WebController::class, 'addToMcCart'])->name('web.save.mcMyShortListCart');
Route::post('/massage-shortlist', [App\Http\Controllers\WebController::class, 'saveMcShortList'])->name('web.save.mc.shortlist');
Route::post('/remove-massage-shortlist', [App\Http\Controllers\WebController::class, 'removeToMcCart'])->name('web.remove.mcMyShortListCart');
Route::get('/massage-show-list', [App\Http\Controllers\WebController::class, 'mcMyShortList'])->name('web.massage-show-list');

// Route::get('/massage-show-list', function()
// 	{
// 		return view('web.massage-show-list');
// 	})->name('web.massage-show-list');








Route::get('pricing', function () {
    return view('user.dashboard.Community.pricing');
})->name('user.dashboard.Community.pricing');



Route::get('agent-dashboard/submitticket', function () {
    return view('agent.dashboard.supportticket.submitticket');
})->name('submitticket');

Route::get('/agent-dashboard/abbreviations', function () {
    return view('agent.dashboard.Community.abbreviations');
})->name('agent.abbreviations');


Route::get('/escort-dashboard/my-playbox', function () {
    return view('escort.dashboard.my-playbox');
})->name('escort.dashboard.my-playbox');

Route::get('/escort-dashboard/my-legbox-viewers', [EscortMyLegboxViewerController::class, 'index'])->name('escort.dashboard.my-legbox-viewers');

Route::get('/escort-dashboard/agent-messages', function () {
    return view('escort.dashboard.agent-messages');
})->name('escort.dashboard.agent-messages');

Route::get('/escort-dashboard/viewers-messages', function () {
    return view('escort.dashboard.viewers-messages');
})->name('escort.dashboard.viewers-messages');

Route::get('/user-dashboard/viewer-messages', function () {
    return view('user.dashboard.communication.viewer-messages');
})->name('user.viewer-messages');



Route::get('/escort-dashboard/my-spend', function () {
    return view('escort.dashboard.my-spend');
})->name('escort.dashboard.my-spend');

Route::get('/escort-dashboard/tour-schedule', [EscortTourScheduleContoller::class, 'index'])->name('escort.dashboard.tour-schedule');
Route::get('/escort-dashboard/tour-schedule-ajax', [EscortTourScheduleContoller::class, 'tourScheduleAjax'])->name('escort.dashboard.tour-schedule-ajax');


// Route::get('/escort-dashboard/tour-schedule',function(){
//     return view('escort.dashboard.tour-schedule');
// })->name('escort.dashboard.tour-schedule');

Route::get('/escort-dashboard/help', function () {
    return view('escort.dashboard.Community.help');
})->name('escort.dashboard.Community.help');

Route::get('/escort-dashboard/laws', function () {
    return view('escort.dashboard.Community.laws');
})->name('escort.dashboard.Community.laws');



Route::get('/agent-dashboard/help', function () {
    return view('agent.dashboard.Community.help');
})->name('agent.help');

Route::get('/agent-dashboard/laws', function () {
    return view('agent.dashboard.Community.laws');
})->name('agent.laws');

Route::get('/agent-dashboard/classification-laws', function () {
    return view('agent.dashboard.Community.classification-laws');
})->name('agent.classification-laws');

// Route::get('/agent-dashboard/upload-avatar',function(){
//     return view('agent.dashboard.upload-avatar');
// })->name('upload-avatar');

Route::get('/agent-dashboard/notifications-features', function () {
    return view('agent.dashboard.notifications-features');
})->name('notifications-features');




Route::get('/upload-avatar', function () {
    return view('user.upload-avatar');
})->name('upload.avatar');


Route::get('admin-dashboard/alerts/new', function () {
    return view('admin.alerts.new');
})->name('new');


Route::get('admin-dashboard/management/email-management', function () {
    return view('admin.management.email-management');
})->name('email-management');

Route::get('admin-dashboard/management/sim-management', function () {
    return view('admin.management.sim-management');
})->name('sim-management');


Route::get('/admin-dashboard/support/pricing', function () {
    return view('admin.support.pricing');
})->name('pricing');

Route::get('/admin-dashboard/support/abbreviations', function () {
    return view('admin.support.abbreviations');
})->name('abbreviations');

Route::get('/admin-dashboard/support/classification-laws', function () {
    return view('admin.support.classification-laws');
})->name('classification-laws');

Route::get('/admin-dashboard/support/laws', function () {
    return view('admin.support.laws');
})->name('laws');

Route::get('/admin-dashboard/support/post', function () {
    return view('admin.support.post');
})->name('post');

Route::get('/admin-dashboard/website/global-notifications', function () {
    return view('admin.website.global-notifications');
})->name('global-notifications');

Route::get('/admin-dashboard/website/maintenance', function () {
    return view('admin.website.maintenance');
})->name('maintenance');

Route::get('/admin-dashboard/Analytics/publicpages', function () {
    return view('admin.Analytics.publicpages');
})->name('publicpages');

// Route::get('/admin-dashboard/Analytics/consoles',function(){
//     return view('admin.Analytics.consoles');
// })->name('consoles');

Route::get('/admin-dashboard/Concierge/email-service-request', function () {
    return view('admin.Concierge.email-service-request');
})->name('email-service-request');

Route::get('/admin-dashboard/Concierge/mobile-sim-request', function () {
    return view('admin.Concierge.mobile-sim-request');
})->name('mobile-sim-request');

Route::get('/admin-dashboard/Concierge/product-request', function () {
    return view('admin.Concierge.product-request');
})->name('product-request');

Route::get('/admin-dashboard/Concierge/visa-migration-request', function () {
    return view('admin.Concierge.visa-migration-request');
})->name('visa-migration-request');

Route::get('/admin-dashboard/reporting/email-request', function () {
    return view('admin.reporting.email-request');
})->name('admin.email-request');

Route::get('/admin-dashboard/reporting/mobile-request', function () {
    return view('admin.reporting.mobile-request');
})->name('admin.mobile-request');

Route::get('/admin-dashboard/reporting/admin-product-request', function () {
    return view('admin.reporting.admin-product-request');
})->name('admin.admin-product-request');

Route::get('/admin-dashboard/reporting/punterbox-report', function () {
    return view('admin.reporting.punterbox-report');
})->name('admin.punterbox-report');

Route::get('/admin-dashboard/management/competitor-database', function () {
    return view('admin.management.competitor-database');
})->name('admin.competitor-database');

Route::get('/admin-dashboard/management/memberships', function () {
    return view('admin.management.memberships');
})->name('admin.memberships');

Route::get('/admin-dashboard/reports/credit', function () {
    return view('admin.reports.credit');
})->name('admin.credit');



Route::get('/admin-dashboard/management/statistics/listings', function () {
    return view('admin.management.statistics.listings');
})->name('admin.listings');

Route::get('/admin-dashboard/management/manage-staff', [ManagePeopleStaffController::class, 'index'])->name('admin.manage-user');

Route::get('/admin-dashboard/management/legbox-report', function () {
    return view('admin.management.legbox-report');
})->name('admin.legbox-report');

Route::get('/admin-dashboard/management/logs-staff', function () {
    return view('admin.management.logs-staff');
})->name('admin.logs-staff');

/* Route::get('/admin-dashboard/management/staff',function(){
    return view('admin.management.staff');
})->name('admin.staff'); */



Route::get('/admin-dashboard/management/email-management', function () {
    return view('admin.management.email-management');
})->name('admin.email-management');

Route::get('/admin-dashboard/management/marketing-templates-agents', function () {
    return view('admin.management.marketing-templates-agents');
})->name('admin.marketing-templates-agents');

Route::get('/admin-dashboard/management/marketing-templates-e4u', function () {
    return view('admin.management.marketing-templates-e4u');
})->name('admin.marketing-templates-e4u');

Route::get('/admin-dashboard/management/post-office', function () {
    return view('admin.management.post-office');
})->name('admin.post-office');


// Route::get('/admin-dashboard/notifications/global',function(){
//     return view('admin.notifications.global');
// })->name('admin.global');


// Route::get('/admin-dashboard/notifications/agents',function(){
//     return view('admin.notifications.agents');
// })->name('admin.agents');

// Route::get('/admin-dashboard/notifications/viewers',function(){
//     return view('admin.notifications.viewers');
// })->name('admin.viewers');


// Route::get('/admin-dashboard/notifications/escorts',function(){
//     return view('admin.notifications.escorts');
// })->name('admin.escorts');


Route::get('/admin-dashboard/management/punterbox-reports', function () {
    return view('admin.management.punterbox-report');
})->name('admin.punterbox-reports');



//Route::get('/admin-dashboard/reports/agent-requests', [AgentRequestController::class, 'allAgentRequests'])->name('admin.agent-requests');






// Route::get('/admin-dashboard/global-monitoring',function(){
//     return view('admin.global-monitoring');
// })->name('admin.global-monitoring');

Route::post('/resend-otp', [App\Http\Controllers\User\Auth\RegisterController::class, 'resendOtp'])->name('web.resend.otp');

Route::post('/get-geolocation-data', [GetCurrentUserGeolocationController::class, 'getRealTimeGeo'])->name('user.current.location');
Route::post('/get-current-state', [GetCurrentUserGeolocationController::class, 'getCurrentState'])->name('user.current.state');
Route::get('/get_current_location_time', [GetCurrentUserGeolocationController::class, 'get_current_location_time'])->name('user.get_current_location_time');



// Generate all users member_id
Route::get('/generate-all-users-member-id', [AdvertiserRegisterController::class, 'generateAllUsersMemberId']);

Route::get('/delete', function () {
    User::where('email', 'muqafan@mailinator.com')->forceDelete();
    return "done";
});


Route::get('/get-notification', [NotificationController::class, 'getNotification'])->name('user.get-notification');
Route::post('/notification-seen', [NotificationController::class, 'makeNotificationSeen'])->name('user.notification-seen');


Route::get('/send-password-expire', [DemoController::class, 'sendPasswordExpire']);
Route::get('/send-testing', [DemoController::class, 'checkSmsSend']);
Route::get('/check-sms-status', [DemoController::class, 'checkMessageStatus']);

Route::post('/save-user-loggged-details', [WebController::class, 'userLoggedDetailStore'])->name('user.log-details');
Route::post('/update-password', [AgentAccountController::class, 'changePassword'])->name('update-password');
Route::post('/send/otp/notification/{user}', [WebController::class, 'sendOtpNotification'])->name('send.opt.notification');
Route::post('/validate/otp/notification/{user}', [WebController::class, 'validateOtpNotification'])->name('validate.opt.notification');





Route::get('/testscript', function () {
    $num = removeSpaceFromString('456464 645644 4444');
    echo  $num;
});


Route::get('get_country_by_user_id/{user_id}', [App\Http\Controllers\CountryController::class, 'getCountyByUserId'])->name('web.get_country_by_user_id');



################### Massage Centre Profile Page Url ###############
Route::get('massage-centres-list', [MassageCentre::class, 'massageList'])->name('find.massage.centre');
Route::get('mc-ajax-list', [MassageCentre::class, 'mcAjaxList'])->name('mc-ajax-list');
Route::get('massage-description/{id}', [MassageCentre::class, 'massage_description'])->name('web.massage-description');
Route::post('/store-short-list', [MassageCentre::class, 'storeShortList'])->name('web.store-short-list');
Route::post('/remove-short-list', [MassageCentre::class, 'removeShortList'])->name('web.remove-short-list');
Route::post('/review-massage/{id}', [MassageCentre::class, 'SaveReviewMassage'])->name('web.review-massage');
Route::post('/clear-short-list', [MassageCentre::class, 'clearShortList'])->name('web.clear-short-list');
Route::get('get-user-location', [MassageCentre::class, 'get_user_location'])->name('web.user_location');



################### Massage Centre Shortlist Url ###############
Route::get('massage-shortlist', [MassageCentre::class, 'shortlist_massageList'])->name('find.massage.shortlist');
Route::get('shortlist-mc-ajax-list', [MassageCentre::class, 'shortlist_mcAjaxList'])->name('shortlist-mc-ajax-list');

################### Report Massage By Viewer ################
Route::get('/massage-spam-report', [ReportMassageController::class, 'getSpamReportForAdvertiser'])->name('massage-spam-report');
Route::post('/massage-spam-report', [ReportMassageController::class, 'saveSpamReportForAdvertiser'])->name('massage-spam-report');
Route::post('/massage-like-dislike', [ReportMassageController::class, 'massageLikeDislike'])->name('web.massageLikeDislike');


Route::post('/encrypt', function (Request $request) {

    return response()->json([
        'encrypted' => encrypt($request->value)
    ]);
});


Route::post('/decrypt', function (Request $request) {

    return response()->json([
        'decrypted' => decrypt($request->value)
    ]);
});




Route::get('check-time', function () {


    echo update_messure_for_active_listing();
    exit;


    $massagers = [
        "monday" => [
            "status" => "til_late",
            "from" => "03:00 AM",
            "to" => null
        ],
        "tuesday" => [
            "status" => "custom",
            "from" => "01:30 AM",
            "to" => "01:30 PM"
        ],
        "wednesday" => [
            "status" => "closed",
            "from" => null,
            "to" => null
        ],
        "thursday" => [
            "status" => "custom",
            "from" => "04:30 AM",
            "to" => "07:00 AM"
        ],
        "friday" => [
            "status" => "custom",
            "from" => "07:30 AM",
            "to" => "02:30 PM"
        ],
        "saturday" => [
            "status" => "custom",
            "from" => "02:00 PM",
            "to" => "08:30 PM"
        ],
        "sunday" => [
            "status" => "custom",
            "from" => "10:00 AM",
            "to" => "02:00 PM"
        ]
    ];



    $massures =
        [

            [
                "Monday" => [
                    "status" => "closed",
                    "from" => null,
                    "to" => null,
                ],
                "Tuesday" => [
                    "status" => "custom",
                    "from" => "02:00 AM",
                    "to" => "05:30 PM",
                ],
                "Wednesday" => [
                    "status" => "custom",
                    "from" => "03:00 AM",
                    "to" => "05:30 PM",
                ],
                "Thursday" => [
                    "status" => "custom",
                    "from" => "04:00 AM",
                    "to" => "04:30 PM",
                ],
                "Friday" => [
                    "status" => "custom",
                    "from" => "05:00 AM",
                    "to" => "03:30 PM",
                ],
                "Saturday" => [
                    "status" => "custom",
                    "from" => "06:00 AM",
                    "to" => "02:00 PM",
                ],
                "Sunday" => [
                    "status" => "custom",
                    "from" => "07:00 AM",
                    "to" => "01:30 PM",
                ],
            ],
            [
                "Monday" => [
                    "status" => "custom",
                    "from" => "01:00 AM",
                    "to" => "01:30 PM",
                ],
                "Tuesday" => [
                    "status" => "custom",
                    "from" => "01:30 AM",
                    "to" => "09:30 PM",
                ],
                "Wednesday" => [
                    "status" => "custom",
                    "from" => "03:00 AM",
                    "to" => "10:30 PM",
                ],
                "Thursday" => [
                    "status" => "custom",
                    "from" => "04:30 AM",
                    "to" => "01:30 PM",
                ],
                "Friday" => [
                    "status" => "custom",
                    "from" => "07:30 AM",
                    "to" => "10:30 PM",
                ],
                "Saturday" => [
                    "status" => "custom",
                    "from" => "10:00 AM",
                    "to" => "11:30 PM",
                ],
                "Sunday" => [
                    "status" => "custom",
                    "from" => "06:30 AM",
                    "to" => "07:30 PM",
                ],
            ]
        ];






    echo 'massage =================<br>';
    echo '<pre>';
    print_r($massagers);
    echo '</pre>';


    echo '<br>massaure ==================================<br>';



    echo '<pre>';
    print_r($massures);
    echo '</pre>';
    echo '<br>';



    foreach ($massagers as $day => $info) {

        if ($info['status'] === 'closed') {

            foreach ($massures as $index => $schedule) {

                foreach ($schedule as $mDay => $mInfo) {

                    // match day (case-insensitive)
                    if (strtolower($mDay) === strtolower($day)) {

                        $massures[$index][$mDay] = [
                            "status" => "closed",
                            "from" => null,
                            "to" => null
                        ];
                    }
                }
            }
        }

        if ($info['status'] === 'til_late') {

            foreach ($massures as $index => $schedule) {
                foreach ($schedule as $mDay => $mInfo) {
                    if (strtolower($mDay) === strtolower($day)) {
                        if (isset($massures[$index][$mDay]['status']) && $massures[$index][$mDay]['status'] != "closed") {
                            $newFromTime =  isset($info['from']) ? strtotime($info['from']) : "";
                            $oldFromTime =  isset($massures[$index][$mDay]['from']) ? strtotime($massures[$index][$mDay]['from']) : "";

                            if ($newFromTime && (!$oldFromTime || $newFromTime > $oldFromTime))
                                $massures[$index][$mDay]['from'] = $info['from'];
                        }
                    }
                }
            }
        }

        if ($info['status'] === 'custom') {
            foreach ($massures as $index => $schedule) {
                foreach ($schedule as $mDay => $mInfo) {
                    if (strtolower($mDay) === strtolower($day)) {

                        $newfrom  = isset($info['from']) ? $info['from'] : "";
                        $newto  = isset($info['to']) ? $info['to'] : "";

                        $newFromTime =  isset($info['from']) ? strtotime($info['from']) : "";
                        $oldFromTime =  isset($massures[$index][$mDay]['from']) ? strtotime($massures[$index][$mDay]['from']) : "";

                        $newToTime =  isset($info['to']) ? strtotime($info['to']) : "";
                        $oldToTime =  isset($massures[$index][$mDay]['to']) ? strtotime($massures[$index][$mDay]['to']) : "";

                        if ($newFromTime && (!$oldFromTime || $newFromTime > $oldFromTime))
                            $massures[$index][$mDay]['from'] = $newfrom;

                        if ($newToTime && (!$oldToTime || $newToTime < $oldToTime))
                            $massures[$index][$mDay]['to'] = $newto;
                    }
                }
            }
        }
    }




    echo '<br>Updated Massures<br>';
    echo '<pre>';
    print_r($massures);
    echo '</pre>';
});
