<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Admin\Transaction;
use App\Models\V1\Users\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function userWalletBal($userid){
       
        return response()->json(Wallet::where('user_id', $userid)->first());
    }


   public function userInfoByEmail($keyword, $key){
        if($keyword =='email'){
            return response()->json(User::where('email', $key)->first());
        }elseif($key == 'id'){
            return response()->json(User::find($key));
        }  
   }

}
