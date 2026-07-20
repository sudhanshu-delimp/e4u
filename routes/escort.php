<?php

use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Agent\AgentAccountController;
use App\Http\Controllers\Agent\AgentRequestController;
use App\Http\Controllers\Escort\ArchivesController;
use App\Http\Controllers\Escort\Concierge\ProductController;
use App\Http\Controllers\Escort\Concierge\ProductOrderController;
use App\Http\Controllers\Escort\EscortAccountController;
use App\Http\Controllers\Escort\EscortController;
use App\Http\Controllers\Escort\EscortDashboardController;
use App\Http\Controllers\Escort\EscortGalleryController;
use App\Http\Controllers\Escort\EscortPolyPaymentController;
use App\Http\Controllers\Escort\EscortReviewsController;
use App\Http\Controllers\Escort\EscortStatisticsController;
use App\Http\Controllers\Escort\EscortSuspendProfileController;
use App\Http\Controllers\Escort\EscortTourPaymentController;
use App\Http\Controllers\Escort\EscortTourScheduleContoller;
use App\Http\Controllers\Escort\HowIsItDoneController;
use App\Http\Controllers\Escort\MyPlaymatesContoller;
use App\Http\Controllers\Escort\NumController;
use App\Http\Controllers\Escort\PinUpsController;
use App\Http\Controllers\Escort\PlaymateController;
use App\Http\Controllers\Escort\Profile\CreateController;
use App\Http\Controllers\Escort\Profile\ProfileInformationController;
use App\Http\Controllers\Escort\Profile\UpdateController;
use App\Http\Controllers\Escort\TaskListController;
use App\Http\Controllers\Escort\TourController;
use App\Http\Controllers\EscortBrbController;
use App\Http\Controllers\MugsController;
use App\Http\Controllers\MyAdvertiser\PricingsummariesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SupportTicketsController;
use App\Http\Controllers\User\Dashboard\UserController;
use App\Http\Controllers\Escort\WalletController;
use App\Http\Controllers\Escort\PaymentController;
use Illuminate\Support\Facades\Route;

//remove before prod
Route::post('/test-paymentUrl', [EscortController::class, 'pinup_test_payment'])->name('escort.payment');

//============

//USED CONFIRM
//****Bank Account*****/
Route::get('bank_account', [EscortAccountController::class, 'bankDetails'])->name('escort.bank_account');
Route::post('save-bank-details', [EscortAccountController::class, 'saveBankDetails'])->name('escort.save.bank.details');
Route::get('bank-details', [EscortAccountController::class, 'BankDataTable'])->name('escort.bankDetail.dataTable');
Route::post('check-bank-otp', [EscortAccountController::class, 'checkOTP'])->name('escort.checkOTP');
Route::post('delete-escort-bank/{id}', [EscortAccountController::class, 'deleteEscortBank']);
Route::post('update-bank-pin', [EscortAccountController::class, 'updateBankPin'])->name('escort.update.bank.pin');
Route::post('send-otp-for-pin-change', [EscortAccountController::class, 'sendOtpForPinChange'])->name('escort.send-otp-for-pin-change');
Route::post('get-ef-bank-details', [EscortAccountController::class, 'getEftBankDetails'])->name('escort.get.eft.bank.details');
Route::post('/send-payment-receipt-escort', [EscortAccountController::class, 'sendPaymentReceiptEscort'])->name('escort.send-payment-receipt-escort');

//END




Route::get('/', [EscortController::class, 'index'])->name('escort.dashboard');
Route::get('/list/{type}', [EscortController::class, 'escortList'])->name('escort.list');
Route::get('/pinup-available-weeks/{escort}', [PinUpsController::class, 'pinup_available_weeks'])->name('escort.pinup_available_weeks');
Route::post('/pinup-register/{action?}', [PinUpsController::class, 'register'])->name('pinup.register');
Route::post('/bumpup-register', [EscortController::class, 'bumpup_register'])->name('escort.bumpup_register');
Route::post('/get-upgrade-amount', [EscortController::class, 'getUpgradeAmount'])->name('escort.upgrade_amount');
Route::post('/upgrade-list', [EscortController::class, 'upgradeList'])->name('escort.upgrade_list');
Route::get('/pinup-summary/{escort}', [PinUpsController::class, 'pinupSummary'])->name('escort.pinup_summary');
Route::get('/list/data-table/{type?}', [EscortController::class, 'dataTable'])->name('escort.list.dataTable');
Route::get('/list/data-table-listing/{type?}', [EscortController::class, 'dataTableListing'])->name('escort.list.dataTableListing');

Route::get('/listings/add', [EscortController::class, 'add_listing'])->name('escort.account.add-listing');
Route::post('/listing/checkout/{type}', [EscortController::class, 'listing_checkout'])->name('escort.account.listing_checkout');
Route::get('/listing/success', [EscortController::class, 'listing_success'])->name('escort.account.listing_success');

Route::get('/listings/{type}', [EscortController::class, 'listings'])->name('escort.dashboard.listings');
Route::post('/get-geo-location-profiles', [EscortController::class, 'getGeoLocationProfiles'])->name('listing.get_geo_location_profiles');
Route::post('/listing/validate-date-range', [EscortController::class, 'validateDateRange'])->name('listing.validate_date_range');
Route::get('/update-account', [EscortController::class, 'edit'])->name('escort.account.edit');
Route::post('/update-account', [EscortController::class, 'update'])->name('escort.account.update');
Route::post('/notification-update', [EscortController::class, 'notificationUpdate'])->name('escort.notification.update');
Route::post('/profile-&-tour-permission', [EscortController::class, 'profileTourPermissionUpdate'])->name('escort.account.profile.tour.update');
Route::get('/change-password', [EscortController::class, 'editPassword'])->name('escort.change.password');

Route::post('/change-password', [UserController::class, 'updatePassword'])->name('escort.update.password');
Route::post('/change-password-expiry', [UserController::class, 'updatePasswordExpiry'])->name('escort.update.password.expiry');


Route::get('/notifications-features', [EscortController::class, 'notificationsFeatures'])->name('escort.profile.notifications');
Route::post('/notifications-features', [EscortController::class, 'updateNotificationsFeatures'])->name('escort.profile.notifications');


Route::get('/upload-my-avatar', [EscortController::class, 'uploadAvatar'])->name('escort.profile.avatar');

Route::get('profile/{id}', [UpdateController::class, 'updateProfile'])->name('escort.update.profile');
Route::post('delete-profile/{id}', [UpdateController::class, 'deleteProfile'])->name('escort.delete.profile');
Route::post('save-member-type/{id}', [UpdateController::class, 'saveMembership'])->name('escort.save.memberType');


// suspend profile
Route::post('/escort-suspend/profile-credit', [EscortSuspendProfileController::class, 'suspendProfileCredit'])->name('suspend.calculate.credit.live');
Route::post('escort-suspend/profile', [EscortSuspendProfileController::class, 'suspendProfile'])->name('escort.profile.suspend');


Route::get('view-archive/{id?}', [CreateController::class, 'archives'])->name('escort.archives');
// Route::get('view-archive-profile-folder/{id?}',[CreateController::class,'archivesProfile'])->name('escort.archives.profile-folder');

Route::get('archives-media/{id?}', [CreateController::class, 'archivesMedia'])->name('escort.archives');
Route::get('media-masseurs/{id?}', [CreateController::class, 'archivesMediamasseurs'])->name('escort.archives');
Route::get('media-masseurs01/{id?}', [CreateController::class, 'archivesMediamasseurs01'])->name('escort.archives');


//ESCORT PROFILE RELATED
Route::get('create-profile/{id?}', [CreateController::class, 'index'])->name('escort.profile');
Route::post('setting-profile/{id?}', [UpdateController::class, 'createBySetting'])->name('escort.setting.profile');
Route::post('save-profile-media/{id}', [UpdateController::class, 'saveProfileMedia'])->name('escort.profile.media');
Route::post('save-profile-video/{id}', [UpdateController::class, 'saveProfileVideo'])->name('escort.profile.video');
Route::post('duplicate-profile', [UpdateController::class, 'duplicateProfile'])->name('escort.duplicate.profile');
Route::post('update-escort/{id?}', [UpdateController::class, 'update_escort'])->name('escort.update_escort');
Route::post('update_escort_default', [UpdateController::class, 'update_escort_default'])->name('escort.update_escort_default');

//update narration value using ajax in the New Profile
Route::post('/get-narration', [UpdateController::class, 'getNarration'])->name('escort.get.narration');

Route::post('create-profile/{id}', [CreateController::class, 'createProfile'])->name('escort.create.profile'); //create and update
Route::get('update-profile/{id?}', [UpdateController::class, 'updateBasicProfile'])->name('escort.profile.basic.update');
Route::post('upload-media', [CreateController::class, 'saveMedia'])->name('upload.media');
Route::delete('delete-media/{id}', [CreateController::class, 'deleteMedia'])->name('escort.delete.media');
Route::post('mark-default/{id}', [CreateController::class, 'markDefault'])->name('escort.media.mark.default');
Route::get('next-step/{id}', [CreateController::class, 'nextStep'])->name('escort.next.step');


Route::post('policy/{id}', [UpdateController::class, 'updatePolicy'])->name('escort.update.policy');
Route::post('profile/{id}', [UpdateController::class, 'storeAboutMe'])->name('escort.about.me');
/////////settings
Route::get('profile-information', [ProfileInformationController::class, 'showAboutMe'])->name('escort.profile.information');
Route::post('settings-information', [ProfileInformationController::class, 'storeAboutMe'])->name('escort.settings.about.me');
Route::post('settings-information/sort-stage-name', [ProfileInformationController::class, 'sortByStageNameAboutMe'])->name('escort.settings.sort-stage-name.about.me');
Route::post('settings-my-rates', [ProfileInformationController::class, 'storeRates'])->name('escort.settings.rate');
Route::post('settings-availability', [ProfileInformationController::class, 'storeAvailability'])->name('escort.settings.availability');
Route::post('settings-services', [ProfileInformationController::class, 'storeServices'])->name('escort.settings.services');
Route::post('settings-socials-link', [ProfileInformationController::class, 'storeSocialsLink'])->name('escort.settings.social');
Route::post('available-playmates', [ProfileInformationController::class, 'escortplaymate'])->name('escort.playmate.check');
Route::post('available-playmates-check', [ProfileInformationController::class, 'escortplaymate'])->name('escort.availabe-playmate.check');
//Additonaly Information
Route::post('my-information/stage-name/store', [ProfileInformationController::class, 'storeEscortStageName'])->name('escort.stagename.store');
Route::post('my-information/stage-name/delete', [ProfileInformationController::class, 'deleteEscortStageName'])->name('escort.stagename.delete');
Route::post('my-information/additional-store', [ProfileInformationController::class, 'additionalStorage'])->name('escort.additional.store');
Route::post('my-information/additional-delete', [ProfileInformationController::class, 'additionalDelete'])->name('escort.additional.delete');
Route::post('my-information/update-default-additional', [ProfileInformationController::class, 'updateDefaultAdditional'])->name('escort.additional.update_default');

//Route::post('settings-upload-avatar',[ProfileInformationController::class,'storeSocialsLink'])->name('settings.save.avatar');
//////////////end settings
//////////my account upload my avatar
Route::post('/upload-avatar/{id}', [EscortController::class, 'storeMyAvatar'])->name('escort.save.avatar');
Route::post('/remove-avatar', [EscortController::class, 'removeMyAvatar'])->name('escort.avatar.remove');
////////////end.


Route::post('update-read-more/{id}', [UpdateController::class, 'storeReadMore'])->name('escort.read.more');
Route::post('update-about/{id}', [UpdateController::class, 'storeAbout'])->name('escort.about');
Route::post('services/{id}', [UpdateController::class, 'storeServices'])->name('escort.store.services');
Route::post('rates/{id}', [UpdateController::class, 'storeRates'])->name('escort.store.rate');
Route::post('availability/{id}', [UpdateController::class, 'storeAvailability'])->name('escort.store.availability');

Route::get('check-profile-name', [UpdateController::class, 'checkProfileName'])->name('escort.checkProfileName');

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

Route::get('view-archives', function () {
  return view('escort.dashboard.archives.view-archives');
});
Route::get('payments-confirmation', function () {
  return view('escort.dashboard.payments-confirmation');
});
Route::get('archive-profiles', function () {
  return view('escort.dashboard.archives.archive-profiles');
});
Route::get('archive-view-profiles', [ArchivesController::class, 'profileStates'])->name('escort.state.profiles');
// Route::get('archive-view-profiles',function(){
//     return view('escort.dashboard.archives.archive-view-profiles');
// });
Route::get('archive-view-profiles-list/{id}', [ArchivesController::class, 'profileStatesList'])->name('escort.state.profiles.list');
Route::get('archive-view-profiles-datatable/', [ArchivesController::class, 'stateDataTable'])->name('escort.stateId.profile.list.dataTable');
Route::get('archive-view-profiles-list-datatable/{id}', [ArchivesController::class, 'stateDataTable'])->name('escort.state.profile.list.dataTable');

Route::post('/view-tour', [TourController::class, 'viewTour'])->name('escort.view.tour');

Route::get('/archive-tour-{name?}/{id}', [TourController::class, 'tourProfileList'])->name('escort.archive.tour.name');
Route::post('/create-tour/{id?}', [TourController::class, 'createStoreTour'])->name('escort.store.tour');
Route::get('/create-tour/{id?}', [TourController::class, 'createTour'])->name('escort.store.tour');
Route::get('/current-tour/{id?}', [TourController::class, 'createTour'])->name('escort.current.tour');
Route::get('/past-tour/{id?}', [TourController::class, 'createTour'])->name('escort.past.tour');

Route::post('/delete-tour/{id}', [TourController::class, 'DeleteTour'])->name('escort.delete.tour');
Route::get('/archive-tours-list', [TourController::class, 'viewTourList'])->name('escort.tour.view');
Route::get('/archive-tours-dataTable/{type?}', [TourController::class, 'TourDataTable'])->name('escort.tour.dataTable');
Route::post('/get_tour_location_listing', [EscortTourScheduleContoller::class, 'getTourLocationListing'])->name('escort.tour.location_listing');
Route::post('/cancel_tour_location', [EscortTourScheduleContoller::class, 'cancelTourLocation'])->name('escort.tour.cancel_tour_location');
Route::post('/cancel_tour', [EscortTourScheduleContoller::class, 'cancelTour'])->name('escort.tour.cancel');
Route::post('/archive-tours-edit/{id}', [TourController::class, 'viewTourEdit'])->name('escort.tour.edit');
/** Start Tour pin up */
Route::post('/get-tour-locations', [TourController::class, 'getTourLocations'])->name('escort.tour.locations');
Route::post('/get-tour-location-profiles', [TourController::class, 'getTourLocationProfiles'])->name('escort.tour.location_profiles');
Route::post('/register-tour-pinup', [TourController::class, 'registerTourPinup'])->name('escort.tour.pinup');
/** End Tour pin up */

Route::get('archive-myplaybox', function () {
  return view('escort.dashboard.archives.myplaybox');
});

Route::get('pricarchive-myplayboxing', function () {
  return view('escort.dashboard.archives.myplaybox');
})->name('escort.archive-myplaybox');

Route::get('complete-listings/', function () {
  return view('escort.dashboard.complete-listings');
})->name('escort.complete-listings');


Route::get('archive-tours', function () {
  return view('escort.dashboard.archives.archive-tours');
});
Route::get('archive-tour-profiles', function () {
  return view('escort.dashboard.archives.archive-tour-profiles');
});

// Route::get('archive-tour-summer',function(){
//     return view('escort.dashboard.archives.archive-tour-summer');
// });
// Route::get('archive-tour-view-profiles',function(){
//     return view('escort.dashboard.archives.archive-tour-view-profiles');
// });
Route::post('/escort/media-verification/upload', [EscortGalleryController::class, 'mediaVerificationUpload'])->name('escort.media.verification.upload');
Route::post('get-image-info', [EscortGalleryController::class, 'getImageInfo'])->name('escort.get-image-info');

Route::get('archive-medias', function () {
  return view('escort.dashboard.archives.archive-medias');
})->name('archive-medias');
Route::get('archive-view-photos', [EscortGalleryController::class, 'photoGalleries'])->name('escort.archive-view-photos');
Route::post('upload-galleries', [EscortGalleryController::class, 'uploadGallery'])->name('escort.upload.gallery');
Route::post('upload-videos-galleries', [EscortGalleryController::class, 'uploadVideosGaller'])->name('escort.upload.videos.gallery');
Route::post('default_photos', [EscortGalleryController::class, 'defaultImages'])->name('escort.default.images');
Route::post('default-videos', [EscortGalleryController::class, 'defaultVideos'])->name('escort.default.video');
Route::get('get-default-videos/{id?}', [EscortGalleryController::class, 'getDefaultVideos'])->name('escort.get.default.vedios');
Route::post('get-default-photos', [EscortGalleryController::class, 'getDefaultImages'])->name('escort.get.default.images');
Route::post('delete-photos/{id}', [EscortGalleryController::class, 'ImagesDelete'])->name('escort.delete.gallery');
Route::post('delete-videos/{id}', [EscortGalleryController::class, 'videosDelete'])->name('escort.delete.vedio.gallery');
Route::get('get-media-count', [EscortGalleryController::class, 'getMediaCOunt'])->name('escort.get-media-count');

Route::post('upload-chunk', [EscortGalleryController::class, 'uploadChunk'])->name('gallery.uploadChunk');
Route::post('merge-chunks', [EscortGalleryController::class, 'mergeChunks'])->name('gallery.mergeChunks');
// ,function(){
//     return view('escort.dashboard.archives.archive-view-photos');
// });
Route::get('archive-view-videos', [EscortGalleryController::class, 'videoGalleries'])->name('escort.archive-view-videos');
Route::get('get-account-media-gallery/{category?}/{status?}', [EscortGalleryController::class, 'getAccountMediaGallery'])->name('escort.account.gallery');
Route::get('get-account-video-gallery', [EscortGalleryController::class, 'getAccountVideoGallery'])->name('escort.account.video_gallery');
// Route::get('archive-view-videos',function(){
//     return view('escort.dashboard.archives.archive-view-videos');
// });
//new changess

// Route::get('task-list',function(){
//     return view('escort.dashboard.task-list');
// })->name('escort.dashboard.task-list');

# Dashboard escort tasks
Route::get('/task-list', [TaskListController::class, 'index'])->name('escort.dashboard.task-list');
Route::get('/task-fetch', [TaskListController::class, 'fetchTask'])->name('dashboard.ajax-fetch-task');
Route::post('/task-add', [TaskListController::class, 'addTask'])->name('dashboard.ajax-add-task');
Route::post('/task-edit', [TaskListController::class, 'editTask'])->name('dashboard.ajax-edit-task');
Route::post('/task-update', [TaskListController::class, 'updateTask'])->name('dashboard.ajax-update-task');
Route::post('/task-status', [TaskListController::class, 'statusTask'])->name('dashboard.ajax-change-status');
Route::post('/task-open', [TaskListController::class, 'openTask'])->name('dashboard.ajax-open-task');
Route::post('/task-delete', [TaskListController::class, 'destroy'])->name('dashboard.ajax-delete-task');





//
Route::get('archive-histories', function () {
  return view('escort.dashboard.archives.archive-histories');
});






Route::get('photo-video-verification', function () {
  return view('escort.dashboard.archives.photo-video-verification');
});
Route::get('profiles-tours', function () {
  return view('escort.dashboard.Annalytics.profiles-tours');
});
Route::get('social-media', function () {
  return view('escort.dashboard.Annalytics.social-media');
});
Route::get('feedback', function () {
  return view('escort.dashboard.Annalytics.feedback');
});
Route::get('criticalinformation', function () {
  return view('escort.dashboard.Annalytics.criticalinformation');
});

Route::get('my-bank-account', function () {
  return view('escort.dashboard.Bookkeeping.my-bank-account');
});

Route::get('reccomendations', function () {
  return view('escort.dashboard.Reviews.reccomendations');
});

# Wallet Module
Route::get('my-wallet', [WalletController::class, 'index'])->name('escort.my_wallet');
Route::get('wallet_transaction', [WalletController::class, 'transactionList'])->name('escort.wallet_transaction');

#Payment Module
Route::post('payments/process', [PaymentController::class, 'processPayment'])->name('escort.payment.process');
Route::get('transaction-summary', [PaymentController::class, 'transactionSummary'])->name('escort.payment.transaction_summary');
Route::get('get-transaction-summary', [PaymentController::class, 'transactionSummaryDatatable'])->name('escort.payment.transaction_summary.datatable');
Route::post('payments/detail', [PaymentController::class, 'paymentDetail'])->name('escort.payment.detail');
Route::get('payments/{payment}/print', [PaymentController::class, 'printPaymentDetail'])->name('escort.payment.detail.print');
Route::post('payments/adjustment', [PaymentController::class, 'paymentAdjustment'])->name('payment.adjustment');

Route::get('my-spend', [PaymentController::class, 'mySpend'])->name('escort.dashboard.my-spend');

// Route::post('apply/wallet',[PaymentController::class, 'applyWallet'])->name('apply.wallet');
# Escort profile reviews
Route::get('view-reviews', [EscortReviewsController::class, 'viewReviews'])->name('escort.view-reviews');
Route::get('reviews-by-ajax', [EscortReviewsController::class, 'getEscortProfileReviewsByAjax'])->name('escort.reviews-profile-by-ajax');
Route::get('advertiser-single-escort-reviews-ajax', [EscortReviewsController::class, 'getSingleEscortReviews'])->name('escort.single-escort-profile-reviews.ajax');
Route::post('user-review-status-update', [EscortReviewsController::class, "updateUserReviewStatus"])->name('user-review-status-update');
Route::get('get-user-review-details/{id}', [EscortReviewsController::class, "getSingleUserReviewDetails"])->name('get-single-user-review-details');

Route::get('escort-agency-request', function () {
  return view('escort.dashboard.Communication.escort-agency-request');
});
Route::get('send-notifications', function () {
  return view('escort.dashboard.Communication.send-notifications');
});
Route::get('viewer-notes', function () {
  return view('escort.dashboard.Communication.viewer-notes');
});
Route::get('viewer-messaging', function () {
  return view('escort.dashboard.Communication.viewer-messaging');
})->name('escort.viewer-messaging');
Route::get('accommodation', function () {
  return view('escort.dashboard.Concierge.accommodation');
});
Route::get('email-hosting', function () {
  return view('escort.dashboard.Concierge.email-hosting');
});
Route::get('mobile-read-sim', function () {
  return view('escort.dashboard.Concierge.mobile-read-sim');
});

Route::get('/order-history', [ProductOrderController::class, 'orders'])->name('bookkeeping.product.orders');

Route::prefix('concierge')->name('escort.')->group(function () {
  Route::get('/products', [ProductController::class, 'index'])->name('products');
  Route::get('view-cart', [ProductController::class, 'cartListing'])->name('view-cart');
  Route::post('get/products', [ProductController::class, 'getProducts'])->name('get.products');
  Route::post('transaction/summary', [ProductController::class, 'getTransactionSummary'])->name('transaction.summary');
  Route::post('make/order', [ProductOrderController::class, 'makeOrder'])->name('make.order');
  Route::post('make/order/payment', [ProductOrderController::class, 'makeOrderPayment'])->name('make.order.payment');
  // Route::get('/transaction-history', [ProductOrderController::class, 'orders'])->name('orders');
  Route::get('/order-list', [ProductOrderController::class, 'orderList'])->name('order.list');
  Route::get('/order-details', [ProductOrderController::class, 'getOrderDetails'])->name('order.details');
  Route::get('/print-order-details/{id}', [ProductOrderController::class, 'printOrderDetail'])->name('print.order.details');
});



Route::get('concierge/', function () {
  return view('escort.dashboard.Concierge.product-transaction-history');
})->name('escort.transaction-history');

Route::get('travel', function () {
  return view('escort.dashboard.Concierge.travel');
});
Route::get('visa-migration', function () {
  return view('escort.dashboard.Concierge.visa-migration');
});



Route::get('travel', function () {
  return view('escort.dashboard.Concierge.travel');
});
Route::get('visa-migration', function () {
  return view('escort.dashboard.Concierge.visa-migration');
});

Route::get('/list-tour/{type}', [TourController::class, 'viewTourList'])->name('escort.view.tour.list');

Route::get('/tour-schedule', [EscortTourScheduleContoller::class, 'index'])->name('escort.dashboard.tour-schedule');
Route::get('/get-tour-schedule-ajax', [EscortTourScheduleContoller::class, 'getTourScheduleByAjax'])->name('escort.dashboard.get-tour-schedule-ajax');
Route::post('/update-tour-status-ajax', [EscortTourScheduleContoller::class, 'updateTourScheduleStatus'])->name('escort.dashboard.update-tour-status-ajax');
Route::post('/get-tour-summary-ajax', [EscortTourScheduleContoller::class, 'getTourSummaryAjax'])->name('escort.dashboard.get-tour-summary-ajax');

Route::get('photo-video-verification', function () {
  return view('escort.dashboard.PhotoVideo.photo-video-verification');
});




Route::get('Community', function () {
  return view('escort.dashboard.Community.abbreviations');
})->name('escort.dashboard.Community.abbreviations');
//////////tour payment

Route::get('pricing', [EscortController::class, 'showPricingsummary'])->name('escort.dashboard.Community.pricing');
Route::post('calculate-reckoner', [PricingsummariesController::class, 'calculate'])->name('escort.reckoner-calculate');
Route::post('poli-paymentUrl', [EscortPolyPaymentController::class, 'polyPaymentUrl'])->name('escort.poli.paymentUrl');
Route::get('paymentUrl-status-success/{id}', [EscortPolyPaymentController::class, 'successUrl'])->name('escort.poly.paymentUrl.status.success');
Route::get('paymentUrl-status-FailureURL/{id}', [EscortPolyPaymentController::class, 'FailureURL'])->name('escort.poly.paymentUrl.status.FailureURL');
Route::get('paymentUrl-status-CancellationURL/{id}', [EscortPolyPaymentController::class, 'CancellationURL'])->name('escort.poly.paymentUrl.status.CancellationURL');
Route::get('paymentUrl-status-NotificationURL/{id}', [EscortPolyPaymentController::class, 'NotificationURL'])->name('escort.poly.paymentUrl.status.NotificationURL');
////////////tour payment status
Route::post('tour-paymentUrl/{id}', [EscortTourPaymentController::class, 'polyPaymentUrl'])->name('escort.tour.paymentUrl');
Route::post('tour-paymentUrl/{id}', [EscortTourPaymentController::class, 'polyPaymentUrl'])->name('escort.tour.paymentUrl');
Route::get('tour-paymentUrl-status-success/{id}', [EscortTourPaymentController::class, 'successUrl'])->name('escort.tour.paymentUrl.status.success');
Route::get('tour-paymentUrl-status-FailureURL/{id}', [EscortTourPaymentController::class, 'FailureURL'])->name('escort.tour.paymentUrl.status.FailureURL');
Route::get('tour-paymentUrl-status-CancellationURL/{id}', [EscortTourPaymentController::class, 'CancellationURL'])->name('escort.tour.paymentUrl.status.CancellationURL');
Route::get('tour-paymentUrl-status-NotificationURL/{id}', [EscortTourPaymentController::class, 'NotificationURL'])->name('escort.tour.paymentUrl.status.NotificationURL');

Route::get('report', function () {
  return view('escort.dashboard.UglyMugsRegister.report');
})->name('escort.report');
Route::post('ugly-mug-register', [MugsController::class, 'create'])->name('escort.mug.register');
Route::get('ugly-mug/dataTable', [MugsController::class, 'dataTable'])->name('escort.mug.dataTable');

Route::get('add-report', [NumController::class, 'addReport'])->name('escort.add-report');
Route::post('add-report', [NumController::class, 'storeReport'])->name('escort.store-report');
Route::get('num-dashboard', [NumController::class, 'showReportOnDashboardAjax'])->name('escort.numdashboard');
Route::get('my-reports', [NumController::class, 'showMyReportByAjax'])->name('escort.my-reports');
Route::get('edit-my-reports/{id}', [NumController::class, 'editMyReport'])->name('escort.edit-my-reports');
Route::post('update-my-reports', [NumController::class, 'updateMyReportByAjax'])->name('escort.update-my-reports');


Route::get('/influencer/uploads', function () {
  return view('escort.dashboard.influencer.uploads');
})->name('escort.uploads');

Route::get('/influencer/guidelines', function () {
  return view('escort.dashboard.influencer.guidelines');
})->name('escort.guidelines');


Route::get('lookup', function () {
  return view('escort.dashboard.UglyMugsRegister.lookup');
})->name('escort.lookup');

Route::get('request-notification', function () {
  return view('escort.dashboard.UglyMugsRegister.request-notification');
})->name('escort.request-notification');

Route::get('num-tips', function () {
  return view('escort.dashboard.UglyMugsRegister.num-tips');
})->name('escort.num-tips');

Route::get('code-of-conduct', function () {
  return view('escort.dashboard.UglyMugsRegister.code-of-conduct');
})->name('escort.code-of-conduct');

Route::get('/my-playmates', [MyPlaymatesContoller::class, 'index'])->name('escort.dashboard.my-playmates');
Route::post('/my-playmates', [MyPlaymatesContoller::class, 'myPlaymateDataTable'])->name('escort.dashboard.my-playmates');
Route::post('/get-playmate-listings', [MyPlaymatesContoller::class, 'getPlaymateListingsDataTable'])->name('escort.dashboard.get-playmate-listings');
Route::post('/trash-playmate-history', [MyPlaymatesContoller::class, 'trashPlaymateHistory'])->name('escort.dashboard.trash-playmate-history');

Route::get('home-state/', [EscortController::class, 'homeState'])->name('escort.home-state');
Route::post('add-playmate/{id}', [ProfileInformationController::class, 'savePlaymate'])->name('escort.add.playmate');
Route::post('remove-playmate/{id}', [ProfileInformationController::class, 'removePlaymate'])->name('escort.remove.playmate');
//Route::get('my-play-mates',[ProfileInformationController::class, 'myNewPlaymate'])->name('escort.my.playmates');
// Route::get('my-play-mates',function(){
//     return view('escort.dashboard.Playmates.playmates');
// })->name('my.playmates');
Route::post('escort-state-name/{id}', [TourController::class, 'nameByState'])->name('escort.stateId');
Route::get('/get-account-locations', [TourController::class, 'getAccountLocations'])->name('account.locations');
Route::get('/get-account-profiles', [TourController::class, 'getAccountProfiles'])->name('account.location_profiles');
Route::post('/save-account-tour', [TourController::class, 'saveAccountTour'])->name('account.save_tour');
Route::post('/update-account-tour/{id}', [TourController::class, 'updateAccountTour'])->name('account.update_tour');
Route::get('/tour-checkout/{type}/{id}', [TourController::class, 'tourCheckout'])->name('account.checkout_tour');
Route::post('/tour/validate-date-range', [TourController::class, 'validateDateRange'])->name('tour.validate_date_range');


Route::post('agent-request', [AgentRequestController::class, 'agentRequest'])->name('escort.agent-request');

Route::get('get-notification', [NotificationController::class, 'getNotification'])->name('escort.get-notification');
Route::post('notification-seen', [NotificationController::class, 'makeNotificationSeen'])->name('escort.notification-seen');



Route::get('customise-dashboard', [EscortController::class, 'customiseDashboard'])->name('escort.dashboard.customise-dashboard');
Route::post('customise-dashboard', [EscortController::class, 'updateCustomiseDashboard'])->name('escort.dashboard.customise-dashboard');
Route::post('available-playmates', [PlaymateController::class, 'getAvailablePlaymates'])->name('escort.available_playmates');
Route::post('playmates/{id}', [PlaymateController::class, 'storePlaymates'])->name('escort.store.playmates');
Route::post('/update-password', [AgentAccountController::class, 'changePassword'])->name('escort.update-password');

// Route::get('customise-dashboard',function(){
//     return view('escort.dashboard.customise-dashboard');
// })->name('escort.dashboard.customise-dashboard');

// Route::get('profile', [HowIsItDoneController::class, 'profile'])->name('escort.how_is_it_done.profile');


//Escort DashBorad Route And Controller
Route::get('logs-and-status', [EscortDashboardController::class, 'LogAndStatus'])->name('logs.and.status');
Route::post('update-password-duration', [EscortDashboardController::class, 'updatePasswordDuration'])->name('update.password.duration');

Route::get('editmyaccount', function () {
  return view('escort.dashboard.HowDone.editmyaccount');
})->name('escort.editmyaccount');

Route::get('my-information', function () {
  return view('escort.dashboard.HowDone.my-information');
})->name('escort.my-information');

Route::get('how-is-it-done/listings', function () {
  return view('escort.dashboard.HowDone.listings');
})->name('escort.listings');

Route::get('media', function () {
  return view('escort.dashboard.HowDone.media');
})->name('escort.media');

Route::get('profiles', function () {
  return view('escort.dashboard.HowDone.profiles');
})->name('escort.profiles');

Route::get('tours', function () {
  return view('escort.dashboard.HowDone.tours');
})->name('escort.tours');

Route::get('/my-statistics', [EscortStatisticsController::class, 'index'])->name('escort.dashboard.my-statistics');
