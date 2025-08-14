<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;

// Admin Auth Routes
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/login', [AuthController::class, 'loginView'])->name('loginView');    
    Route::post('/login', [AuthController::class, 'login'])->name('login'); 
    Route::get('/password/forget', [AuthController::class, 'forgetPasswordView'])->name('password.forget');   
    Route::post('/password/email', [AuthController::class, 'sendResetPasswordEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [AuthController::class, 'resetPasswordView'])->name('password.reset');   
    Route::post('/password/reset/{token}', [AuthController::class, 'resetPassword'])->name('password.update');   
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('admin');
});