<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::controller(AuthController::class)->group(function(){

    Route::get('/register',  'showRegistrationForm')->name('register');
    Route::post('/register', 'register')->name('register.submit');


    // Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.submit');
});

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});

});



Route::controller(HomeController::class)->group(function(){

Route::get('/', 'Home')->name('Home');
// Protected Routes
Route::middleware('auth')->group(function () {
  
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/storeDiscount', 'storeDiscount')->name('storeDiscount');
    Route::get('/discounts', 'DiscountShow')->name('discounts');
    Route::get('/discounts/{id}',  'DiscountRuleShow')->name('DiscountRuleShow');
    Route::get('/rules/{id}',  'DeRuleShow')->name('DeRuleShow');
    Route::get('/default-rate', 'DefaultRate')->name('DefaultRate');
});

});



// Route::controller(DownloadController::class)->group(function(){
//   Route::get('/download-apk', 'downloadApk');
//   Route::get('/download-count', 'getDownloadCount');
//   Route::get('/NUBCC-Magazine-pdf', 'showPdf')->name('pdf.viewer');
//   Route::get('/excurtion_apk', 'excurtion_apk');

// });