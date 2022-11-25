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

   public function usersByChannel($viewer_id){
        $viewer = User::find($viewer_id);
        if($viewer->access == 'channel'){
            $users = User::where('channel_id', $viewer->id)->orderBy('id', 'desc')->paginate(20);
            return response()->json($users);
        }elseif($viewer->access == 'admin'){
            $users = User::orderBy('id', 'desc')->paginate(20);
            return response()->json($users);
        }
   }


   public function searchUser(Request $request, $viewer_id){

        if($request->keyword !== null){
            $result = User::where('name','LIKE','%'.$request->keyword.'%')
                ->orWhere('fullname','LIKE','%'.$request->keyword.'%')
                ->get();
            return response()->json($result); 
        } 
        else{
            if($request->keyid != null){
                $result = User::where('id', (int)$request->keyid)->get();
                return response()->json($result); 
            }
        }
   }


}
