<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Admin\Transaction;
use App\Models\V1\Public\Request as PublicRequest;
use App\Models\V1\Users\Wallet;
use App\Notifications\TellAdminAboutWithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    public function registerDebit(Request $request, $agent){
        //validation 
        // var_dump($request->all());die;
        $validator = Validator::make($request->all(), [
            'amount'=>'required|string', 
            'customer'=>'required|string',
            'method'=>'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 401);
        }
        
        $requetModel = new PublicRequest();
        $requetModel->amount = $request->amount;
        $requetModel->type = $request->method;
        $requetModel->customer_id = $request->customer;
        $requetModel->approved = 0;
        $requetModel->staff_id = $agent;
        $requetModel->save();
        //notify admin of this reqest
        $admin = User::where('access','!=', 'users')->get();
        Notification::sendNow($admin, new TellAdminAboutWithdrawalRequest($requetModel,  User::find($request->customer)));

        
        return response()->json([
            'status' => true,
            'message' => 'Transaction recorded.',
            'data' => $requetModel
        ], 200);
        
    }


 

    public function updateDebitRequest(Request $request, $requestID, $agent){
        $validator = Validator::make($request->all(), [
            'amount'=>'required|string', 
            'customer'=>'required|string',
            'method'=>'required|string'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 401);
        }
        $requestModel = PublicRequest::where('id',$requestID)->where('staff_id', $agent)->first();
        $requestModel->amount = $request->amount;
        $requestModel->type = $request->method;
        $requestModel->customer_id = $request->customer;
        $requestModel->approved = 0;
        $requestModel->staff_id = $agent;
        $requestModel->save();
        return response()->json([
            'status' => true,
            'message' => 'update',
            'data' =>$requestModel
        ], 200);

    }


    public function approveByAdmin($requestId, $adminId){
        return DB::transaction(function() use($requestId, $adminId) {
                $admin = User::find($adminId);
                if($admin->access != 'admin'){
                   
                        return response()->json([
                            'status' => false,
                            'message' => 'You dont have access to do this.',
                            // 'errors' => $validator->errors()
                        ], 401);
                   
                }
                $request = PublicRequest::findOrFail($requestId);
                $trx = new Transaction();
                $agentId = 0;
                $purpose = "debit - processed from request. Approved by admin";
                if($request->staff_id != null) $agentId = $request->staff_id;
                if($request->description != null) $purpose = $request->description;
                $trx->customer_id = $request->customer_id;
                $trx->agent_id = $adminId;
                $trx->trx_type = 0;
                $trx->purpose = $purpose;
                $trx->amount = $request->amount;
                $trx->approved = 1;
                $trx->withdraw_type = $request->type;
                $trx->save();

                $request->approved = 1;
                $request->save();

                  //deduct from user wallet
                $wallet = Wallet::where('user_id', $request->customer_id)->first();
                $wallet->balance = (float)$wallet->balance - (float)$request->amount;
                $wallet->save();

                return response()->json(
                    [
                        'debit'=>$trx,
                        'wallet'=>$wallet
                    ]
                );
        });
    }

    public function getRequests(){
        if(request()->input('channel_id') == null){
            $reqs = PublicRequest::orderBy('id', 'desc')->paginate(20);
            return response()->json($reqs);     
        }
        $reqs = PublicRequest::orderBy('id', 'desc')->where('staff_id', request()->input('channel_id'))->paginate(20);
        return response()->json($reqs);
       
    }


}
