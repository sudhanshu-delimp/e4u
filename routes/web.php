<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\Dashboard\UserController;
use App\Http\Controllers\Center\CenterController;
use App\Http\Controllers\Agent\AgentRegisterController;
use App\Http\Controllers\Auth\Advertiser\RegisterController as AdvertiserRegisterController;
use Illuminate\Http\Request;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\Escort\Auth\LoginController as EscortLogin;
use App\Http\Controllers\Auth\Advertiser\LoginController as AdvertiserLoginController;
use App\Http\Controllers\Escort\EscortController;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\SupportTicketsController;
use App\Mail\sendPlaymateAccountDisableMail;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('state-name', [App\Http\Controllers\HomeController::class, 'getGioLocation'])->name('web.state.name');
//Route::post('/ip-state', [HomeController::class,'ipTrack'])->name('home.ip.track')->middleware(['ipinfo']);

Auth::routes();


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



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/register', [RegisterController::class,'register']);//->name('register.create');
Route::post('/logout', [LoginController::class,'logout'])->name('logout');

Route::post('/login', [LoginController::class,'login'])->name('login')->middleware(['ipinfo']);//function(){ echo "hlksdjflksdjf";});//
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'intendedRedirect'])->name('dashboard');

Route::get('country-list',[App\Http\Controllers\CountryController::class,'countryList'])->name('country.list');
Route::get('city-list',[App\Http\Controllers\CityController::class,'cityList'])->name('city.list');
Route::get('select-city-list',[App\Http\Controllers\CityController::class,'SelectedCityList'])->name('selected.cities.list');
Route::get('state-list',[App\Http\Controllers\StateController::class,'stateList'])->name('state.list');

//Route::get('/escorts', [App\Http\Controllers\HomeController::class, 'intendedRedirect'])->name('dashboard');





/********** Advertiser **********/
Route::get('/agent-register', [AgentRegisterController::class,'index'])->name('agent.register');
Route::post('/agent-register', [AgentRegisterController::class,'register']);

Route::get('/advertiser-register', [AdvertiserRegisterController::class,'index'])->name('advertiser.register');
Route::post('/advertiser-register', [AdvertiserRegisterController::class,'register']);
Route::post('/check-otp', [AdvertiserLoginController::class,'checkOTP'])->name('web.checkOTP');

Route::get('/advertiser-login', [AdvertiserLoginController::class,'index'])->name('advertiser.login');

Route::get('/advertiser-forgot', [AdvertiserLoginController::class,'forgotpassword'])->name('advertiser.forgot');

Route::get('/agent-login', [AdvertiserLoginController::class,'indexAgent'])->name('agent.login');
// Route::get('/agent-forgot', [AdvertiserLoginController::class,'forgotpassword'])->name('agent.forgot');

// Route::get('/forgotAgent', function(){
// 	return view('agent.forgot');
// })->name('agent.forgot');

Route::get('/viewer-login', [AdvertiserLoginController::class,'indexViewer'])->name('viewer.login');
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
//  end shortlist
/********** escort profile description **********/
Route::get('/escort-profile/{id}', [App\Http\Controllers\WebController::class,'profileDescription'])->name('profile.description');
Route::get('/center-profile/{id}', [App\Http\Controllers\WebController::class,'centerProfileDescription'])->name('center.profile.description');
Route::post('/store-message/{id}', [App\Http\Controllers\Escort\MessageReviewController::class,'saveMessage'])->name('store.message');
Route::post('/review-advertiser/{id}', [App\Http\Controllers\Escort\MessageReviewController::class,'SaveReviewAdvertiser'])->name('review.advertiser');
/*************User *********************/
Route::group(['prefix' => 'user-dashboard'], function() {
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


Route::get('/my-legbox-list', [UserController::class, 'myLegboxList'])->name('user.legbox.list');
Route::get('/massage-legbox-list', [UserController::class, 'massageLegboxList'])->name('user.massage.legbox.list');
Route::post('/save-my-legbox/{id}', [UserController::class, 'saveMyLegbox'])->name('user.save.legbox');
Route::post('/delete-my-legbox/{id}', [UserController::class, 'deleteMyLegbox'])->name('user.delete.legbox');
//massage legbox
Route::post('/save-my-massage-legbox/{id}', [UserController::class, 'saveMyMassageLegbox'])->name('user.save.massage.legbox');
Route::post('/delete-my-massage-legbox/{id}', [UserController::class, 'deleteMyMassageLegbox'])->name('user.delete.massage.legbox');

Route::get('/delete-legbox/{id}', [UserController::class, 'deleteLegbox'])->name('user.console.delete.legbox');
Route::get('/legbox-listing', [UserController::class, 'legboxDataTable'])->name('user.legbox.dataTable');
Route::get('/massage-legbox-listing', [UserController::class, 'legboxMassageDataTable'])->name('user.legbox.massagedataTable');
// function(){
//  	return view('user.dashboard.legbox.list');
// });

Route::get('/user-dashboard/my-legbox-notes',function(){
    return view('user.dashboard.legbox.notes');
})->name('user.notes');

});

Route::get('/page/{slug}', [App\Http\Controllers\WebController::class,'showFooterLink'])->name('page.show');

//Route::get('/acceptable-usage-policy',[App\Http\Controllers\WebController::class,'usagePolicy']);
Route::get('/acceptable-usage-policy', function() { return view('web.pages.acceptable-use-policy');  });
// 	function() {
// 	$value = Cookie::queue('name', 'value', 10);
// 	 //$request->cookie('agreementmmm');
// 	dd($value);
// 	//$value = '';
// 	return view('web.pages.acceptable-use-policy',compact('value'));

// });
//Route::get('/acceptable-use-policy', function() { return view('web.pages.policynew'); });
Route::get('/acceptable-usages-policy', function() { return view('web.pages.acceptable-usages-policy'); });
Route::get('/copyright-statement', function() { return view('web.pages.copyright-statement'); });
Route::get('/covid-19-statement', function() {  return view('web.pages.covid-19-statement'); });
Route::get('/disclaimer-statement', function() { return view('web.pages.disclaimer-statement'); });
Route::get('/law-enforcement', function() { return view('web.pages.law-enforcement'); });
Route::get('/privacy-policy', function() { return view('web.pages.privacy-policy'); });
Route::get('/refund-policy', function() { return view('web.pages.refund-policy'); });
Route::get('/spam-policy', function() { return view('web.pages.spam-policy'); });
Route::get('/terms-conditions', function() { return view('web.pages.terms-conditions'); });
Route::get('/abbreviations', function() { return view('web.pages.abbreviations'); });
Route::get('/alerts', function() { return view('web.pages.alerts'); });
Route::get('/blog', function() { return view('web.pages.blog'); });
Route::get('/contact-us', function() { return view('web.pages.contact-us'); });
Route::get('/etiquette', function() { return view('web.pages.etiquette'); });
Route::get('/faqs', function() { return view('web.pages.faqs'); });
Route::get('/feedback', function() { return view('web.pages.feedback'); });
Route::get('/help-for-advertisers', function() { return view('web.pages.help-for-advertisers'); });
Route::get('/help-for-agents', function() { return view('web.pages.help-for-agents'); });
Route::get('/help-for-massage-centres', function() { return view('web.pages.help-for-massage-centres'); });
Route::get('/help-for-viewers', function() { return view('web.pages.help-for-viewers'); });
Route::get('/become-a-pin-up', function() { return view('web.pages.pinup'); });
Route::get('/agents', function() { return view('web.pages.agents'); });
Route::get('/centres', function() { return view('web.pages.centres'); });
Route::get('/playbox', function() { return view('web.pages.playbox'); });
Route::get('/escorts4U', function() { return view('web.pages.escorts4u'); });

Route::get('/accommodation', function() { return view('web.pages.accommodation'); });
Route::get('/email-hosting', function() { return view('web.pages.email-hosting'); });
Route::get('/mobile-read-sim', function() { return view('web.pages.mobile-read-sim'); });
Route::get('/professional-product', function() { return view('web.pages.professional-product'); });
Route::get('/travel', function() { return view('web.pages.travel'); });
Route::get('/blogs', function() { return view('web.pages.blogs'); });
Route::get('/visa-migration', function() { return view('web.pages.visa-migration'); });
Route::get('/cookie-policy', function() { return view('web.pages.cookie-policy'); });
Route::get('/pin-up', function() { return view('web.pages.pinupme'); });

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

Route::get('/user-dashboard/submitticket', function(){
	return view('user.dashboard.supportticket.submitticket');
});

Route::get('agent-dashboard/submitticket', function(){
	return view('agent.dashboard.supportticket.submitticket');
})->name('submitticket');

Route::get('/agent-dashboard/abbreviations',function(){
    return view('agent.dashboard.Community.abbreviations');
})->name('agent.abbreviations');

Route::get('/user-dashboard/abbreviations',function(){
    return view('user.dashboard.Community.abbreviations');
})->name('user.abbreviations');

Route::get('/user-dashboard/communication',function(){
    return view('user.dashboard.communication.advertiser');
})->name('user.advertiser');

Route::get('/escort-dashboard/help',function(){
    return view('escort.dashboard.Community.help');
})->name('escort.dashboard.Community.help');

Route::get('/escort-dashboard/laws',function(){
    return view('escort.dashboard.Community.laws');
})->name('escort.dashboard.Community.laws');

Route::get('/user-dashboard/laws',function(){
    return view('user.dashboard.Community.laws');
})->name('user.laws');

Route::get('/user-dashboard/Community',function(){
    return view('user.dashboard.Community.help');
})->name('user.help');

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

Route::get('/user-dashboard/guide',function(){
    return view('user.dashboard.Community.guide');
})->name('user.guide');

Route::get('/user-dashboard/punterbox/lookup',function(){
    return view('user.dashboard.punterbox.lookup');
})->name('user.lookup');

Route::get('/user-dashboard/punterbox/report',function(){
    return view('user.dashboard.punterbox.report');
})->name('user.report');

Route::get('/upload-avatar',function(){
    return view('user.upload-avatar');
})->name('upload.avatar');

Route::get('/user-dashboard/change-features',function(){
    return view('user.dashboard.change-features');
})->name('change-features');

Route::get('admin-dashboard/alerts/new', function(){
        return view('admin.alerts.new');
    })->name('new');

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

Route::get('/admin-dashboard/management/manage-user',function(){
    return view('admin.management.manage-user');
})->name('admin.manage-user');

Route::get('/admin-dashboard/management/legbox-report',function(){
    return view('admin.management.legbox-report');
})->name('admin.legbox-report');

Route::get('/admin-dashboard/management/logs-staff',function(){
    return view('admin.management.logs-staff');
})->name('admin.logs-staff');



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

Route::get('/admin-dashboard/management/punterbox-reports',function(){
    return view('admin.management.punterbox-report');
})->name('admin.punterbox-reports');

// Route::get('/admin-dashboard/global-monitoring',function(){
//     return view('admin.global-monitoring');
// })->name('admin.global-monitoring');

Route::post('/resend-otp', [App\Http\Controllers\User\Auth\RegisterController::class,'resendOtp'])->name('web.resend.otp');
