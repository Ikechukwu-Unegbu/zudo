<?php

use App\Http\Controllers\V1\Api\ApiController;
use App\Http\Controllers\V1\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('admin/register', [ApiController::class, 'AdminRegistration']);
Route::post('channel/register', [ApiController::class, 'ChannelRegistration']);
Route::post('admin/login', [ApiController::class, 'AdminLogin']);
Route::post('channel/login', [ApiController::class, 'ChannelLogin']);
Route::post('logout', [ApiController::class, 'logout'])->middleware('auth:sanctum');

Route::post('forgot-password', [ApiController::class, 'forgotPassword']);
Route::post('reset-password', [ApiController::class, 'resetPassword']);

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth:sanctum'],
], function() {
    Route::get('/channels', [ApiController::class, 'channels']);
    Route::post('/channel/create', [ApiController::class, 'AdminToCreateChannel']);

});


Route::group([
    'prefix' => 'channel',
    'middleware' => ['auth:sanctum'],
], function() {
    Route::get('/user/assign', [ApiController::class, 'AssignedUser']);
    Route::get('/deposit', [ApiController::class, 'contribution']);
    Route::post('/deposit/create', [ApiController::class, 'createContribution']);

});

Route::get('/user/wallet/{id}', [UsersController::class, 'userWalletBal'])->name('wallet.bal');


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
