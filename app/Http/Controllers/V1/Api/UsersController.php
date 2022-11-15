<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Models\V1\Users\Wallet;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function userWalletBal($userid){
        return response()->json(Wallet::where('user_id', $userid)->first());
    }
}
