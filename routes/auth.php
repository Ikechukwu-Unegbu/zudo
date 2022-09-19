<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //             ->name('register');

    // Route::post('register', [RegisteredUserController::class, 'store']);

    // Route::get('login', [AuthenticatedSessionController::class, 'create'])
    //             ->name('login');

    // Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    //             ->name('password.request');

    // Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    //             ->name('password.email');

    // Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    //             ->name('password.reset');

    // Route::post('reset-password', [NewPasswordController::class, 'store'])
    //             ->name('password.update');


    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'storeSession'])->name('login');
    Route::get('register', [AuthController::class, 'registerIndex'])->name('register.index');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::get('channel/login', [AuthController::class, 'channelLoginIndex'])->name('channel.login.index');
    Route::post('channel/login', [AuthController::class, 'channelLogin'])->name('channels.login');
    Route::get('channel/register', [AuthController::class, 'channelRegisterIndex'])->name('channel.register.index');
    Route::post('channel/register/store', [AuthController::class, 'channelRegister'])->name('channel.register.store');


    Route::get('admin/register', [AuthController::class, 'adminRegisterIndex'])->name('admin.register.index');
    Route::get('admin/login', [AuthController::class, 'AdminLoginIndex'])->name('administrator.index');
    Route::get('forgot-password', [AuthController::class, 'forgtPasswordIndex'])->name('password.request');
    Route::post('admin/register/store', [AuthController::class, 'adminRegister'])->name('admin.register.store');
    Route::post('admin/login', [AuthController::class, 'AdminLogin'])->name('administrator.login');


    // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                // ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    //             ->name('logout');
});
