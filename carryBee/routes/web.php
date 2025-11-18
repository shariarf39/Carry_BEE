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
    Route::get('/discounts/export', 'export')->name('discounts.export');
    Route::get('/discounts/{id}',  'DiscountRuleShow')->name('DiscountRuleShow');
    Route::get('/rules/{id}',  'DeRuleShow')->name('DeRuleShow');
   
    Route::get('/default-rate', 'DefaultRate')->name('DefaultRate');

    Route::get('/discounts/{discount}/edit',  'edit')->name('discount.edit');
    Route::put('/discounts/{discount}', 'update')->name('discount.update');
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

        Route::get('/AdminServices', 'AdminServices')->name('AdminServices');
        Route::post('/storeAdmin',  'storeAdmin')->name('storeAdmin');
        Route::delete('/admin/{id}', 'destroyAdmin')->name('destroyAdmin');
        
        Route::get('/User', 'User')->name('User');
        Route::delete('admin/users/{user}','destroyUsers')->name('admin.users.destroy');

        Route::get('/rules/{id}',  'DiscountSlot')->name('DiscountSlot');
         Route::get('AllRules',  'AllRules')->name('AllRules');

        // web.php
        Route::post('/merchant/{id}/approve', 'approve')->name('merchant.approve');
        Route::post('/merchant/{id}/reject', 'reject')->name('merchant.reject');
        Route::post('/merchant/{id}/ban', 'ban')->name('merchant.ban');
        
        // Manage KAM, Hub, Categories
        Route::get('/ManageData', 'ManageData')->name('ManageData');
        Route::post('/storeKam', 'storeKam')->name('storeKam');
        Route::delete('/kam/{id}', 'destroyKam')->name('destroyKam');
        Route::post('/storeHub', 'storeHub')->name('storeHub');
        Route::delete('/hub/{id}', 'destroyHub')->name('destroyHub');
        Route::post('/storeCategory', 'storeCategory')->name('storeCategory');
        Route::delete('/category/{id}', 'destroyCategory')->name('destroyCategory');
     
      //  Route::get('/DiscountSlot', 'DefaultRate')->name('DefaultRate');
    });

});
