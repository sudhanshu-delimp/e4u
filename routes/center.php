<?php

use App\Http\Controllers\Agent\AgentAccountController;
use App\Http\Controllers\Agent\AgentRequestController;
use App\Http\Controllers\Center\CenterController;
use App\Http\Controllers\Center\CenterNumController;
use App\Http\Controllers\Center\CenterProfileInformationController;
use App\Http\Controllers\Center\MassageCenterAccountController;
use App\Http\Controllers\Center\MassageGalleryController;
use App\Http\Controllers\Center\MassageViewerInteractionController;
use App\Http\Controllers\Center\Masseurs\MasseurController;
use App\Http\Controllers\Center\MediaController;
use App\Http\Controllers\Center\OtherCenterController;
use App\Http\Controllers\Center\PaymentController;
use App\Http\Controllers\Escort\PaymentController as EscortPaymentController;
use App\Http\Controllers\Center\PolyPaymentController;
use App\Http\Controllers\Center\Profile\CreateController;
use App\Http\Controllers\Center\Profile\MassageController;
use App\Http\Controllers\Center\Profile\MassageProfileActionController;
use App\Http\Controllers\Center\Profile\UpdateController;
use App\Http\Controllers\Escort\EscortController;
use App\Http\Controllers\Escort\EscortGalleryController;
use App\Http\Controllers\MyAdvertiser\PricingsummariesController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Center\CenterReviewsController;
use App\Http\Controllers\Center\MassageCenterDashboardController;
use App\Http\Controllers\Center\WalletController;
use App\Http\Controllers\Escort\Concierge\ProductController;
use App\Http\Controllers\Escort\Concierge\ProductOrderController;
use App\Http\Controllers\Center\LegboxNotificationController;

Route::get('/', [CenterController::class, 'index'])->name('center.dashboard');
Route::get('/dashboard', [CenterController::class, 'index'])->name('center.dashboard.impersonate');
Route::get('/list/data-table', [CenterController::class, 'dataTable'])->name('center.list.dataTable');
Route::post('/profile-contact-permission', [EscortController::class, 'profileTourPermissionUpdate'])->name('center.account.profile.contact.update');
//Route::get('profile/{id}',[CenterController::class,'updateProfile'])->name('center.update.profile');
Route::post('delete-profile/{id}', [CenterController::class, 'deleteProfile'])->name('center.delete.profile');

// SHS
Route::get('active-notification', [CenterController::class, 'getActiveNotification'])->name('center.active.notification');
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
Route::post('upload-avatar/{id}', [CenterController::class, 'storeMyAvatar'])->name('center.save.avatar');
Route::post('remove-avatar', [CenterController::class, 'removeMyAvatar'])->name('center.avatar.remove');

Route::get('update-account', [CenterController::class, 'edit'])->name('center.account.edit');
Route::post('update-account', [CenterController::class, 'update'])->name('center.account.update');




Route::post('add-sub-account', [OtherCenterController::class, 'add_sub_account'])->name('center.add-sub-account');
Route::post('all-other-centre-list', [OtherCenterController::class, 'get_all_other_centre_list'])->name('center.all-other-centre-list');
Route::post('action-account', [OtherCenterController::class, 'account_action'])->name('center.action-account');

Route::get('switch-login/{id}', [OtherCenterController::class, 'switchLogin'])->name('center.switch-to-child');
Route::get('back-to-parent', [OtherCenterController::class, 'backToParent'])->name('center.back-to-parent');

//Route::get('profile-informations', [CenterProfileInformationController::class, 'showAboutMe'])->name('center.profile.information');
//Route::post('settings-information',[CenterProfileInformationController::class,'storeAboutMe'])->name('center.settings.about.me');
// Route::get('/my-account/change-password', function()
// 	{
// 		return view('center.my-account.change-password');
// 	})->name('center.my-account.change-password');

Route::get('/profile-completed', function () {
  return view('center.dashboard.profile-completed');
})->name('center.profile-completed');

// Route::get('/my-account/edit-my-account', function()
// 	{
// 		return view('center.my-account.edit-my-account');
// 	})->name('center.my-account.edit-my-account');

// Route::get('/my-account/profile-information', function()
// 	{
// 		return view('center.my-account.profile-information');
// 	})->name('center.my-account.profile-information');

Route::get('/profile-info/create-profile', function () {
  return view('center.profile-info.create-profile');
})->name('center.create-profile');

Route::get('/payments-confirmation', function () {
  return view('center.dashboard.payments-confirmation');
})->name('center.payments-confirmation');


///////////////profile



Route::get('create-profile', [MassageController::class, 'index'])->name('center.profile');
Route::post('create-profile', [MassageController::class, 'createProfile'])->name('center.create.profile');
Route::post('update-single-data', [MassageController::class, 'update_single_data'])->name('center.update-single-data');
Route::post('our-business', [MassageController::class, 'ourBusiness'])->name('center.our-business');
Route::get('update-profile/{id?}', [MassageController::class, 'getProfile'])->name('center.update-profile');
Route::post('update-massage-profile', [MassageController::class, 'updateprofile'])->name('center.update-massage-profile');
Route::get('/list', [MassageController::class, 'massager_list'])->name('center.list');
Route::post('all-massager-list', [MassageController::class, 'get_all_massager_list'])->name('center.all-massager-list');
Route::post('update-open-time', [MassageController::class, 'update_open_time'])->name('center.update-open-time');




Route::get('listing/add-listing', [MassageController::class, 'add_listing_page'])->name('center.add-listing');
Route::post('listing/add-listing', [MassageController::class, 'calculate_listed_user'])->name('center.add-listing');
Route::post('listing/listing-payment', [MassageController::class, 'listing_payment'])->name('center.listing-payment');
Route::get('listing/payment-completed', [MassageController::class, 'payment_completed'])->name('center.payment-completed');



Route::get('listing/current', function () {
  return view('center.dashboard.listing.current');
})->name('center.current');
Route::get('listing/past', function () {
  return view('center.dashboard.listing.past');
})->name('center.past');

Route::post('listing/current-listing', [MassageController::class, 'massager_current_listing'])->name('center.current-listing');
Route::post('listing/past-listing', [MassageController::class, 'massager_past_listing'])->name('center.past-listing');

Route::post('action-massage-profile', [MassageController::class, 'action_massage_profile'])->name('center.action-massage-profile');
Route::post('duplicate-massage-profile', [MassageController::class, 'duplicate_massage_profile'])->name('center.duplicate-massage-profile');


Route::post('massage-brb/add', [MassageProfileActionController::class, 'add'])->name('massage.brb.add');
Route::post('massage-brb/inactive/{id}', [MassageProfileActionController::class, 'inactive'])->name('massage.brb.inactive');
Route::post('massage-suspend-credit', [MassageProfileActionController::class, 'suspendProfileCredit'])->name('center.massage-suspend-credit');
Route::post('suspend-massage-profile', [MassageProfileActionController::class, 'suspendProfile'])->name('center.suspend-massage-profile');
Route::post('extend-profile-checkout', [MassageProfileActionController::class, 'extendProfileCheckout'])->name('center.extend-profile-checkout');
Route::post('extend-profile-validate-date-range', [MassageProfileActionController::class, 'validateDateRange'])->name('center.extend-profile-validate-date-range');
Route::post('get-transaction-summury', [MassageProfileActionController::class, 'getTransactionSummury'])->name('center.get-transaction-summury');
Route::post('/bumpup-register', [MassageProfileActionController::class, 'bumpup_register'])->name('center.bumpup_register');



Route::name('center.')->group(function () {

  Route::get('/products', [ProductController::class, 'index'])->name('products');
  Route::get('concierge/view-cart', [ProductController::class, 'cartListing'])->name('view-cart');
  Route::post('get/products', [ProductController::class, 'getProducts'])->name('get.products');
  Route::post('transaction-summary', [ProductController::class, 'getTransactionSummary'])->name('transaction.summary');
  Route::post('make/order', [ProductOrderController::class, 'makeOrder'])->name('make.order');
  Route::post('make/order/payment', [ProductOrderController::class, 'makeOrderPayment'])->name('make.order.payment');
  Route::get('/order-history', [ProductOrderController::class, 'orders'])->name('bookkeeping.product.orders');
  Route::get('/order-list', [ProductOrderController::class, 'orderList'])->name('order.list');
  Route::get('/order-details', [ProductOrderController::class, 'getOrderDetails'])->name('order.details');
  Route::get('/print-order-details/{id}', [ProductOrderController::class, 'printOrderDetail'])->name('print.order.details');
  Route::get('/transaction-history', [ProductOrderController::class, 'orders'])->name('orders');
Route::get('/order-history', [ProductOrderController::class, 'orders'])->name('bookkeeping.product.orders');

});

// 

// Route::get('listing/add-listing', function()
// {
// 	return view('center.dashboard.listing.add-listing');
// })->name('center.add-listing');







Route::post('make-time-json', [MassageController::class, 'make_time_json'])->name('center.make-time-json');


Route::get('archive-view-photos', [CenterProfileInformationController::class, 'galleries'])->name('cen.archive-view-photos');
Route::get('profile-informations', [CenterProfileInformationController::class, 'showAboutMe'])->name('center.profile.information');

Route::get('get-media-count', [CenterProfileInformationController::class, 'getMediaCOunt'])->name('center.get-media-count');

Route::get('get-masseurs-media-count', [MasseurController::class, 'getMediaCOunt'])->name('center.get-masseurs-media-count');
Route::post('upload-masseur-verification', [MasseurController::class, 'uploadMasseurVerification'])->name('center.upload-masseur-verification');


Route::post('validate-phone', [MasseurController::class, 'validate_phone'])->name('center.validate-phone');;
Route::get('create-new-masseur', [MasseurController::class, 'index'])->name('center.create-new-masseur');
Route::post('create-new-masseur', [MasseurController::class, 'add_masseur'])->name('center.create-new-masseur');
Route::get('update-masseur/{id?}', [MasseurController::class, 'edit_masseur'])->name('center.update-masseur');
Route::post('update-masseur', [MasseurController::class, 'update_masseur'])->name('center.update-masseur');
Route::post('delete-masseur-photos/{id}', [MasseurController::class, 'ImagesDelete'])->name('center.delete-masseur-photos');
Route::post('default_photos_masseur', [MasseurController::class, 'defaultImages'])->name('center.masseur.default.images');

Route::post('masseur-option-list', [MasseurController::class, 'masseur_option_list'])->name('center.masseur-option-list');
Route::post('get-masseur-option-list', [MasseurController::class, 'get_masseur_option_list'])->name('center.get-masseur-option-list');
Route::post('filter-masseur-option-list', [MasseurController::class, 'get_filter_masseur_option_list'])->name('center.filter-masseur-option-list');
Route::post('load-default-masseur-list', [MasseurController::class, 'get_load_default_masseur_list'])->name('center.load-default-masseur-list');






Route::post('create-action-messure-profile', [MasseurController::class, 'action_messure_profile'])->name('center.action-messure-profile');
Route::get('create-check-messure-profile', [MasseurController::class, 'count_messure_profile'])->name('center.check-messure-profile');


Route::post('all-masseur-list', [MasseurController::class, 'get_all_masseur_list'])->name('center.all-masseur-list');
Route::post('masseurs/archives-listing', [MasseurController::class, 'masseur_list'])->name('center.archives-listing');


Route::post('center.massuers-media-upload-gallery', [MasseurController::class, 'uploadGallery'])->name('center.massuers-media-upload-gallery');
Route::get('get-massuers-account-media-gallery/{category?}/{pagetoken?}/{status?}', [MasseurController::class, 'getAccountMediaGallery'])->name('center.massuers.account.gallery');


############# Payment Process ####################
Route::post('payments/make_order_summury', [PaymentController::class, 'make_order_summury'])->name('center.make_order_summury');
Route::post('payments/adjustment', [PaymentController::class, 'paymentAdjustment'])->name('center.payment.adjustment');

Route::post('payments/process', [PaymentController::class, 'processPayment'])->name('center.payment.process');
Route::post('payments/payment-session', [PaymentController::class, 'checkPaymentSession'])->name('center.check-payment-session');

Route::get('transaction-summary', [PaymentController::class, 'transactionSummary'])->name('center.transaction-summary');
Route::get('get-transaction-summary', [PaymentController::class, 'transactionSummaryDatatable'])->name('center.transaction_summary.datatable');
Route::post('payments/detail', [PaymentController::class, 'paymentDetail'])->name('center.payment.detail');
Route::get('payments/{payment}/print', [PaymentController::class, 'printPaymentDetail'])->name('payment.detail.print');


# Wallet Module
Route::get('my-wallet', [WalletController::class, 'index'])->name('center.my_wallet');
Route::get('wallet_transaction', [WalletController::class, 'transactionList'])->name('center.wallet_transaction');
Route::post('advertiser/payments/adjustment', [EscortPaymentController::class, 'paymentAdjustment'])->name('advertiser.payment.adjustment');
Route::post('advertiser/payments/process', [EscortPaymentController::class, 'processPayment'])->name('advertiser.payment.process');






// Route::get('masseurs/new-listing', function()
// {
// 	return view('center.dashboard.masseurs.new-listing');
// })->name('center.new-listing');

//Route::get('update-profile/{id?}',[CreateController::class,'updateBasicProfile'])->name('center.profile.basic.update');
//create new profile
Route::post('setting-profile/{id?}', [UpdateController::class, 'createBySetting'])->name('center.setting.profile');
//end

Route::post('upload-media', [CreateController::class, 'saveMedia'])->name('upload.media');
Route::delete('delete-media/{id}', [CreateController::class, 'deleteMedia'])->name('center.delete.media');
Route::post('mark-default/{id}', [CreateController::class, 'markDefault'])->name('center.media.mark.default');
Route::get('next-step/{id}', [CreateController::class, 'nextStep'])->name('center.next.step');


Route::post('policy/{id}', [UpdateController::class, 'updatePolicy'])->name('center.update.policy');
Route::post('profile/{id?}', [UpdateController::class, 'storeAboutMe'])->name('center.about.me');
Route::get('profile/{id}', [UpdateController::class, 'updateProfile'])->name('center.update.profile');
//Route::post('delete-profile/{id}',[UpdateController::class,'deleteProfile'])->name('center.delete.profile');
Route::post('save-member-type/{id}', [UpdateController::class, 'saveMembership'])->name('center.save.memberType');
//Route::post('upload-galleries',[CenterProfileInformationController::class,'uploadGaller'])->name('center.upload.gallery');
////////////////////////end
///////////////seting
Route::post('poli-paymentUrl/{id}', [PolyPaymentController::class, 'polyPaymentUrl'])->name('center.poli.paymentUrl');
Route::get('paymentUrl-status-success', [PolyPaymentController::class, 'successUrl'])->name('center.poly.paymentUrl.status.success');

/////////settings

Route::post('settings-information', [CenterProfileInformationController::class, 'storeAboutMe'])->name('center.settings.about.me');
Route::post('settings-my-rates', [CenterProfileInformationController::class, 'storeRates'])->name('center.settings.rate');
Route::post('settings-availability', [CenterProfileInformationController::class, 'storeAvailability'])->name('center.settings.availability');
Route::post('settings-services', [CenterProfileInformationController::class, 'storeServices'])->name('center.settings.services');
Route::post('settings-socials-link', [CenterProfileInformationController::class, 'storeSocialsLink'])->name('center.settings.social');

//Route::post('settings-upload-avatar',[ProfileInformationController::class,'storeSocialsLink'])->name('settings.save.avatar');
//////////////end settings
/////////////end

Route::get('customise-dashboard', [CenterController::class, 'customiseDashboard'])->name('center.dashboard.customise-dashboard');
Route::post('customise-dashboard', [CenterController::class, 'updateCustomiseDashboard'])->name('center.dashboard.customise-dashboard');


Route::get('logs-and-status', [CenterController::class, 'LogsAndStatus'])->name('center.logs-and-status');
Route::post('center-update-password-duration', [CenterController::class, 'updatePasswordDuration'])->name('center.update.password.duration');


//USED CONFIRM
//****Bank Account*****/
Route::get('bank_account', [MassageCenterAccountController::class, 'bankDetails'])->name('massage.bank_account');
Route::post('save-bank-details', [MassageCenterAccountController::class, 'saveBankDetails'])->name('massage.save.bank.details');
Route::get('bank-details', [MassageCenterAccountController::class, 'BankDataTable'])->name('massage.bankDetail.dataTable');
Route::post('check-bank-otp', [MassageCenterAccountController::class, 'checkOTP'])->name('massage.checkOTP');
Route::post('delete-massage-bank/{id}', [MassageCenterAccountController::class, 'deleteMassageBank']);
Route::post('update-bank-pin', [MassageCenterAccountController::class, 'updateBankPin'])->name('massage.update.bank.pin');
Route::post('get-eft-bank-details', [MassageCenterAccountController::class, 'getEftBankDetails'])->name('massage.get.eft.bank.details');
Route::post('/send-payment-receipt-center', [MassageCenterAccountController::class, 'sendPaymentReceiptCenter'])->name('center.send-payment-receipt-center');

Route::post('send-otp-for-pin-change', [MassageCenterAccountController::class, 'sendOtpForPinChange'])->name('center.send-otp-for-pin-change');

Route::get('centre-statistics', function () {
  return view('center.dashboard.centre-statistics');
})->name('center.dashboard.centre-statistics');

Route::get('legbox-viewer', function () {
  return view('center.dashboard.legbox-viewer');
})->name('center.dashboard.legbox-viewer');


Route::get('our-spend', [MassageCenterDashboardController::class,'dashboard'])->name('center.dashboard.our-spend');


Route::get('our-statistics', function () {
  return view('center.dashboard.our-statistics');
})->name('center.dashboard.our-statistics');

Route::get('task-list', function () {
  return view('center.dashboard.task-list');
})->name('center.dashboard.task-list');

Route::get('manage-masseurs', function () {
  return view('center.dashboard.manage-masseurs');
})->name('center.dashboard.manage-masseurs');

Route::get('manage-media', function () {
  return view('center.dashboard.manage-media');
})->name('center.dashboard.manage-media');

// Route::get('masseurs-statistics',function(){massage_profile_data
//     return view('center.dashboard.masseurs-statistics');
// })->name('center.dashboard.masseurs-statistics');

// Route::get('logs-and-status',function(){
//     return view('center.dashboard.logs-and-status');
// })->name('center.dashboard.logs-and-status');









// add Masseurs Profle Route


Route::get('archives-listing', function () {
  return view('center.dashboard.masseurs.archives-listing');
})->name('center.archives-listing');



Route::get('masseurs/add-media', function () {
  return view('center.dashboard.masseurs.add-media');
})->name('center.add-media');


Route::get('masseurs/past-profile', function () {
  return view('center.dashboard.masseurs.past');
})->name('center.past-profile');


// add Media Masseurs Route
Route::get('media-masseurs/masseurs-photos', function () {
  return view('center.dashboard.media-masseurs.photos');
})->name('center.masseurs-photos');

Route::get('media-masseurs/masseurs-videos', function () {
  return view('center.dashboard.media-masseurs.videos');
})->name('center.masseurs-videos');



// add Media center Route
Route::get('media-centre/photos', function () {
  return view('center.dashboard.media-centre.photos');
})->name('center.photos');



// add Media center Route
Route::get('bookkeeping', [MassageCenterAccountController::class, 'index'])->name('center.bookkeeping');

Route::get('/profile-info/edit-profile', function () {
  return view('center.profile-info.edit-profile');
})->name('center.profile-info.edit-profile');


// Route::get('/notifications-and-features', function()
// {
// 	return view('center.my-account.notifications-and-features');
// })->name('centre.notifications-and-features');

// Route::get('media-centre/videos', function()
// {
// 	return view('center.dashboard.media-centre.videos');
// })->name('center.videos');


############ Media Videos ########################
Route::get('media-centre/videos', [MediaController::class, 'videoGalleries'])->name('center.videos');
Route::post('upload-chunk', [MassageGalleryController::class, 'uploadChunk'])->name('gallery.uploadChunk');
Route::post('merge-chunks', [MassageGalleryController::class, 'mergeChunks'])->name('gallery.mergeChunks');
Route::post('get-image-info', [MassageGalleryController::class, 'getImageInfo'])->name('center.get-image-info');
Route::post('get-masseur-image-info', [MasseurController::class, 'getImageInfo'])->name('center.get-masseur-image-info');

############ End Media Videos ########################

Route::get('notifications-and-features', [CenterProfileInformationController::class, 'massageSettings'])->name('centre.notifications-and-features');
Route::post('notifications-and-features', [CenterProfileInformationController::class, 'updateNotificationsAndFeatures'])->name('centre.notifications-and-features');


Route::get('view-archives', function () {
  return view('center.dashboard.archives.view-archives');
});
Route::get('archive-profiles', function () {
  return view('center.dashboard.archives.archive-view-profiles');
})->name('cen.archive.profile');

Route::get('archive-tours', function () {
  return view('center.dashboard.archives.archive-tours');
})->name('cen.archive.tours');

Route::get('archive-medias', function () {
  return view('center.dashboard.archives.archive-medias');
})->name('cen.archive-medias');

Route::get('archive-view-profiles-list/{id}', function () {
  return view('center.dashboard.archives.archive-view-profiles-list');
})->name('cen.archive-view-profiles-list');

Route::get('archive-tour-profiles', function () {
  return view('center.dashboard.archives.archive-tour-profiles');
})->name('cen.archive-tour-profiles');

Route::post('/update-password', [AgentAccountController::class, 'changePassword'])->name('center.update-password');




// Route::post('default_photos', [CenterProfileInformationController ::class, 'defaultImages'])->name('center.default.images');
// Route::post('get-default-photos', [CenterProfileInformationController ::class, 'getDefaultImages'])->name('center.get.default.images');
// Route::post('delete-photos/{id}', [CenterProfileInformationController ::class, 'ImagesDelete'])->name('center.delete.gallery');

Route::get('archive-view-videos', [MassageGalleryController::class, 'videoGalleries'])->name('center.archive-view-videos');
Route::get('get-account-media-gallery/{category?}/{status?}', [MassageGalleryController::class, 'getAccountMediaGallery'])->name('center.account.gallery');
Route::post('upload-galleries', [MassageGalleryController::class, 'uploadGallery'])->name('center.upload.gallery');
Route::post('upload-videos-galleries', [MassageGalleryController::class, 'uploadVideosGaller'])->name('center.upload.videos.gallery');
Route::post('default_photos', [MassageGalleryController::class, 'defaultImages'])->name('center.default.images');
Route::post('default-videos', [MassageGalleryController::class, 'defaultVideos'])->name('center.default.video');
Route::get('get-default-videos/{id?}', [MassageGalleryController::class, 'getDefaultVideos'])->name('center.get.default.vedios');
Route::post('get-default-photos', [MassageGalleryController::class, 'getDefaultImages'])->name('center.get.default.images');
Route::post('delete-photos/{id}', [MassageGalleryController::class, 'ImagesDelete'])->name('center.delete.gallery');
Route::post('delete-videos/{id}', [MassageGalleryController::class, 'videosDelete'])->name('center.delete.vedio.gallery');
Route::get('get-account-video-gallery', [MassageGalleryController::class, 'getAccountVideoGallery'])->name('center.account.video_gallery');
Route::post('/media-verification/upload', [MassageGalleryController::class, 'mediaVerificationUpload'])->name('center.media.verification.upload');



Route::get('pricing', [CenterController::class, 'pricing'])->name('center.dashboard.Community.pricing');
Route::post('calculate-reckoner', [PricingsummariesController::class, 'calculate'])->name('centre.reckoner-calculate');

// function(){
//     return view('center.dashboard.archives.archive-view-photos');
// })->name('cen.archive-view-photos');

// Route::get('archive-view-videos',function(){
//     return view('center.dashboard.archives.archive-view-videos');
// })->name('cen.archive-view-videos');

Route::get('register-for-pin-up', function () {
  return view('center.dashboard.registerPinup.register-pin-up');
});

// Route::get('pricing',function(){
//     return view('center.dashboard.Community.pricing');
// })->name('center.dashboard.Community.pricing');

Route::get('submitticket', function () {
  return view('center.dashboard.supportticket.submitticket');
})->name('center.dashboard.supportticket.submitticket');

Route::get('Community', function () {
  return view('center.dashboard.Community.abbreviations');
})->name('center.abbreviations');

Route::get('help', function () {
  //dd('hey');
  return view('center.dashboard.Community.help');
})->name('center.dashboard.Community.help');

Route::get('laws', function () {
  return view('center.dashboard.Community.laws');
})->name('center.dashboard.Community.laws');

Route::get('accommodation', function () {
  return view('center.dashboard.Concierge.accommodation');
})->name('center.accommodation');

Route::get('email-hosting', function () {
  return view('center.dashboard.Concierge.email-hosting');
})->name('center.email-hosting');

Route::get('mobile-read-sim', function () {
  return view('center.dashboard.Concierge.mobile-read-sim');
})->name('center.mobile-read-sim');

Route::get('professional-products', [ProductController::class, 'index'])->name('center.professional-products');

Route::get('travel', function () {
  return view('center.dashboard.Concierge.travel');
})->name('center.travel');


Route::get('visa', function () {
  return view('center.dashboard.Concierge.visa');
})->name('center.visa');

Route::get('profiles', function () {
  return view('center.dashboard.Annalytics.profiles');
})->name('profiles');

Route::get('masseurs', function () {
  return view('center.dashboard.Annalytics.masseurs');
})->name('masseurs');

Route::get('feedback', function () {
  return view('center.dashboard.Annalytics.feedback');
})->name('feedback');

Route::get('social-media', function () {
  return view('center.dashboard.Annalytics.social-media');
})->name('social-media');

Route::get('agent-request', function () {
  return view('center.dashboard.Communication.agent-request');
})->name('agent-request');


Route::get('agent-messages', function () {
  return view('center.dashboard.Communication.agent-messages');
})->name('agent-messages');

Route::get('legbox-notification', function () {
  return view('center.dashboard.Communication.legbox-notification');
})->name('legbox-notification');

# Massage viewer Interaction
Route::get('legbox-viewers', [MassageViewerInteractionController::class, 'index'])->name('legbox-viewers');
// Route::get('/my-legbox/{type?}',[MassageViewerInteractionController::class,'dashboard'])->name('user.my-legbox');
Route::get('/my-massage-legbox-ajax', [MassageViewerInteractionController::class, 'dashboardMassageLegboxListAjax'])->name('massage.viewer-legbox-list-ajax');
Route::post('/massage/viewer-interaction-update', [MassageViewerInteractionController::class, 'massageUpdateViewerInteraction'])->name('massage-center.viewer-interaction.update');



Route::get('viewer-notes', function () {
  return view('center.dashboard.Communication.viewer-notes');
})->name('viewer-notes');

Route::get('reccomendations', function () {
  return view('center.dashboard.Reviews.reccomendations');
})->name('center.reccomendations');

/* Route::get('view-reviews',function(){
    return view('center.dashboard.Reviews.view-reviews');
})->name('center.view-reviews'); */
Route::get('view-reviews', [CenterReviewsController::class, 'viewReviews'])->name('center.view-reviews');
Route::get('reviews-by-ajax', [CenterReviewsController::class, 'getCenterProfileReviewsByAjax'])->name('center.reviews-profile-by-ajax');
Route::post('user-review-status-update', [CenterReviewsController::class, "updateUserReviewStatus"])->name('center.user-review-status-update');
Route::get('get-user-review-details/{id}', [CenterReviewsController::class, "getSingleUserReviewDetails"])->name('center.get-single-user-review-details');
Route::get('lookup', function () {
  return view('center.dashboard.UglyMugsRegister.lookup');
})->name('lookup');

Route::get('report', function () {
  return view('center.dashboard.UglyMugsRegister.report');
})->name('center.report');

Route::get('request-notification', function () {
  return view('center.dashboard.UglyMugsRegister.request-notification');
})->name('request-notification');

Route::post('agent-request', [AgentRequestController::class, 'agentRequest'])->name('agent.agent-request');

Route::get('get-notification', [NotificationController::class, 'getNotification'])->name('center.get-notification');
Route::post('notification-seen', [NotificationController::class, 'makeNotificationSeen'])->name('center.notification-seen');

Route::get('editmyaccount', function () {
  return view('center.dashboard.HowisDone.editmyaccount');
})->name('center.editmyaccount');

Route::get('profile-information', function () {
  return view('center.dashboard.HowisDone.profile-information');
})->name('center.profile-information');

Route::get('listings', function () {
  return view('center.dashboard.HowisDone.listings');
})->name('center.listings');

Route::get('profiles-centre', function () {
  return view('center.dashboard.HowisDone.profiles-centre');
})->name('center.profiles-centre');

Route::get('media_centre', function () {
  return view('center.dashboard.HowisDone.media-centre');
})->name('center.media-centre');

Route::get('profiles-masseurs', function () {
  return view('center.dashboard.HowisDone.profiles-masseurs');
})->name('center.profiles-masseurs');

Route::get('media-masseurs', function () {
  return view('center.dashboard.HowisDone.media-masseurs');
})->name('center.media-masseurs');

Route::get('add-report', [CenterNumController::class, 'addReport'])->name('center.add-report');
Route::post('add-report', [CenterNumController::class, 'storeReport'])->name('center.store-report');
Route::get('num-dashboard', [CenterNumController::class, 'showReportOnDashboardAjax'])->name('center.numdashboard');
Route::get('my-reports', [CenterNumController::class, 'showMyReportByAjax'])->name('center.my-reports');
Route::get('edit-my-reports/{id}', [CenterNumController::class, 'editMyReport'])->name('center.edit-my-reports');
Route::post('update-my-reports', [CenterNumController::class, 'updateMyReportByAjax'])->name('center.update-my-reports');

Route::get('num-tips', function () {
  return view('center.numdash.num-tips');
})->name('center.num-tips');


##################  Communication (Legbox Notifications)  #######################
Route::get('legbox-notification/list', [LegboxNotificationController::class, 'index'])->name('centrer.legbox.notification.index');
Route::post('/legbox-notification/store', [LegboxNotificationController::class, 'store'])->name('centrer.legbox.notification.store');
Route::get('/legbox-notification/{id}/show', [LegboxNotificationController::class, 'show'])->name('centrer.legbox.notification.show');
Route::post('/legbox-notification/{id}/status', [LegboxNotificationController::class, 'updateStatus'])->name('centrer.legbox.notification.status');
Route::get('/legbox-notification/pdf-download/{id}', [LegboxNotificationController::class, 'pdfDownload'])->name('centrer.legbox.notification.pdf.download');
Route::get('/legbox-notification/{id}/edit', [LegboxNotificationController::class, 'edit'])->name('centrer.legbox.notification.edit');
Route::post('/legbox-notification/{id}/update', [LegboxNotificationController::class, 'update'])->name('centrer.legbox.notification.update');