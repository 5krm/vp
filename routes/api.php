<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\OTPController;
use App\Http\Controllers\Api\Auth\PasswordResetController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\ServerController;
use App\Http\Controllers\Api\PackagePricingController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\AdvertisementController;
use App\Http\Controllers\Api\AppSettingsController;


// User Auth API
Route::post('device_register', [RegisterController::class, 'registerDevice']);
Route::post('user_registration', [RegisterController::class, 'registerUser']);
Route::post('send-otp', [OTPController::class, 'sendOtp']);
Route::post('verify-otp', [OTPController::class, 'verifyOtp']);
Route::post('password/reset', [PasswordResetController::class, 'resetPassword']);  
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LogoutController::class, 'logout'])->middleware('auth:sanctum');

// Store FCM Token API
Route::post('devices/store-token', [DeviceController::class, 'storeToken']);

Route::middleware(['auth:sanctum'])->group(function() {
    // User API
    Route::get('user', [UserController::class, 'getUserInfo']);
    Route::post('user/update', [UserController::class, 'updateUserDetails']); 
    // Countries API
    Route::get('countries', [CountryController::class, 'getCountries']); 
    // Servers API
    Route::get('servers', [ServerController::class, 'getServers']); 
    // Pricing API
    Route::get('pricings', [PackagePricingController::class, 'getPricingList']);
    Route::post('package-details/save', [PackagePricingController::class, 'savePackageDetails']);

});


// Pages API
Route::get('pages', [PageController::class, 'getPages']);
Route::get('pages/{slug}/content', [PageController::class, 'getPageContentBySlug']);
// Advertisement API
Route::get('advertisement', [AdvertisementController::class, 'getAdvertisementData']);
// Settings API
Route::get('app-settings', [AppSettingsController::class, 'getAppSettingsData']);



















  