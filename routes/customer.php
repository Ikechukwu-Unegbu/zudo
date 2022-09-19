<?php

use App\Http\Controllers\V1\Admin\AdminController;
use App\Http\Controllers\V1\General\SearchController;
use App\Http\Controllers\V1\Public\PagesController;
use App\Http\Controllers\V1\Admin\TransactionController;
use App\Http\Controllers\V1\Agent\CommentController;
use App\Http\Controllers\V1\General\NotificationController;
use App\Http\Controllers\V1\Public\CustomerController;
use App\Models\User;
use App\Models\V1\Admin\Transaction;
use App\Notifications\VonageSMSForContribution;
use App\Services\SMSService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {

    Route::get('/my/profile', [PagesController::class, 'customerProfile'])->name('customer.profile');


    Route::get('/withdrawal', [PagesController::class, 'widthdrawal'])->name('customer.withdraw');
    Route::post('/withdrawal', [TransactionController::class, 'registerWithdraw'])->name('withdraw.register');
    Route::get('/support', [PagesController::class, 'support'])->name('support');
    Route::post('/change/password', [CustomerController::class, 'resetPassword'])->name('p.change');
});

Route::get('/testsms', function(){
    $smsService = new SMSService();
    $smsService->senderSMS("It is working now","2349073569459, 2348064133376", "site doc");
});