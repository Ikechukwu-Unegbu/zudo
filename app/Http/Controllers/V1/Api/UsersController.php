<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Admin\Transaction;
use App\Models\V1\Users\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function userWalletBal($userid){
       
        return response()->json(Wallet::where('user_id', $userid)->first());
    }

    public function channelCreateUser(Request $request, $channel_id){
        if ($request->wantsJson())
        {
            $validator = Validator::make($request->all(), [
                'name'  =>  'required|string',
                'username'  =>  'required|string|unique:users,name',
                'phone'=>'required|string|unique:users',
                // 'email'     =>  'r',
                'password'  =>  'required|string|min:6',
                'password_confirmation'  =>  'required|same:password'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors()
                ], 401);
            }

            $user = User::create([
                'name'  =>  $request->username,
                'fullname'  =>  $request->name,
                'gender'=>$request->gender,
                'email'     =>  $request->email,
                'channel_id'=>$channel_id,
                'password'  =>  bcrypt($request->password),
                'access'    =>  'user',
            ]);
            //add wallet 
            $wallet = new Wallet();
            $wallet->balance = 0;
            $wallet->user_id = $user->id;
            $wallet->save();

            $token = $user->createToken('API TOKEN')->plainTextToken;

            return response()->json([
                'status'=>true,
                'message' => 'User Created Successfully',
                'user'  =>  $user,
                'token' => $token
            ]);
        }
        else
        {
            return null;
        }
    }

   public function userInfoByEmail($keyword, $key){
        if($keyword =='email'){
            $user = User::where('email', $key)->first();
            $wallet = Wallet::where('user_id', $user->id)->first();
            $user->wallet = $wallet;
            return response()->json($user);
        }elseif($keyword == 'id'){
            $user = User::findOrFail($key);
            $wallet = Wallet::where('user_id', $user->id)->first();
            $user->wallet = $wallet;
            return response()->json($user);
        }  
   }

   public function usersByChannel($viewer_id){
        $viewer = User::find($viewer_id);
        if($viewer->access == 'channel'){
            $users = User::where('channel_id', $viewer->id)->orderBy('id', 'desc')->get();
            foreach($users as $user){
                $user->wallet = Wallet::where('user_id', $user->id)->first();
            }
            return response()->json($users);
        }elseif($viewer->access == 'admin'){
            $users = User::orderBy('id', 'desc')->get();
            foreach($users as $user){
                $user->wallet = Wallet::where('user_id', $user->id)->first();
            }
            return response()->json($users);
        }
   }


   public function searchUser(Request $request, $viewer_id){

        if($request->keyword !== null){
            $result = User::where('name','LIKE','%'.$request->keyword.'%')
                ->orWhere('fullname','LIKE','%'.$request->keyword.'%')
                ->get();
            if($result){
                foreach($result as $res){
                    $res->wallet = Wallet::where('user_id', $res->id)->first();
                }
            }
            return response()->json($result); 
        } 
        else{
            if($request->keyid != null){
                $result = User::where('id', (int)$request->keyid)->first();
                
                $result->wallet = Wallet::where('user_id', $result->id)->first();
              
                return response()->json([$result]); 
            }
        }
   }


}
