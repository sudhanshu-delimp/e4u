<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Escort\EscortController;
use App\Http\Controllers\Escort\Profile\CreateController;
use App\Http\Controllers\Escort\Profile\UpdateController;


Route::get('/', [EscortController::class, 'index'])->name('escort.dashboard');
Route::get('profile/{id}',[UpdateController::class,'updateProfile'])->name('update.profile');
<<<<<<< HEAD
Route::get('create-profile',[CreateController::class,'index'])->name('profile');
Route::post('create-profile',[CreateController::class,'createProfile'])->name('create.profile');
Route::post('profile',[UpdateController::class,'storeAboutMe'])->name('about.me');
Route::post('update-read-more',[UpdateController::class,'storeReadMore'])->name('read.more');
Route::post('update-about',[UpdateController::class,'storeAbout'])->name('about');
=======
Route::get('create-profile',[UpdateController::class,'index'])->name('profile');
Route::post('create-profile',[UpdateController::class,'createProfile'])->name('create.profile');
Route::post('profile',[UpdateController::class,'storeAboutMe'])->name('about.me');
Route::post('update-read-more',[UpdateController::class,'storeReadMore'])->name('read.more');
Route::post('update-about',[UpdateController::class,'storeAbout'])->name('about');
Route::get('country-list',[App\Http\Controllers\CountryController::class,'countryList'])->name('country.list');
Route::get('city-list',[App\Http\Controllers\CityController::class,'cityList'])->name('city.list');
Route::get('state-list',[App\Http\Controllers\StateController::class,'stateList'])->name('state.list');
Route::post('services/{id}',[UpdateController::class,'storeServices'])->name('store.services');
>>>>>>> ecc410224154c7118fc82125dc49be2dda3fff6d

//[EscortController::class, 'index'])->name('escort.dashboard');
 ?>
