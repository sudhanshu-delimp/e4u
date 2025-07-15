<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Escort\TourController;
use App\Http\Controllers\Agent\EscortController;
use App\Http\Controllers\Escort\ArchivesController;
use App\Http\Controllers\Agent\AgentAccountController;
use App\Http\Controllers\Agent\AgentRequestController;
use App\Http\Controllers\Escort\EscortGalleryController;
use App\Http\Controllers\Escort\Profile\CreateController;
use App\Http\Controllers\Escort\Profile\UpdateController;
use App\Http\Controllers\Agent\AgentTourPaymentController;

use App\Http\Controllers\Escort\EscortPolyPaymentController;
use App\Http\Controllers\MyAdvertiser\ListAdvertiserController;
use App\Http\Controllers\MyAdvertiser\PricingsummariesController;
use App\Http\Controllers\Escort\EscortController as DataTableController;

    Route::get('/', [AgentController::class, 'index'])->name('agent.dashboard');
    Route::get('/user-escorts-list', [AgentController::class, 'userEscortList'])->name('agent.manage.escorts.list');


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
    Route::post('/change-password', [AgentAccountController::class, 'updatePassword'])->name('agent.update.password');
    Route::post('/change-password-expiry', [AgentAccountController::class, 'updatePasswordExpiry'])->name('agent.update.password.expiry');

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

     

     

    Route::get('advertiser-profiles',function(){
    return view('agent.dashboard.Annalytics.advertiser-profiles');
})->name('agent.advertiser-profiles');

    Route::get('advertiser-social-media',function(){
    return view('agent.dashboard.Annalytics.advertiser-social-media');
})->name('agent.advertiser-social-media');

    Route::get('prospets-memberships',function(){
    return view('agent.dashboard.Annalytics.prospets-memberships');
})->name('agent.prospets-memberships');

 

Route::get('Advertisers/history-requests',function(){
    return view('agent.dashboard.Advertisers.history-requests');
})->name('agent.history-requests');

    Route::get('Marketing/create-prospect',function(){
    return view('agent.dashboard.Marketing.create-prospect');
})->name('marketing.agencreate-prospect');

    Route::get('Marketing/create-information-package',function(){
    return view('agent.dashboard.Marketing.create-information-package');
})->name('marketing.create-information-package');

    Route::get('Commision/statements',function(){
    return view('agent.dashboard.Commision.statements');
})->name('Commision.statements');

    Route::get('Commision/summary',function(){
    return view('agent.dashboard.Commision.summary');
})->name('Commision.summary');

Route::get('pricingsummaries',[PricingsummariesController::class ,'showPricingsummary'])->name('pricingsummaries');
Route::get('pricingsummaries-datatable',[PricingsummariesController::class ,'PricingDataTable'])->name('agent.myPricing.dataTable');
Route::post('update-pricing-detail',[PricingsummariesController::class ,'storePricingDetail'])->name('agent.save.pricing.details');

// function(){name('pricingsummaries');
// return view('agent.dashboard.pricingsummaries');
// })->name('pricingsummaries');

Route::get('bank_account',[AgentAccountController::class,'bankDetails'])->name('bank_account');
Route::post('save-bank-details',[AgentAccountController::class,'saveBankDetails'])->name('agent.save.bank.details');
Route::post('check-bank-otp',[AgentAccountController::class,'checkOTP'])->name('agent.checkOTP');
Route::post('delete-agent-bank/{id}',[AgentAccountController::class,'deleteAgentBank']);
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
