<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController;


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



Route::prefix('admin')->controller(LoginController::class)->group(function () {

    // Admin login routes
    Route::get('/Adminlogin', 'AdminshowLoginForm')->name('admin.login');
    Route::post('/Adminlogin', 'Adminlogin')->name('admin.login.submit');
    Route::get('/Adminlogout', 'Adminlogout')->name('admin.logout');

    // Protected admin routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/AdminDashboard', 'AdminDashboard')->name('AdminDashboard');
        Route::get('/DiscountData',  'DiscountData')->name('DiscountData');

        Route::get('/rules/{id}',  'DiscountSlot')->name('DiscountSlot');
      //  Route::get('/DiscountSlot', 'DefaultRate')->name('DefaultRate');
    });

});
