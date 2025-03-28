<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Center\CenterController;
use App\Http\Controllers\Escort\EscortController;
use App\Http\Controllers\Center\CenterProfileInformationController;
use App\Http\Controllers\Center\PolyPaymentController;
use Illuminate\Http\Request;
use App\Http\Controllers\Center\Profile\CreateController;
use App\Http\Controllers\Center\Profile\UpdateController;


Route::get('/', [CenterController::class, 'index'])->name('center.dashboard');
Route::get('/list', [CenterController::class, 'escortList'])->name('center.list');
Route::get('/list/data-table', [CenterController::class, 'dataTable'])->name('center.list.dataTable');
Route::post('/profile-contact-permission', [EscortController::class, 'profileTourPermissionUpdate'])->name('center.account.profile.contact.update');
//Route::get('profile/{id}',[CenterController::class,'updateProfile'])->name('center.update.profile');
Route::post('delete-profile/{id}',[CenterController::class,'deleteProfile'])->name('center.delete.profile');

//Route::post('policy/{id}',[CenterController::class,'updatePolicy'])->name('center.update.policy');
//Route::post('profile/{id}',[CenterController::class,'storeAboutMe'])->name('center.about.me');
// Route::post('update-read-more/{id}',[CenterController::class,'storeReadMore'])->name('center.read.more');
// Route::post('update-about/{id}',[CenterController::class,'storeAbout'])->name('center.about');
// Route::post('services/{id}',[CenterController::class,'storeServices'])->name('center.store.services');
// Route::post('rates/{id}',[CenterController::class,'storeRates'])->name('center.store.rate');
// Route::post('availability/{id}',[CenterController::class,'storeAvailability'])->name('center.store.availability');
Route::get('/change-password', [CenterController::class, 'editPassword'])->name('center.change.password');
Route::post('/change-password', [CenterController::class, 'updatePassword'])->name('center.update.password');
Route::post('/change-password-expiry', [CenterController::class, 'updatePasswordExpiry'])->name('center.update.password.expiry');
Route::get('/upload-my-avatar', [CenterController::class, 'uploadAvatar'])->name('center.profile.avatar');
Route::post('upload-avatar/{id}',[CenterController::class,'storeMyAvatar'])->name('center.save.avatar');
Route::post('remove-avatar',[CenterController::class,'removeMyAvatar'])->name('center.avatar.remove');
Route::get('/update-account', [CenterController::class, 'edit'])->name('center.account.edit');
Route::post('/update-account', [CenterController::class, 'update'])->name('center.account.update');
//Route::get('profile-informations', [CenterProfileInformationController::class, 'showAboutMe'])->name('center.profile.information');
//Route::post('settings-information',[CenterProfileInformationController::class,'storeAboutMe'])->name('center.settings.about.me');
// Route::get('/my-account/change-password', function()
// 	{
// 		return view('center.my-account.change-password');
// 	})->name('center.my-account.change-password');

// Route::get('/my-account/upload-avatar', function()
// 	{
// 		return view('center.my-account.upload-avatar');
// 	})->name('center.my-account.upload-avatar');

// Route::get('/my-account/edit-my-account', function()
// 	{
// 		return view('center.my-account.edit-my-account');
// 	})->name('center.my-account.edit-my-account');

// Route::get('/my-account/profile-information', function()
// 	{
// 		return view('center.my-account.profile-information');
// 	})->name('center.my-account.profile-information');

Route::get('/profile-info/create-profile', function()
	{
		return view('center.profile-info.create-profile');
	})->name('center.profile-info.create-profile');
///////////////profile
Route::get('create-profile/{id?}',[CreateController::class,'index'])->name('center.profile');
Route::get('update-profile/{id?}',[UpdateController::class,'updateBasicProfile'])->name('center.profile.basic.update');
//create new profile
Route::post('setting-profile/{id?}',[UpdateController::class,'createBySetting'])->name('center.setting.profile');
//end
Route::post('create-profile/{id}',[CreateController::class,'createProfile'])->name('center.create.profile');
Route::post('upload-media',[CreateController::class,'saveMedia'])->name('upload.media');
Route::delete('delete-media/{id}',[CreateController::class,'deleteMedia'])->name('center.delete.media');
Route::post('mark-default/{id}',[CreateController::class,'markDefault'])->name('center.media.mark.default');
Route::get('next-step/{id}',[CreateController::class,'nextStep'])->name('center.next.step');


Route::post('policy/{id}',[UpdateController::class,'updatePolicy'])->name('center.update.policy');
Route::post('profile/{id?}',[UpdateController::class,'storeAboutMe'])->name('center.about.me');
Route::get('profile/{id}',[UpdateController::class,'updateProfile'])->name('center.update.profile');
//Route::post('delete-profile/{id}',[UpdateController::class,'deleteProfile'])->name('center.delete.profile');
Route::post('save-member-type/{id}',[UpdateController::class,'saveMembership'])->name('center.save.memberType');
Route::post('upload-galleries',[CenterProfileInformationController::class,'uploadGaller'])->name('center.upload.gallery');
////////////////////////end
///////////////seting
Route::post('poli-paymentUrl/{id}',[PolyPaymentController::class,'polyPaymentUrl'])->name('center.poli.paymentUrl');
Route::get('paymentUrl-status-success',[PolyPaymentController::class,'successUrl'])->name('center.poly.paymentUrl.status.success');

/////////settings
Route::get('profile-informations', [CenterProfileInformationController::class, 'showAboutMe'])->name('center.profile.information');
Route::post('settings-information',[CenterProfileInformationController::class,'storeAboutMe'])->name('center.settings.about.me');
Route::post('settings-my-rates',[CenterProfileInformationController::class,'storeRates'])->name('center.settings.rate');
Route::post('settings-availability',[CenterProfileInformationController::class,'storeAvailability'])->name('center.settings.availability');
Route::post('settings-services',[CenterProfileInformationController::class,'storeServices'])->name('center.settings.services');
Route::post('settings-socials-link',[CenterProfileInformationController::class,'storeSocialsLink'])->name('center.settings.social');

//Route::post('settings-upload-avatar',[ProfileInformationController::class,'storeSocialsLink'])->name('settings.save.avatar');
//////////////end settings
/////////////end

Route::get('/profile-info/edit-profile', function()
{
	return view('center.profile-info.edit-profile');
})->name('center.profile-info.edit-profile');

Route::get('view-archives',function(){
    return view('center.dashboard.archives.view-archives');
});
Route::get('archive-profiles',function(){
    return view('center.dashboard.archives.archive-view-profiles');
})->name('cen.archive.profile');

Route::get('archive-tours',function(){
    return view('center.dashboard.archives.archive-tours');
})->name('cen.archive.tours');

Route::get('archive-medias',function(){
    return view('center.dashboard.archives.archive-medias');
})->name('cen.archive-medias');

Route::get('archive-view-profiles-list/{id}',function(){
    return view('center.dashboard.archives.archive-view-profiles-list');
})->name('cen.archive-view-profiles-list');

Route::get('archive-tour-profiles',function(){
    return view('center.dashboard.archives.archive-tour-profiles');
})->name('cen.archive-tour-profiles');

Route::get('archive-view-photos', [CenterProfileInformationController ::class, 'galleries'])->name('cen.archive-view-photos');
Route::post('default_photos', [CenterProfileInformationController ::class, 'defaultImages'])->name('center.default.images');
Route::post('get-default-photos', [CenterProfileInformationController ::class, 'getDefaultImages'])->name('center.get.default.images');
Route::post('delete-photos/{id}', [CenterProfileInformationController ::class, 'ImagesDelete'])->name('center.delete.gallery');

// function(){
//     return view('center.dashboard.archives.archive-view-photos');
// })->name('cen.archive-view-photos');

Route::get('archive-view-videos',function(){
    return view('center.dashboard.archives.archive-view-videos');
})->name('cen.archive-view-videos');

Route::get('register-for-pin-up',function(){
    return view('center.dashboard.registerPinup.register-pin-up');
});
Route::get('pricing',function(){
    return view('center.dashboard.Community.pricing');
})->name('center.dashboard.Community.pricing');
Route::get('submitticket',function(){
    return view('center.dashboard.supportticket.submitticket');
})->name('center.dashboard.supportticket.submitticket');

Route::get('Community',function(){
    return view('center.dashboard.Community.abbreviations');
})->name('center.dashboard.Community.abbreviations');

Route::get('help',function(){
    return view('center.dashboard.Community.help');
})->name('center.dashboard.Community.help');

Route::get('laws',function(){
    return view('center.dashboard.Community.laws');
})->name('center.dashboard.Community.laws');

Route::get('accommodation',function(){
    return view('center.dashboard.Concierge.accommodation');
})->name('center.accommodation');

Route::get('email-hosting',function(){
    return view('center.dashboard.Concierge.email-hosting');
})->name('center.email-hosting');

Route::get('mobile-read-sim',function(){
    return view('center.dashboard.Concierge.mobile-read-sim');
})->name('center.mobile-read-sim');

Route::get('professional-products',function(){
    return view('center.dashboard.Concierge.professional-products');
})->name('center.professional-products');

Route::get('travel',function(){
    return view('center.dashboard.Concierge.travel');
})->name('center.travel');

Route::get('visa',function(){
    return view('center.dashboard.Concierge.visa');
})->name('center.visa');

Route::get('profiles-tours',function(){
    return view('center.dashboard.Annalytics.profiles-tours');
})->name('profiles-tours');

Route::get('social-media',function(){
    return view('center.dashboard.Annalytics.social-media');
})->name('social-media');

Route::get('viewer-notes',function(){
    return view('center.dashboard.Communication.viewer-notes');
})->name('viewer-notes');

Route::get('reccomendations',function(){
    return view('center.dashboard.Reviews.reccomendations');
})->name('center.reccomendations');

Route::get('view-reviews',function(){
    return view('center.dashboard.Reviews.view-reviews');
})->name('center.view-reviews');

Route::get('lookup',function(){
    return view('center.dashboard.UglyMugsRegister.lookup');
})->name('lookup');

Route::get('report',function(){
    return view('center.dashboard.UglyMugsRegister.report');
})->name('center.report');

Route::get('request-notification',function(){
    return view('center.dashboard.UglyMugsRegister.request-notification');
})->name('request-notification');
