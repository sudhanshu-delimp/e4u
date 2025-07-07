<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Escort\EscortController;
use App\Http\Controllers\Escort\EscortPolyPaymentController;
use App\Http\Controllers\Escort\EscortTourPaymentController;
use App\Http\Controllers\Escort\ArchivesController;
use App\Http\Controllers\Escort\TourController;
use App\Http\Controllers\Escort\Profile\ProfileInformationController;
use App\Http\Controllers\Escort\PlaymateController;
use App\Http\Controllers\Escort\PinUpsController;
use App\Http\Controllers\Escort\EscortAccountController;
use App\Http\Controllers\Escort\EscortGalleryController;
use App\Http\Controllers\Escort\EscortSuspendProfileController;
use App\Http\Controllers\Escort\Profile\CreateController;
use App\Http\Controllers\Escort\Profile\UpdateController;
use App\Http\Controllers\SupportTicketsController;
use App\Http\Controllers\MugsController;
use App\Http\Controllers\EscortBrbController;

//remove before prod
Route::post('/test-paymentUrl', [EscortController::class, 'pinup_test_payment'])->name('escort.payment');

//============

//USED CONFIRM
//****Bank Account*****/
Route::get('bank_account',[EscortAccountController::class,'bankDetails'])->name('escort.bank_account');
Route::post('save-bank-details',[EscortAccountController::class,'saveBankDetails'])->name('escort.save.bank.details');
Route::get('bank-details',[EscortAccountController::class,'BankDataTable'])->name('escort.bankDetail.dataTable');
Route::post('check-bank-otp',[EscortAccountController::class,'checkOTP'])->name('escort.checkOTP');
Route::post('delete-escort-bank/{id}',[EscortAccountController::class,'deleteEscortBank']);




//END




Route::get('/', [EscortController::class, 'index'])->name('escort.dashboard');
Route::get('/list/{type}', [EscortController::class, 'escortList'])->name('escort.list');
Route::get('/list/data-table/{type?}', [EscortController::class, 'dataTable'])->name('escort.list.dataTable');
Route::get('/list/data-table-listing/{type?}', [EscortController::class, 'dataTableListing'])->name('escort.list.dataTableListing');
Route::get('/add-listing', [EscortController::class, 'add_listing'])->name('escort.account.add-listing');
Route::get('/listings/{type}', [EscortController::class, 'listings'])->name('escort.dashboard.listings');
Route::post('/listing-checkout', [EscortController::class, 'listing_checkout'])->name('escort.account.listing_checkout');
Route::get('/update-account', [EscortController::class, 'edit'])->name('escort.account.edit');
Route::post('/update-account', [EscortController::class, 'update'])->name('escort.account.update');
Route::post('/notification-update', [EscortController::class, 'notificationUpdate'])->name('escort.notification.update');
Route::post('/profile-&-tour-permission', [EscortController::class, 'profileTourPermissionUpdate'])->name('escort.account.profile.tour.update');
Route::get('/change-password', [EscortController::class, 'editPassword'])->name('escort.change.password');
Route::post('/change-password', [EscortController::class, 'updatePassword'])->name('escort.update.password');
Route::post('/change-password-expiry', [EscortController::class, 'updatePasswordExpiry'])->name('escort.update.password.expiry');
//Route::get('/profile-information', [EscortController::class, 'ProfileInformation'])->name('escort.profile.information');
Route::get('/notifications-features', [EscortController::class, 'notificationsFeatures'])->name('escort.profile.notifications');
Route::get('/upload-my-avatar', [EscortController::class, 'uploadAvatar'])->name('escort.profile.avatar');

Route::get('profile/{id}',[UpdateController::class,'updateProfile'])->name('escort.update.profile');
Route::post('delete-profile/{id}',[UpdateController::class,'deleteProfile'])->name('escort.delete.profile');
Route::post('save-member-type/{id}',[UpdateController::class,'saveMembership'])->name('escort.save.memberType');


// suspend profile
Route::post('/escort-suspend/profile-credit', [EscortSuspendProfileController::class, 'suspendProfileCredit'])->name('suspend.calculate.credit.live');
Route::post('escort-suspend/profile', [EscortSuspendProfileController::class, 'suspendProfile'])->name('escort.profile.suspend');


Route::get('view-archive/{id?}',[CreateController::class,'archives'])->name('escort.archives');
// Route::get('view-archive-profile-folder/{id?}',[CreateController::class,'archivesProfile'])->name('escort.archives.profile-folder');

Route::get('archives-media/{id?}',[CreateController::class,'archivesMedia'])->name('escort.archives');
Route::get('media-masseurs/{id?}',[CreateController::class,'archivesMediamasseurs'])->name('escort.archives');
Route::get('media-masseurs01/{id?}',[CreateController::class,'archivesMediamasseurs01'])->name('escort.archives');


//ESCORT PROFILE RELATED
Route::get('create-profile/{id?}',[CreateController::class,'index'])->name('escort.profile');
Route::post('setting-profile/{id?}',[UpdateController::class,'createBySetting'])->name('escort.setting.profile');
Route::post('save-profile-media/{id}',[UpdateController::class,'saveProfileMedia'])->name('escort.profile.media');
Route::post('duplicate-profile',[UpdateController::class,'duplicateProfile'])->name('escort.duplicate.profile');
Route::post('update-escort/{id?}',[UpdateController::class,'update_escort'])->name('escort.update_escort');
Route::post('update_escort_default',[UpdateController::class,'update_escort_default'])->name('escort.update_escort_default');

Route::post('create-profile/{id}',[CreateController::class,'createProfile'])->name('escort.create.profile'); //create and update
Route::get('update-profile/{id?}',[UpdateController::class,'updateBasicProfile'])->name('escort.profile.basic.update');
Route::post('upload-media',[CreateController::class,'saveMedia'])->name('upload.media');
Route::delete('delete-media/{id}',[CreateController::class,'deleteMedia'])->name('escort.delete.media');
Route::post('mark-default/{id}',[CreateController::class,'markDefault'])->name('escort.media.mark.default');
Route::get('next-step/{id}',[CreateController::class,'nextStep'])->name('escort.next.step');


Route::post('policy/{id}',[UpdateController::class,'updatePolicy'])->name('escort.update.policy');
Route::post('profile/{id}',[UpdateController::class,'storeAboutMe'])->name('escort.about.me');
/////////settings
Route::get('profile-information', [ProfileInformationController::class, 'showAboutMe'])->name('escort.profile.information');
Route::post('settings-information',[ProfileInformationController::class,'storeAboutMe'])->name('escort.settings.about.me');
Route::post('settings-my-rates',[ProfileInformationController::class,'storeRates'])->name('escort.settings.rate');
Route::post('settings-availability',[ProfileInformationController::class,'storeAvailability'])->name('escort.settings.availability');
Route::post('settings-services',[ProfileInformationController::class,'storeServices'])->name('escort.settings.services');
Route::post('settings-socials-link',[ProfileInformationController::class,'storeSocialsLink'])->name('escort.settings.social');
Route::post('/available-playmates',[ProfileInformationController::class,'escortplaymate'])->name('escort.playmate.check');

//Route::post('settings-upload-avatar',[ProfileInformationController::class,'storeSocialsLink'])->name('settings.save.avatar');
//////////////end settings
//////////my account upload my avatar
Route::post('/upload-avatar/{id}',[EscortController::class,'storeMyAvatar'])->name('escort.save.avatar');
Route::post('/remove-avatar',[EscortController::class,'removeMyAvatar'])->name('escort.avatar.remove');
////////////end.


Route::post('update-read-more/{id}',[UpdateController::class,'storeReadMore'])->name('escort.read.more');
Route::post('update-about/{id}',[UpdateController::class,'storeAbout'])->name('escort.about');
Route::post('services/{id}',[UpdateController::class,'storeServices'])->name('escort.store.services');
Route::post('rates/{id}',[UpdateController::class,'storeRates'])->name('escort.store.rate');
Route::post('availability/{id}',[UpdateController::class,'storeAvailability'])->name('escort.store.availability');
Route::get('check-profile-name',[UpdateController::class,'checkProfileName'])->name('escort.checkProfileName');

Route::get('playmates/{id}', [EscortController::class, 'escortsPlayMates'])->name('escort.playmates');
Route::post('find-playmates-id/{id?}', [EscortController::class, 'findPlaymatesId'])->name('escort.playmatesId.find');
Route::post('find-playmates/', [EscortController::class, 'findPlaymates'])->name('escort.playmates.find');
Route::post('add-playmate', [EscortController::class, 'addPlaymate'])->name('escort.playmates.add');
Route::post('remove-playmate', [EscortController::class, 'removePlaymate'])->name('escort.playmates.remove');
Route::post('states-by-cities/{id}', [CreateController::class, 'cities'])->name('escort.stateByCity');

//Pin-Ups
Route::get('register-for-pin-up', [PinUpsController::class, 'create'])->name('escort.pinUp');
Route::post('pin-up-checkout', [PinUpsController::class, 'checkout'])->name('escort.pin_up.checkout');
Route::get('pin-up-list/{type}', [PinUpsController::class, 'list'])->name('escort.dashboard.pinUpList');
Route::get('pin-up-data', [PinUpsController::class, 'profile_and_week_data'])->name('escort.dashboard.pinUpDropdownData');


Route::post('escort-brb/add', [EscortBrbController::class, 'add'])->name('escort.brb.add');

Route::post('escort-brb/inactive/{id}', [EscortBrbController::class, 'inactive'])->name('escort.brb.inactive');

////////////pagis
/*Route::get('register-for-pin-up',function(){
    return view('escort.dashboard.registerPinup.register-pin-up');
});*/
Route::get('view-archives',function(){
    return view('escort.dashboard.archives.view-archives');
});
Route::get('archive-profiles',function(){
    return view('escort.dashboard.archives.archive-profiles');
});
Route::get('archive-view-profiles',[ArchivesController::class, 'profileStates'])->name('escort.state.profiles');
// Route::get('archive-view-profiles',function(){
//     return view('escort.dashboard.archives.archive-view-profiles');
// });
Route::get('archive-view-profiles-list/{id}',[ArchivesController::class, 'profileStatesList'])->name('escort.state.profiles.list');
Route::get('archive-view-profiles-datatable/',[ArchivesController::class, 'stateDataTable'])->name('escort.stateId.profile.list.dataTable');
Route::get('archive-view-profiles-list-datatable/{id}',[ArchivesController::class, 'stateDataTable'])->name('escort.state.profile.list.dataTable');
Route::post('/view-tour',[TourController::class, 'viewTour'])->name('escort.view.tour');
//Route::post('/create-tour/{id}',[TourController::class, 'create'])->name('escort.create.tour');
Route::get('/archive-tour-{name?}/{id}',[TourController::class, 'tourProfileList'])->name('escort.archive.tour.name');
Route::post('/create-tour/{id?}',[TourController::class, 'createStoreTour'])->name('escort.store.tour');
Route::get('create-tour/{id?}',[TourController::class, 'createTour'])->name('escort.store.tour');
//Route::get('update-tour',[TourController::class, 'updateTour']);
Route::post('/delete-tour/{id}',[TourController::class, 'DeleteTour'])->name('escort.delete.tour');
Route::get('/archive-tours-list',[TourController::class, 'viewTourList'])->name('escort.tour.view');
Route::get('/archive-tours-dataTable/{type}',[TourController::class, 'TourDataTable'])->name('escort.tour.dataTable');
Route::post('/archive-tours-edit/{id}',[TourController::class, 'viewTourEdit'])->name('escort.tour.edit');
// Route::get('archive-view-profiles-list',function(){
//     return view('escort.dashboard.archives.archive-view-profiles-list');
// });

Route::get('archive-tours',function(){
    return view('escort.dashboard.archives.archive-tours');
});
Route::get('archive-tour-profiles',function(){
    return view('escort.dashboard.archives.archive-tour-profiles');
});

// Route::get('archive-tour-summer',function(){
//     return view('escort.dashboard.archives.archive-tour-summer');
// });
// Route::get('archive-tour-view-profiles',function(){
//     return view('escort.dashboard.archives.archive-tour-view-profiles');
// });
Route::get('archive-medias',function(){
    return view('escort.dashboard.archives.archive-medias');
})->name('archive-medias');
Route::get('archive-view-photos',[EscortGalleryController ::class, 'photoGalleries'])->name('escort.archive-view-photos');
Route::post('upload-galleries',[EscortGalleryController::class,'uploadGallery'])->name('escort.upload.gallery');
Route::post('upload-videos-galleries',[EscortGalleryController::class,'uploadVideosGaller'])->name('escort.upload.videos.gallery');
Route::post('default_photos', [EscortGalleryController ::class, 'defaultImages'])->name('escort.default.images');
Route::post('default-videos', [EscortGalleryController ::class, 'defaultVideos'])->name('escort.default.video');
Route::post('get-default-photos', [EscortGalleryController ::class, 'getDefaultImages'])->name('escort.get.default.images');
Route::post('delete-photos/{id}', [EscortGalleryController ::class, 'ImagesDelete'])->name('escort.delete.gallery');
Route::post('delete-videos/{id}', [EscortGalleryController ::class, 'videosDelete'])->name('escort.delete.vedio.gallery');
// ,function(){
//     return view('escort.dashboard.archives.archive-view-photos');
// });
Route::get('archive-view-videos',[EscortGalleryController ::class, 'videoGalleries'])->name('escort.archive-view-videos');
// Route::get('archive-view-videos',function(){
//     return view('escort.dashboard.archives.archive-view-videos');
// });
//new changess





//
Route::get('archive-histories',function(){
    return view('escort.dashboard.archives.archive-histories');
});






Route::get('photo-video-verification',function(){
    return view('escort.dashboard.archives.photo-video-verification');
});
Route::get('profiles-tours',function(){
    return view('escort.dashboard.Annalytics.profiles-tours');
});
Route::get('social-media',function(){
    return view('escort.dashboard.Annalytics.social-media');
});
Route::get('credit-my-account',function(){
    return view('escort.dashboard.Bookkeeping.credit-my-account');
});
Route::get('my-bank-account',function(){
    return view('escort.dashboard.Bookkeeping.my-bank-account');
});
Route::get('revenue-manager',function(){
    return view('escort.dashboard.Bookkeeping.revenue-manager');
});
Route::get('transaction-history',function(){
    return view('escort.dashboard.Bookkeeping.transaction-history');
});
Route::get('transaction-summary',function(){
    return view('escort.dashboard.Bookkeeping.transaction-summary');
});

Route::get('reccomendations',function(){
    return view('escort.dashboard.Reviews.reccomendations');
});
Route::get('view-reviews',function(){
    return view('escort.dashboard.Reviews.view-reviews');
});
Route::get('escort-agency-request',function(){
    return view('escort.dashboard.Communication.escort-agency-request');
});
Route::get('send-notofications',function(){
    return view('escort.dashboard.Communication.send-notofications');
});
Route::get('viewer-notes',function(){
    return view('escort.dashboard.Communication.viewer-notes');
});
Route::get('viewer-messaging',function(){
    return view('escort.dashboard.Communication.viewer-messaging');
})->name('escort.viewer-messaging');
Route::get('accommodation',function(){
    return view('escort.dashboard.Concierge.accommodation');
});
Route::get('email-hosting',function(){
    return view('escort.dashboard.Concierge.email-hosting');
});
Route::get('mobile-read-sim',function(){
    return view('escort.dashboard.Concierge.mobile-read-sim');
});
Route::get('professional-products',function(){
    return view('escort.dashboard.Concierge.professional-products');
});
Route::get('travel',function(){
    return view('escort.dashboard.Concierge.travel');
});
Route::get('visa-migration',function(){
    return view('escort.dashboard.Concierge.visa-migration');
});

Route::get('/list-tour/{type}',[TourController::class, 'viewTourList']);
// Route::get('edit-tour',function(){
//     return view('escort.dashboard.NewTour.edit-tour');

// });
Route::get('photo-video-verification',function(){
    return view('escort.dashboard.PhotoVideo.photo-video-verification');
});
Route::get('pricing',function(){
    return view('escort.dashboard.Community.pricing');
})->name('escort.dashboard.Community.pricing');


Route::get('Community',function(){
    return view('escort.dashboard.Community.abbreviations');
})->name('escort.dashboard.Community.abbreviations');
//////////tour payment


//////////////
Route::post('poli-paymentUrl',[EscortPolyPaymentController::class,'polyPaymentUrl'])->name('escort.poli.paymentUrl');
Route::get('paymentUrl-status-success/{id}',[EscortPolyPaymentController::class,'successUrl'])->name('escort.poly.paymentUrl.status.success');
Route::get('paymentUrl-status-FailureURL/{id}',[EscortPolyPaymentController::class,'FailureURL'])->name('escort.poly.paymentUrl.status.FailureURL');
Route::get('paymentUrl-status-CancellationURL/{id}',[EscortPolyPaymentController::class,'CancellationURL'])->name('escort.poly.paymentUrl.status.CancellationURL');
Route::get('paymentUrl-status-NotificationURL/{id}',[EscortPolyPaymentController::class,'NotificationURL'])->name('escort.poly.paymentUrl.status.NotificationURL');
////////////tour payment status
Route::post('tour-paymentUrl/{id}',[EscortTourPaymentController::class,'polyPaymentUrl'])->name('escort.tour.paymentUrl');
Route::post('tour-paymentUrl/{id}',[EscortTourPaymentController::class,'polyPaymentUrl'])->name('escort.tour.paymentUrl');
Route::get('tour-paymentUrl-status-success/{id}',[EscortTourPaymentController::class,'successUrl'])->name('escort.tour.paymentUrl.status.success');
Route::get('tour-paymentUrl-status-FailureURL/{id}',[EscortTourPaymentController::class,'FailureURL'])->name('escort.tour.paymentUrl.status.FailureURL');
Route::get('tour-paymentUrl-status-CancellationURL/{id}',[EscortTourPaymentController::class,'CancellationURL'])->name('escort.tour.paymentUrl.status.CancellationURL');
Route::get('tour-paymentUrl-status-NotificationURL/{id}',[EscortTourPaymentController::class,'NotificationURL'])->name('escort.tour.paymentUrl.status.NotificationURL');

Route::get('report',function(){
    return view('escort.dashboard.UglyMugsRegister.report');
})->name('escort.report');
Route::post('ugly-mug-register',[MugsController::class,'create'])->name('escort.mug.register');
Route::get('ugly-mug/dataTable', [MugsController::class, 'dataTable'])->name('escort.mug.dataTable');

Route::get('add-report',function(){
    return view('escort.dashboard.UglyMugsRegister.add-report');
})->name('escort.add-report');

Route::get('my-reports',function(){
    return view('escort.dashboard.UglyMugsRegister.my-reports');
})->name('escort.my-reports');

Route::get('numdashboard',function(){
    return view('escort.dashboard.UglyMugsRegister.numdashboard');
})->name('escort.numdashboard');

Route::get('lookup',function(){
    return view('escort.dashboard.UglyMugsRegister.lookup');
})->name('escort.lookup');

Route::get('request-notification',function(){
    return view('escort.dashboard.UglyMugsRegister.request-notification');
})->name('escort.request-notification');

// Route::get('home-state',function(){
//     return view('escort.dashboard.archives.home-state');
// })->name('escort.home-state');

Route::get('home-state/',[EscortController::class, 'homeState'])->name('escort.home-state');
Route::post('add-playmate/{id}',[ProfileInformationController::class, 'savePlaymate'])->name('escort.add.playmate');
Route::post('remove-playmate/{id}',[ProfileInformationController::class, 'removePlaymate'])->name('escort.remove.playmate');
//Route::get('my-play-mates',[ProfileInformationController::class, 'myNewPlaymate'])->name('escort.my.playmates');
// Route::get('my-play-mates',function(){
//     return view('escort.dashboard.Playmates.playmates');
// })->name('my.playmates');
Route::post('escort-state-name/{id}',[TourController::class, 'nameByState'])->name('escort.stateId');
Route::get('/get-account-locations', [TourController::class, 'getAccountLocations'])->name('account.locations');
Route::get('/get-account-profiles', [TourController::class, 'getAccountProfiles'])->name('account.location_profiles');
Route::post('/save-account-tour', [TourController::class, 'saveAccountTour'])->name('account.save_tour');
Route::post('/update-account-tour/{id}', [TourController::class, 'updateAccountTour'])->name('account.update_tour');
