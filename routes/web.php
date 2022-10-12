<?php

use App\Http\Controllers\V1\General\NotificationController;
use App\Http\Controllers\V1\Public\PagesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[PagesController::class, 'home'])->name('home');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/services', [PagesController::class, 'services'])->name('services');
Route::get('/faq',[PagesController::class, 'faq'] )->name('faq');

Route::get('/user/{userid}/notification', [NotificationController::class, 'userNotification'])->name('user.nofitication')->middleware(['auth']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/customer.php';
