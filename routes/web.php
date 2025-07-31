<?php

use App\Http\Controllers\Admin\GlobalMonitoringController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\BlogsController;
use App\Mail\sendPlaymateAccountDisableMail;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Center\CenterController;
use App\Http\Controllers\Escort\EscortController;
use App\Http\Controllers\SupportTicketsController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\Escort\ConciergeController;
use App\Http\Controllers\Agent\AgentRequestController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\Agent\AgentRegisterController;
use App\Http\Controllers\User\Dashboard\UserController;
use App\Http\Controllers\Viewer\ViewerPrefrenceController;
use App\Http\Controllers\Admin\ManagePeopleStaffController;
use App\Http\Controllers\Escort\EscortMyLegboxViewerController;
use App\Http\Controllers\Escort\Auth\LoginController as EscortLogin;
use App\Http\Controllers\Auth\RegisterController  as GuestRegisterController;
use App\Http\Controllers\Auth\Advertiser\LoginController as AdvertiserLoginController;
use App\Http\Controllers\Auth\Advertiser\RegisterController as AdvertiserRegisterController;
use App\Http\Controllers\Escort\EscortViewerInteractionController;
use App\Http\Controllers\GetCurrentUserGeolocationController;
use App\Http\Controllers\Viewer\ViewerEscortInteractionController;

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
    
    Route::get('/login', function () { return redirect('/');})->name('login');
    Route::get('/advertiser-login', [AdvertiserLoginController::class,'index'])->name('advertiser.login');
    Route::get('/viewer-login', [AdvertiserLoginController::class,'indexViewer'])->name('viewer.login');
    Route::get('/agent-login', [AdvertiserLoginController::class,'indexAgent'])->name('agent.login');
    Route::get('/register', [GuestRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class,'register']);
    
});
############## End Put All Guest Url Here ####################



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
        Route::post('upload-avatar/{id}',[UserController::class,'storeMyAvatar'])->name('user.save.avatar');
        Route::post('remove-avatar',[UserController::class,'removeMyAvatar'])->name('user.avatar.remove');
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


        # Dashboard escort tasks
        Route::get('/task-fetch',[TaskController::class,'fetchTask'])->name('dashboard.ajax-fetch-task');
        Route::post('/task-add',[TaskController::class,'addTask'])->name('dashboard.ajax-add-task');
        Route::post('/task-edit',[TaskController::class,'editTask'])->name('dashboard.ajax-edit-task');
        Route::post('/task-update',[TaskController::class,'updateTask'])->name('dashboard.ajax-update-task');
        Route::post('/task-status',[TaskController::class,'statusTask'])->name('dashboard.ajax-change-status');
        Route::post('/task-open',[TaskController::class,'openTask'])->name('dashboard.ajax-open-task');
        Route::post('/task-delete',[TaskController::class,'destroy'])->name('dashboard.ajax-delete-task');

        Route::get('/my-legbox-notes',function(){
            return view('user.dashboard.legbox.notes');
        })->name('user.notes');

        Route::get('/submitticket', function(){
            return view('user.dashboard.supportticket.submitticket');
        });
        Route::get('/view-and-reply-ticket', function(){
            return view('user.dashboard.supportticket.view-and-reply-ticket');
        })->name('user.view-and-reply-ticket');

        Route::get('/abbreviations',function(){
            return view('user.dashboard.Community.abbreviations');
        })->name('user.abbreviations');

        Route::get('/communication',function(){
            return view('user.dashboard.communication.advertiser');
        })->name('user.advertiser');

        Route::get('/laws',function(){
            return view('user.dashboard.Community.laws');
        })->name('user.laws');

        Route::get('/Community',function(){
            return view('user.dashboard.Community.help');
        })->name('user.help');


        Route::get('/viewer-statistics',function(){
            return view('user.dashboard.viewer-statistics');
        })->name('user.viewer-statistics');

        # Escort viewer interaction routes
        Route::get('/my-legbox',[EscortMyLegboxViewerController::class,'dashboard'])->name('user.my-legbox');
        Route::get('/my-escort-legbox-ajax',[EscortMyLegboxViewerController::class,'escortViewersAjaxList'])->name('escort.viewer-legbox-list');
        Route::post('/escort/viewer-interaction-update', [EscortViewerInteractionController::class, 'escortUpdateViewerInteraction'])->name('escort.viewer-interaction.update');
        // Route::get('/my-legbox',function(){
        //     return view('user.dashboard.my-legbox');
        // })->name('user.my-legbox');

        # Viewer escort interaction routes
        Route::get('/my-viwer-legbox-ajax',[ViewerEscortInteractionController::class,'dashboardEscortListAjax'])->name('user.my-legbox-escort-list');
        Route::get('/my-viewer-legbox-ajax',[ViewerEscortInteractionController::class,'viewersEscortAjaxList'])->name('viewer.escort-legbox-list');
        Route::post('/viewer/escort-interaction-update', [ViewerEscortInteractionController::class, 'viewerUpdateEscortInteraction'])->name('viewer.escort-interaction.update');
        Route::get('/viewer/escort-profile-view/{id?}', [GlobalMonitoringController::class, 'dataTableSingleListingAjax'])->name('viewer.escort.profile-view');
        Route::post('/viewer/escort-remove-from-legbox', [ViewerEscortInteractionController::class, 'viewerRemoveEscortFromLegbox'])->name('viewer.escort-remove');


        Route::get('/favorites-online',function(){
            return view('user.dashboard.favorites-online');
        })->name('user.favorites-online');

        Route::get('/punterbox',function(){
            return view('user.dashboard.punterbox');
        })->name('user.punterbox');

        Route::get('/logs-and-statistics',function(){
            return view('user.dashboard.logs-and-statistics');
        })->name('user.logs-and-statistics');

        Route::get('/my-statistics',function(){
            return view('user.dashboard.my-statistics');
        })->name('user.my-statistics');

        Route::get('/task-list',function(){
            return view('user.dashboard.task-list');
        })->name('user.task-list');


        Route::get('/guide',function(){
            return view('user.dashboard.Community.guide');
        })->name('user.guide');

        Route::get('/notebox/new',function(){
            return view('user.dashboard.notebox.new');
        })->name('user.new');

        Route::get('/notebox/list',function(){
            return view('user.dashboard.notebox.list');
        })->name('user.list');

        Route::get('/punterbox/dashboard',function(){
            return view('user.dashboard.punterbox.dashboard');
        })->name('user.punterbox.dashboard');

        Route::get('/punterbox/add-report',function(){
            return view('user.dashboard.punterbox.add-report');
        })->name('user.add-report');

        Route::get('/punterbox/my-report',function(){
            return view('user.dashboard.punterbox.my-report');
        })->name('user.my-report');

        Route::get('/punterbox/code-of-conduct',function(){
            return view('user.dashboard.punterbox.code-of-conduct');
        })->name('user.code-of-conduct');

        Route::get('/change-features',[ViewerPrefrenceController::class, 'getViewerPrefrence'])->name('change-features');
        Route::post('/viewer-prefrence',[ViewerPrefrenceController::class, 'setViewerPrefrence'])->name('set-viewer-preference');
        Route::post('/logout', [LoginController::class,'logout'])->name('logout');
        });
        ################ End All Authencated User Url #################################

});



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('state-name', [App\Http\Controllers\HomeController::class, 'getGioLocation'])->name('web.state.name');

//Route::post('/ip-state', [HomeController::class,'ipTrack'])->name('home.ip.track')->middleware(['ipinfo']);
// Auth::routes();


Route::get('/mail', function () {
   return new sendPlaymateAccountDisableMail();
});
//**************SUPPORT TICKET*******************//
Route::get('submit_ticket', [SupportTicketsController::class,'create'])->name('support-ticket.form_create');
Route::post('submit_ticket', [SupportTicketsController::class,'submit_ticket'])->name('support-ticket.create');
Route::get('support_tickets/list/{id?}',[SupportTicketsController ::class, 'index'])->name('support-ticket.list');
Route::get('support_tickets/dataTable', [SupportTicketsController::class, 'dataTable'])->name('support-ticket.dataTable');
Route::get('support_tickets/conversations/{id?}', [SupportTicketsController::class, 'conversations'])->name('support-ticket.conversations');
Route::put('support_tickets/withdraw/{id}', [SupportTicketsController::class, 'withdraw'])->name('support-ticket.withdraw');
Route::post('support_tickets/save_message', [SupportTicketsController::class, 'save_message'])->name('support-ticket.saveMessage');

Route::get('contact-us', [ContactUsController::class,'index'])->name('contactus.index');
Route::post('contact-us-send', [ContactUsController::class,'sendContact'])->name('contactus.send');



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/login', [LoginController::class,'login'])->name('login')->middleware(['ipinfo']);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'intendedRedirect'])->name('dashboard');

Route::get('country-list',[App\Http\Controllers\CountryController::class,'countryList'])->name('country.list');
Route::get('city-list',[App\Http\Controllers\CityController::class,'cityList'])->name('city.list');
Route::get('select-city-list',[App\Http\Controllers\CityController::class,'SelectedCityList'])->name('selected.cities.list');
Route::get('state-list',[App\Http\Controllers\StateController::class,'stateList'])->name('state.list');

//Route::get('/escorts', [App\Http\Controllers\HomeController::class, 'intendedRedirect'])->name('dashboard');

Route::get('/dmca', [App\Http\Controllers\HomeController::class, 'noticeDmca'])->name('notice.dmca');
Route::get('/influencer', [App\Http\Controllers\HomeController::class, 'becomeInfluencer'])->name('become.influencer');



/********** Advertiser **********/
Route::get('/agent-register', [AgentRegisterController::class,'index'])->name('agent.register');
Route::post('/agent-register', [AgentRegisterController::class,'register']);

Route::get('/advertiser-register', [AdvertiserRegisterController::class,'index'])->name('advertiser.register');
Route::post('/advertiser-register', [AdvertiserRegisterController::class,'register']);
Route::post('/check-otp', [AdvertiserLoginController::class,'checkOTP'])->name('web.checkOTP');



Route::get('/advertiser-forgot', [AdvertiserLoginController::class,'forgotpassword'])->name('advertiser.forgot');


// Route::get('/agent-forgot', [AdvertiserLoginController::class,'forgotpassword'])->name('agent.forgot');

// Route::get('/forgotAgent', function(){
// 	return view('agent.forgot');
// })->name('agent.forgot');


Route::get('/viewer-forgot/{token?}', [AdvertiserLoginController::class,'viewerForgotPassword'])->name('viewer.forgot');
Route::get('/agent-forgot/{token?}', [AdvertiserLoginController::class,'agentForgotPassword'])->name('agent.forgot');
Route::get('/admin-forgot/{token?}', [AdvertiserLoginController::class,'adminForgotPassword'])->name('admin.forgot');
Route::get('/advertiser-forgot/{token?}', [AdvertiserLoginController::class,'escortForgotPassword'])->name('escort.forgot');
//Route::post('/reset-forgot', [AdvertiserLoginController::class,'viewerResetPassword'])->name('web.reset.password.viewer');
Route::post('/reset-forgot', [App\Http\Controllers\SendForgotPasswordController::class,'viewerResetPassword'])->name('web.reset.password.viewer');

Route::post('/advertiser-login', [AdvertiserLoginController::class, 'login'])->middleware(['ipinfo']);
Route::post('/advertiser-logout', [AdvertiserLoginController::class,'logout'])->name('advertiser.logout');
Route::get('/all-escorts-list', [App\Http\Controllers\WebController::class,'allEscortList'])->name('find.all');
// Route::get('/all-escorts-list/{gender?}', [App\Http\Controllers\WebController::class,'allEscortList'])->name('find.all');
Route::get('/massage-centres-list', [App\Http\Controllers\WebController::class,'massageList'])->name('find.massage.centre');
//Route::get('/search-filter', [App\Http\Controllers\WebController::class,'searchfilter'])->name('web.search.filter');
Route::post('/location/filter', [App\Http\Controllers\WebController::class, 'filterLocation'])->name('location.filter');

Route::get('/grid-escort-list', [App\Http\Controllers\WebController::class,'gridEscortList'])->name('grid.escort.list');
//Route::get('/advertiser',function() { return view('escort.index_escort'); });
//Route::resource('/agentdashboard',EscortController::class);

/********** ADMIN **********/
Route::get('admin-login', [App\Http\Controllers\Admin\AuthController::class,'showLoginForm'])->name('admin.login');
Route::post('/admin-login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->middleware(['ipinfo']);
Route::post('/admin-logout', [App\Http\Controllers\Admin\AuthController::class,'logout'])->name('admin.logout');
// shortlist
Route::post('/shortlist', [App\Http\Controllers\WebController::class,'saveShortList'])->name('web.save.shortlist');
Route::post('/add-to-shortlist/{id}', [App\Http\Controllers\WebController::class,'addtocart'])->name('web.save.addtocart');
Route::post('/remove-shortlist', [App\Http\Controllers\WebController::class,'removeShortList'])->name('web.remove.shortlist');
Route::get('/my-shortlist', [App\Http\Controllers\WebController::class,'shortList'])->name('web.show.shortlist');
Route::get('/showList', [App\Http\Controllers\WebController::class,'showAddList'])->name('web.show.showAddList');
Route::get('/clear-short-list', [App\Http\Controllers\WebController::class,'clearShortList'])->name('shortlist.clear-list');
Route::get('admin-dashboard/e4u-cms/pages', function()
	{
		return view('admin.e4u-cms.pages');
	})->name('admin.e4u-cms.pages');
Route::get('test_page',function(){
    return view('test_page');
});
Route::get('admin-dashboard/contact-database/advertisers', function()
	{
		return view('admin.contact-database.advertisers');
	})->name('admin.contact-database.advertisers');
Route::get('admin-dashboard/e4u-database/escorts', function()
	{
		return view('admin.e4u-database.escorts');
	})->name('admin.e4u-database.escorts');




/********** escort profile description **********/
Route::get('/escort-profile/{id}/{city?}/{membershipId?}', [App\Http\Controllers\WebController::class,'profileDescription'])->name('profile.description');
Route::get('/center-profile/{id}', [App\Http\Controllers\WebController::class,'centerProfileDescription'])->name('center.profile.description');
Route::post('/store-message/{id}', [App\Http\Controllers\Escort\MessageReviewController::class,'saveMessage'])->name('store.message');
Route::post('/review-advertiser/{id}', [App\Http\Controllers\Escort\MessageReviewController::class,'SaveReviewAdvertiser'])->name('review.advertiser');
/*************User *********************/


Route::get('/page/{slug}', [App\Http\Controllers\WebController::class,'showFooterLink'])->name('page.show');
Route::get('/acceptable-usage-policy', function() { return view('web.pages.acceptable-use-policy');  });

//Route::get('/acceptable-usage-policy',[App\Http\Controllers\WebController::class,'usagePolicy']);
//Route::get('/acceptable-use-policy', function() { return view('web.pages.policynew'); });


Route::get('/acceptable-usages-policy', function() { return view('web.pages.acceptable-usages-policy'); });
Route::get('/copyright-statement', function() { return view('web.pages.copyright-statement'); });
Route::get('/covid-19-statement', function() {  return view('web.pages.covid-19-statement'); });
Route::get('/disclaimer-statement', function() { return view('web.pages.disclaimer-statement'); });
Route::get('/law-enforcement', function() { return view('web.pages.law-enforcement'); });
Route::get('/privacy-policy', function() { return view('web.pages.privacy-policy'); });
Route::get('/refund-policy', function() { return view('web.pages.refund-policy'); });
Route::get('/spam-policy', function() { return view('web.pages.spam-policy'); });
Route::get('/terms-conditions', function() { return view('web.pages.terms-conditions'); })->name('pages.terms-conditions');
Route::get('/abbreviations', function() { return view('web.pages.abbreviations'); });
Route::get('/alerts', function() { return view('web.pages.alerts'); });
Route::get('/blog', function() { return view('web.pages.blog'); });
//Route::get('/contact-us', function() { return view('web.pages.contact-us'); })

Route::get('/etiquette', function() { return view('web.pages.etiquette'); });
Route::get('/faqs', function() { return view('web.pages.faqs'); });
Route::get('/parent-control', function() { return view('web.pages.parent-control'); });
Route::get('/feedback', function() { return view('web.pages.feedback'); });
Route::get('/thankyou', function() { return view('web.pages.thankyou'); })->name('feedback.thankyou');
Route::get('/help-for-escorts', function() { return view('web.pages.help-for-advertisers'); });
Route::get('/help-for-agents', function() { return view('web.pages.help-for-agents'); });
Route::get('/help-for-massage-centres', function() { return view('web.pages.help-for-massage-centres'); });
Route::get('/help-for-viewers', function() { return view('web.pages.help-for-viewers'); });
Route::get('/become-a-pin-up', function() { return view('web.pages.pinup'); });
Route::get('/agents', function() { return view('web.pages.agents'); });
Route::get('/centres', function() { return view('web.pages.centres'); });
Route::get('/playbox', function() { return view('web.pages.playbox'); });
Route::get('/escorts4U', function() { return view('web.pages.escorts4u'); });
Route::get('/e4u-verified', function() { return view('web.pages.e4u-verified'); });

Route::get('/accommodation', function() { return view('web.pages.accommodation'); });
Route::get('/email-hosting', function() { return view('web.pages.email-hosting'); });
Route::get('/mobile-read-sim', function() { return view('web.pages.mobile-read-sim'); });
Route::get('/professional-product', function() { return view('web.pages.professional-product'); });
Route::get('/travel', function() { return view('web.pages.travel'); });
Route::get('/blogs', function() { return view('web.pages.blogs'); });
// Route::get('/blogsingle', function() { return view('web.pages.blogs'); });
Route::get('/visa-migration', function() { return view('web.pages.visa-migration'); });
Route::get('/cookie-policy', function() { return view('web.pages.cookie-policy'); });
Route::get('/pin-up', function() { return view('web.pages.pinupme'); });

// Route::post('/blogs',[BlogsController::class, 'index'])->name('blogs.index');
Route::get('/blogs-single',[BlogsController::class, 'blogsSingle'])->name('blogs.single');

Route::post('/mobile-read-sim',[ConciergeController::class, 'mobileReadSim'])->name('mobile-read-sim');
Route::post('/mobile-order-sim-payment',[ConciergeController::class, 'mobileOrderSimPayment'])->name('mobile-order-sim-payment');

Route::post('/feedback-data', [App\Http\Controllers\FeedbackController::class,'showOption'])->name('web.option');
Route::post('/feedback', [App\Http\Controllers\FeedbackController::class,'store'])->name('web.feedback.save');
Route::post('/viewer-send-mail-forgot-passord', [App\Http\Controllers\SendForgotPasswordController::class,'sendMail'])->name('web.sendMail.viewer');
Route::post('/agent-send-mail-forgot-passord', [App\Http\Controllers\SendForgotPasswordController::class,'sendMail'])->name('web.sendMail.agent');
Route::post('/escort-send-mail-forgot-passord', [App\Http\Controllers\SendForgotPasswordController::class,'sendMail'])->name('web.sendMail.escort');
Route::post('/admin-send-mail-forgot-passord', [App\Http\Controllers\SendForgotPasswordController::class,'sendMail'])->name('web.sendMail.admin');
Route::post('/asend-otpt-passord', [App\Http\Controllers\SendForgotPasswordController::class,'sendOtp'])->name('web.send.otp');


Route::post('/like-dislike', [App\Http\Controllers\WebController::class,'likeDislike'])->name('web.likeDislike');
Route::post('/massage-like-dislike', [App\Http\Controllers\WebController::class,'massageLikeDislike'])->name('web.massageLikeDislike');

Route::get('/massage-description', function()
	{
		return view('web.massage-description');
	})->name('web.massage-description');

Route::post('/add-to-massage-shortlist/{id}', [App\Http\Controllers\WebController::class,'addToMcCart'])->name('web.save.mcMyShortListCart');
Route::post('/massage-shortlist', [App\Http\Controllers\WebController::class,'saveMcShortList'])->name('web.save.mc.shortlist');
Route::post('/remove-massage-shortlist', [App\Http\Controllers\WebController::class,'removeToMcCart'])->name('web.remove.mcMyShortListCart');
Route::get('/massage-show-list', [App\Http\Controllers\WebController::class,'mcMyShortList'])->name('web.massage-show-list');

// Route::get('/massage-show-list', function()
// 	{
// 		return view('web.massage-show-list');
// 	})->name('web.massage-show-list');

Route::get('pricing',function(){
    return view('user.dashboard.Community.pricing');
})->name('user.dashboard.Community.pricing');



Route::get('agent-dashboard/submitticket', function(){
	return view('agent.dashboard.supportticket.submitticket');
})->name('submitticket');

Route::get('/agent-dashboard/abbreviations',function(){
    return view('agent.dashboard.Community.abbreviations');
})->name('agent.abbreviations');



Route::get('/escort-dashboard/customise-dashboard',function(){
    return view('escort.dashboard.customise-dashboard');
})->name('escort.dashboard.customise-dashboard');

Route::get('/escort-dashboard/escorts-statistics',function(){
    return view('escort.dashboard.escorts-statistics');
})->name('escort.dashboard.escorts-statistics');


Route::get('/escort-dashboard/my-playmates',function(){
    return view('escort.dashboard.my-playmates');
})->name('escort.dashboard.my-playmates');

Route::get('/escort-dashboard/my-playbox',function(){
    return view('escort.dashboard.my-playbox');
})->name('escort.dashboard.my-playbox');

Route::get('/escort-dashboard/my-legbox-viewers',[EscortMyLegboxViewerController::class,'index'])->name('escort.dashboard.my-legbox-viewers');

Route::get('/escort-dashboard/agent-messages',function(){
    return view('escort.dashboard.agent-messages');
})->name('escort.dashboard.agent-messages');

Route::get('/escort-dashboard/viewers-messages',function(){
    return view('escort.dashboard.viewers-messages');
})->name('escort.dashboard.viewers-messages');

Route::get('/user-dashboard/viewer-messages',function(){
    return view('user.dashboard.communication.viewer-messages');
})->name('user.viewer-messages');

Route::get('/escort-dashboard/my-statistics',function(){
    return view('escort.dashboard.my-statistics');
})->name('escort.dashboard.my-statistics');

Route::get('/escort-dashboard/task-list',function(){
    return view('escort.dashboard.task-list');
})->name('escort.dashboard.task-list');

Route::get('/escort-dashboard/my-spend',function(){
    return view('escort.dashboard.my-spend');
})->name('escort.dashboard.my-spend');

Route::get('/escort-dashboard/tour-schedule',function(){
    return view('escort.dashboard.tour-schedule');
})->name('escort.dashboard.tour-schedule');

Route::get('/escort-dashboard/logs-and-status',function(){
    return view('escort.dashboard.logs-and-status');
})->name('escort.dashboard.logs-and-status');


Route::get('/escort-dashboard/help',function(){
    return view('escort.dashboard.Community.help');
})->name('escort.dashboard.Community.help');

Route::get('/escort-dashboard/laws',function(){
    return view('escort.dashboard.Community.laws');
})->name('escort.dashboard.Community.laws');



Route::get('/agent-dashboard/help',function(){
    return view('agent.dashboard.Community.help');
})->name('agent.help');

Route::get('/agent-dashboard/laws',function(){
    return view('agent.dashboard.Community.laws');
})->name('agent.laws');

Route::get('/agent-dashboard/classification-laws',function(){
    return view('agent.dashboard.Community.classification-laws');
})->name('agent.classification-laws');

Route::get('/agent-dashboard/upload-avatar',function(){
    return view('agent.dashboard.upload-avatar');
})->name('upload-avatar');

Route::get('/agent-dashboard/notifications-features',function(){
    return view('agent.dashboard.notifications-features');
})->name('notifications-features');




Route::get('/upload-avatar',function(){
    return view('user.upload-avatar');
})->name('upload.avatar');


Route::get('admin-dashboard/alerts/new', function(){
        return view('admin.alerts.new');
    })->name('new');

    
Route::get('admin-dashboard/database/email-management',function(){
    return view('admin.database.email-management');
})->name('email-management');
  
Route::get('admin-dashboard/database/sim-management',function(){
    return view('admin.database.sim-management');
})->name('sim-management');


Route::get('/admin-dashboard/support/pricing',function(){
    return view('admin.support.pricing');
})->name('pricing');

Route::get('/admin-dashboard/support/abbreviations',function(){
    return view('admin.support.abbreviations');
})->name('abbreviations');

Route::get('/admin-dashboard/support/classification-laws',function(){
    return view('admin.support.classification-laws');
})->name('classification-laws');

Route::get('/admin-dashboard/support/laws',function(){
    return view('admin.support.laws');
})->name('laws');

Route::get('/admin-dashboard/support/post',function(){
    return view('admin.support.post');
})->name('post');

Route::get('/admin-dashboard/website/global-notifications',function(){
    return view('admin.website.global-notifications');
})->name('global-notifications');

Route::get('/admin-dashboard/website/maintenance',function(){
    return view('admin.website.maintenance');
})->name('maintenance');

Route::get('/admin-dashboard/Analytics/publicpages',function(){
    return view('admin.Analytics.publicpages');
})->name('publicpages');

// Route::get('/admin-dashboard/Analytics/consoles',function(){
//     return view('admin.Analytics.consoles');
// })->name('consoles');

Route::get('/admin-dashboard/Concierge/email-service-request',function(){
    return view('admin.Concierge.email-service-request');
})->name('email-service-request');

Route::get('/admin-dashboard/Concierge/mobile-sim-request',function(){
    return view('admin.Concierge.mobile-sim-request');
})->name('mobile-sim-request');

Route::get('/admin-dashboard/Concierge/product-request',function(){
    return view('admin.Concierge.product-request');
})->name('product-request');

Route::get('/admin-dashboard/Concierge/visa-migration-request',function(){
    return view('admin.Concierge.visa-migration-request');
})->name('visa-migration-request');

Route::get('/admin-dashboard/reporting/email-request',function(){
    return view('admin.reporting.email-request');
})->name('admin.email-request');

Route::get('/admin-dashboard/reporting/mobile-request',function(){
    return view('admin.reporting.mobile-request');
})->name('admin.mobile-request');

Route::get('/admin-dashboard/reporting/admin-product-request',function(){
    return view('admin.reporting.admin-product-request');
})->name('admin.admin-product-request');

Route::get('/admin-dashboard/reporting/punterbox-report',function(){
    return view('admin.reporting.punterbox-report');
})->name('admin.punterbox-report');

Route::get('/admin-dashboard/management/competitor-database',function(){
    return view('admin.management.competitor-database');
})->name('admin.competitor-database');

Route::get('/admin-dashboard/management/memberships',function(){
    return view('admin.management.memberships');
})->name('admin.memberships');

Route::get('/admin-dashboard/management/statistics/tours',function(){
    return view('admin.management.statistics.tours');
})->name('admin.tours');

Route::get('/admin-dashboard/management/statistics/profile',function(){
    return view('admin.management.statistics.profile');
})->name('admin.profile');

Route::get('/admin-dashboard/management/statistics/num',function(){
    return view('admin.management.statistics.num');
})->name('admin.num');

Route::get('/admin-dashboard/reports/credit',function(){
    return view('admin.reports.credit');
})->name('admin.credit');



Route::get('/admin-dashboard/management/statistics/listings',function(){
    return view('admin.management.statistics.listings');
})->name('admin.listings');

Route::get('/admin-dashboard/management/manage-staff',[ManagePeopleStaffController::class, 'index'])->name('admin.manage-user');

Route::get('/admin-dashboard/management/legbox-report',function(){
    return view('admin.management.legbox-report');
})->name('admin.legbox-report');

Route::get('/admin-dashboard/management/logs-staff',function(){
    return view('admin.management.logs-staff');
})->name('admin.logs-staff');

Route::get('/admin-dashboard/management/staff',function(){
    return view('admin.management.staff');
})->name('admin.staff');

Route::get('/admin-dashboard/management/agent',function(){
    return view('admin.management.agent');
})->name('admin.agent');

Route::get('/admin-dashboard/management/email-management',function(){
    return view('admin.management.email-management');
})->name('admin.email-management');

Route::get('/admin-dashboard/management/marketing-templates-agents',function(){
    return view('admin.management.marketing-templates-agents');
})->name('admin.marketing-templates-agents');

Route::get('/admin-dashboard/management/marketing-templates-e4u',function(){
    return view('admin.management.marketing-templates-e4u');
})->name('admin.marketing-templates-e4u');

Route::get('/admin-dashboard/management/post-office',function(){
    return view('admin.management.post-office');
})->name('admin.post-office');


Route::get('/admin-dashboard/notifications/global',function(){
    return view('admin.notifications.global');
})->name('admin.global');


Route::get('/admin-dashboard/notifications/agents',function(){
    return view('admin.notifications.agents');
})->name('admin.agents');

Route::get('/admin-dashboard/notifications/viewers',function(){
    return view('admin.notifications.viewers');
})->name('admin.viewers');


Route::get('/admin-dashboard/notifications/escorts',function(){
    return view('admin.notifications.escorts');
})->name('admin.escorts');


Route::get('/admin-dashboard/notifications/centres',function(){
    return view('admin.notifications.centres');
})->name('admin.centres');

Route::get('/admin-dashboard/post-office/send-reports',function(){
    return view('admin.post-office.send-reports');
})->name('admin.send-reports');

Route::get('/admin-dashboard/post-office/reports',function(){
    return view('admin.post-office.reports');
})->name('admin.reports');

Route::get('/admin-dashboard/blog',function(){
    return view('admin.blog');
})->name('admin.blog');


Route::get('/admin-dashboard/management/punterbox-reports',function(){
    return view('admin.management.punterbox-report');
})->name('admin.punterbox-reports');



//Route::get('/admin-dashboard/reports/agent-requests', [AgentRequestController::class, 'allAgentRequests'])->name('admin.agent-requests');

Route::get('/admin-dashboard/reports/agent-requests',function(){
    return view('admin.reports.agent-requests');
})->name('admin.agent-requests');

Route::get('/admin-dashboard/reports/transaction-summary',function(){
    return view('admin.reports.transaction-summary');
})->name('admin.transaction-summary');

Route::get('admin/dataTable', [AgentRequestController::class, 'dataTable'])->name('admin.dataTable');

// Route::get('/admin-dashboard/global-monitoring',function(){
//     return view('admin.global-monitoring');
// })->name('admin.global-monitoring');

Route::post('/resend-otp', [App\Http\Controllers\User\Auth\RegisterController::class,'resendOtp'])->name('web.resend.otp');

Route::post('/get-geolocation-data', [GetCurrentUserGeolocationController::class, 'getRealTimeGeo'])->name('user.current.location');