<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Admin\Transaction;
use App\Models\V1\Public\Request as PublicRequest;
use App\Models\V1\Users\Wallet;
use App\Notifications\TellAdminAboutWithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class TransactionsController extends Controller
{

    public function getChannelContribution($channelId){
        if(request()->input('start_date')==null || request()->input('end_date')==null){
            //handle when user is not admin
            $channel = User::find($channelId);
        
                $transactions = Transaction::where('trx_type', 1)
                    ->where('agent_id', $channelId)->orderBy('id', 'desc')->paginate(50);
                    foreach($transactions as $transaction){
                        $transaction->customer_name = $transaction->customer->name;
                    }
                return response()->json($transactions);

            return response()->json($transactions);
        }

        $startDate = Carbon::createFromFormat('Y-m-d', request()->input('start_date'));
        $endDate = Carbon::createFromFormat('Y-m-d', request()->input('end_date'));
        // when user is not admin, get record for that user only
      
        $transactions = Transaction::where('trx_type', 1)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->where('agent_id', $channelId)->orderBy('id', 'desc')->paginate(50);
        foreach($transactions as $transaction){
            $transaction->customer_name = $transaction->customer->name;
        }
        return response()->json($transactions);
    }

   
    public function getChannelDebits($channelId){
        if(request()->input('start_date')==null || request()->input('end_date')==null){
            //handle when user is not admin
            $channel = User::find($channelId);
        
                $transactions = Transaction::where('trx_type', 0)
                    ->where('agent_id', $channelId)->orderBy('id', 'desc')->paginate(50);
                // return response()->json($transactions);
                foreach($transactions as $transaction){
                    $transaction->customer_name = $transaction->customer->name;
                }

            return response()->json($transactions);
        }

        $startDate = Carbon::createFromFormat('Y-m-d', request()->input('start_date'));
        $endDate = Carbon::createFromFormat('Y-m-d', request()->input('end_date'));
        // when user is not admin, get record for that user only
      
        $transactions = Transaction::where('trx_type', 0)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->where('agent_id', $channelId)->orderBy('id', 'desc')->paginate(50);
        foreach($transactions as $transaction){
            $transaction->customer_name = $transaction->customer->name;
        }
        return response()->json($transactions);
    }

    public function singleCredit($channelID, $trxid){
        //find transaction with the id
        $trx = Transaction::find($trxid);
        $channel = User::find($channelID);
        //check if the channel requesting it is the owner or if they have admin access
        if($trx->channel_id == $channel->id || $channel->access == 'admin'){
            return response()->json($trx);
        }else{
            return response()->json(['message'=>'You dont have access to this record.']);
        }

    }


    public function registerCredit(Request $request, $channel_id){
        // var_dump($channel_id);die;
        $validator = Validator::make($request->all(), [
            "amount"=>"required|string",
            "customer"=>'required|string'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 401);
        }
        return DB::transaction(function()use($request, $channel_id){
            $agent = User::find($channel_id);
            // var_dump($agent);die;
            $customer = User::findOrFail($request->customer);
            $trx = new Transaction();
            $trx->amount =$request->input('amount');
            $trx->customer_id = $customer->id;
            $trx->agent_id = $agent->id;
            $trx->purpose = $request->input('purpose', 'Contribution');
            $trx->trx_type = 1;
            $trx->save();

            //add to user wallet
            $wallet = Wallet::where('user_id', $customer->id)->first();
            $wallet->balance = (float)$wallet->balance + (float)$request->amount;
            $wallet->save();
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Transaction recorded.',
                    'data'=>$trx 
                ], 200
            );
        });      
    }

    public function updateCredit(Request $request, $trxid,$channelID){
        $validator = Validator::make($request->all(), [
            "amount"=>"required|string",
            "customer"=>"required|string"
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 401);
        }
          //find transaction with the id
          $trx = Transaction::find($trxid);
          $channel = User::find($channelID);
          //check if the channel requesting it is the owner or if they have admin access
          if($trx->agent_id == $channel->id || $channel->access == 'admin'){
                //update wallet
                $wallet = Wallet::where('user_id', $trx->customer_id)->first();
                $wallet->balance = ((float)$wallet->balance - (float)$trx->amount) + (float)$request->amount;
                $wallet->save();
            
                //begin the updating 
                $trx->amount =  $request->amount;
                $trx->customer_id = $request->customer;
                $trx->purpose = $request->input('purpose', 'purpose');
                $trx->save();

              return response()->json([
                "status"=>true,
                "credit"=>$trx,
                "message"=>"updated",
                "wallet"=>$wallet
              ]);

          }else{
            return response()->json([
                'status' => false,
                'message' => 'You dont have right to update this.',
                // 'errors' => $validator->errors()
            ], false);
          }
    }


   
}
