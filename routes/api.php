<?php

// use App\Http\Controllers\V1\Admin\TransactionController;
use App\Http\Controllers\V1\Api\ApiController;
use App\Http\Controllers\V1\Api\RequestController;
use App\Http\Controllers\V1\Api\TransactionsController;
use App\Http\Controllers\V1\Api\UsersController;
use Illuminate\Database\Events\TransactionCommitted;
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


Route::get('/userinfo/{keyword}/{key}', [UsersController::class, 'userInfoByEmail']);//doesnt need authentication

Route::get('/user/wallet/{id}', [UsersController::class, 'userWalletBal'])->name('wallet.bal');
Route::get('/transactions/channel/credits/{channelid}', [TransactionsController::class, 'getChannelContribution']);
Route::get('/transactions/channel/debits/{channelid}', [TransactionsController::class, 'getChannelDebits']);

Route::get('/channel/trx/{id}', [TransactionsController::class, 'singleTrx']);

Route::post('/credit/post/{agent_id}', [TransactionsController::class, 'registerCredit']);
Route::post('/update/credit/{cred_id}/{channel_id}', [TransactionsController::class, 'updateCredit']);

Route::post('/debit/reg/{agentid}', [RequestController::class, 'registerDebit'])->middleware(['auth:sanctum']);
Route::post('/debit/update/reg/{requestId}/{agentid}', [RequestController::class, 'updateDebitRequest'])->middleware(['auth:sanctum']);

Route::get('/approve/debit/{requestID}', [RequestController::class, 'approveByAdmin'])->middleware(['auth:sanctum']);






// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
