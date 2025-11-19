<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shareholder\ShareholderController;

Route::get('/', [ShareholderController::class, 'index'])->name('shareholder.index');
// my account
Route::get('/edit-my-account', [ShareholderController::class, 'editMyaccount'])->name('shareholder.edit-my-account');
Route::get('/change-password', [ShareholderController::class, 'changePassword'])->name('shareholder.change-password');
Route::get('/upload-my-avatar', [ShareholderController::class, 'uploadAvatar'])->name('shareholder.upload-my-avatar');
Route::get('/notifications', [ShareholderController::class, 'notifications'])->name('shareholder.notifications');

// Blackbox tech pvt. ltd.
Route::get('/annual-report', [ShareholderController::class, 'annualReport'])->name('shareholder.annualreport');
Route::get('/directors', [ShareholderController::class, 'directors'])->name('shareholder.directors');
Route::get('/portfolio', [ShareholderController::class, 'portfolio'])->name('shareholder.portfolio');
Route::get('/contact-us', [ShareholderController::class, 'contactUs'])->name('shareholder.contact-us');

// Shareholders
Route::get('/shareholder-notices', [ShareholderController::class, 'shareholderNotices'])->name('shareholder.shareholder-notices');
Route::get('/newsletter', [ShareholderController::class, 'newsletter'])->name('shareholder.newsletter');

// registrations
Route::get('/registrations', [ShareholderController::class, 'registrations'])->name('shareholder.registrations');
Route::get('/revenue', [ShareholderController::class, 'revenue'])->name('shareholder.revenue');


// Global Monitoring
Route::get('/escort-listings', [ShareholderController::class, 'escortListing'])->name('shareholder.escort-listings');
Route::get('/massage-centre-listings', [ShareholderController::class, 'massageListing'])->name('shareholder.massage-centre-listings');
Route::get('/pin-up-listing', [ShareholderController::class, 'pinUplisting'])->name('shareholder.pin-up-listing');

// Shareholder Documents
Route::get('/annual-profit-&-loss', [ShareholderController::class, 'annualProfitloss'])->name('shareholder.annual-profit-&-loss');
Route::get('/balance-sheet', [ShareholderController::class, 'balanceSheet'])->name('shareholder.balance-sheet');
Route::get('/constitution', [ShareholderController::class, 'constitution'])->name('shareholder.constitution');
Route::get('/shareholder-minutes', [ShareholderController::class, 'shareholderMinutes'])->name('shareholder.shareholder-minutes');
Route::get('/shareholder-updates', [ShareholderController::class, 'shareholderUpdates'])->name('shareholder.shareholder-updates');

// Share Register
Route::get('/overview', [ShareholderController::class, 'overview'])->name('shareholder.overview');
Route::get('/shareholders', [ShareholderController::class, 'shareholders'])->name('shareholder.shareholders');
Route::get('/share-value', [ShareholderController::class, 'shareValue'])->name('shareholder.share-value');

// Subsidiaries
Route::get('/overview-&-portfolio', [ShareholderController::class, 'overviewPortfolio'])->name('shareholder.overview-&-portfolio');
Route::get('/annual-profit-&-loss', [ShareholderController::class, 'subAnnualProfitloss'])->name('shareholder.annual-profit-&-loss');
Route::get('/balance-sheet', [ShareholderController::class, 'subBalancesheet'])->name('shareholder.balance-sheet');


// Subsidiaries
Route::get('/submit', [ShareholderController::class, 'submit'])->name('shareholder.submit');
Route::get('/view-&-reply', [ShareholderController::class, 'viewReply'])->name('shareholder.view-&-reply');


