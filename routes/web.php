<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ServerController;
use App\Http\Controllers\Admin\PackagePricingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\EmailSettingController;
use App\Http\Controllers\Admin\Settings\NotificationController as NotificationSettingsController;
use App\Http\Controllers\Admin\Settings\AdvertisementController as AdvertisementSettingsController;
use App\Http\Controllers\Admin\Settings\AppSettingController;

Route::redirect('/', 'admin/login');

Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function() {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    
    // Admin Routes
    Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/admins/add', [AdminController::class, 'add'])->name('admins.add');
    Route::post('/admins/add', [AdminController::class, 'insert'])->name('admins.insert');
    Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admins.edit');
    Route::post('/admins/edit', [AdminController::class, 'update'])->name('admins.update');
    Route::delete('/admins/{id}', [AdminController::class, 'delete'])->name('admins.delete');

    // Roles & Permission Routes
    Route::get('/roles', [RolePermissionController::class, 'index'])->name('roles.index');
    Route::get('/roles/add', [RolePermissionController::class, 'add'])->name('roles.add');
    Route::post('/roles/add', [RolePermissionController::class, 'insert'])->name('roles.insert');
    Route::get('/roles/{id}/edit', [RolePermissionController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/edit', [RolePermissionController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RolePermissionController::class, 'delete'])->name('roles.delete');

    // Country Routes
    Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
    Route::post('/countries/add', [CountryController::class, 'add'])->name('countries.add');
    Route::get('/countries/{id}', [CountryController::class, 'getCountryById']);
    Route::post('/countries/edit', [CountryController::class, 'update'])->name('countries.update');
    Route::delete('/countries/{id}', [CountryController::class, 'delete'])->name('countries.delete');
    
    // Server Routes
    Route::get('/servers', [ServerController::class, 'index'])->name('servers.index');
    Route::get('/servers/add', [ServerController::class, 'add'])->name('servers.add');
    Route::post('/servers/add', [ServerController::class, 'insert'])->name('servers.insert');
    Route::get('/servers/{id}/edit', [ServerController::class, 'edit'])->name('servers.edit');
    Route::post('/servers/edit', [ServerController::class, 'update'])->name('servers.update');
    Route::delete('/servers/{id}', [ServerController::class, 'delete'])->name('servers.delete');

    // Package Pricing Routes
    Route::get('/pricings', [PackagePricingController::class, 'index'])->name('pricings.index');
    Route::get('/pricings/add', [PackagePricingController::class, 'add'])->name('pricings.add');
    Route::post('/pricings/add', [PackagePricingController::class, 'insert'])->name('pricings.insert');
    Route::get('/pricings/{id}/edit', [PackagePricingController::class, 'edit'])->name('pricings.edit');
    Route::post('/pricings/edit', [PackagePricingController::class, 'update'])->name('pricings.update');
    Route::delete('/pricings/{id}', [PackagePricingController::class, 'delete'])->name('pricings.delete');

    // User Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'getUserById']);
    Route::post('/users/edit', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete');

    // Notification Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/send', [NotificationController::class, 'sendNotification'])->name('notifications.send');

    // Page Routes
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/add', [PageController::class, 'add'])->name('pages.add');
    Route::post('/pages/add', [PageController::class, 'insert'])->name('pages.insert');
    Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::post('/pages/edit', [PageController::class, 'update'])->name('pages.update');
    Route::delete('/pages/{id}', [PageController::class, 'delete'])->name('pages.delete');

    // Email Settings Routes
    Route::get('/email/configuration', [EmailSettingController::class, 'editEmailConfiguration'])->name('email.configuration'); 
    Route::post('/email/configuration/edit', [EmailSettingController::class, 'updateEmailConfiguration'])->name('email.configuration.update'); 
    Route::get('/email/templates', [EmailSettingController::class, 'index'])->name('email.templates.index');
    Route::get('/email/templates/{id}/edit', [EmailSettingController::class, 'edit'])->name('email.templates.edit'); 
    Route::post('/email/templates/edit', [EmailSettingController::class, 'update'])->name('email.templates.update'); 
    Route::get('/email/global-template', [EmailSettingController::class, 'editEmailGlobalTemplate'])->name('email.global-template'); 
    Route::post('/email/global-template/edit', [EmailSettingController::class, 'updateEmailGlobalTemplate'])->name('email.global-template.update'); 

    // Settings Routes
    Route::controller(NotificationSettingsController::class)->group(function () {
        Route::get('/settings/notification', 'notificationSettingsView')->name('settings.notification');
        Route::post('/settings/upload/firebase-credentials', 'uploadFirebaseCredentials')->name('settings.upload.firebase.credentials');
    });
    Route::controller(AdvertisementSettingsController::class)->group(function () {
        Route::get('/settings/advertisement', 'advertisementSettingsView')->name('settings.advertisement');
        Route::post('/settings/advertisement/edit', 'updateAdvertisement')->name('settings.advertisement.update');
    });
    Route::get('/settings/app', [AppSettingController::class, 'appSettings'])->name('settings.app'); 
    Route::post('/settings/app', [AppSettingController::class, 'updateAppSettings'])->name('settings.app.update'); 

});


