<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Admin\Transaction;
use App\Models\V1\Public\Request as PublicRequest;
use App\Notifications\TellAdminAboutWithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TransactionsController extends Controller
{

    public function getChannelContribution($channelId){
        if(request()->input('start_date')==null || request()->input('end_date')==null){
            //handle when user is not admin
            $channel = User::find($channelId);
        
                $transactions = Transaction::where('trx_type', 1)
                    ->where('agent_id', $channelId)->orderBy('id', 'desc')->paginate(50);
                return response()->json($transactions);

            return response()->json($transactions);
        }

        $startDate = Carbon::createFromFormat('Y-m-d', request()->input('start_date'));
        $endDate = Carbon::createFromFormat('Y-m-d', request()->input('end_date'));
        // when user is not admin, get record for that user only
      
        $transactions = Transaction::where('trx_type', 1)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->where('agent_id', $channelId)->orderBy('id', 'desc')->paginate(50);
        return response()->json($transactions);
    }

   
    public function getChannelDebits($channelId){
        if(request()->input('start_date')==null || request()->input('end_date')==null){
            //handle when user is not admin
            $channel = User::find($channelId);
        
                $transactions = Transaction::where('trx_type', 0)
                    ->where('agent_id', $channelId)->orderBy('id', 'desc')->paginate(50);
                return response()->json($transactions);

            return response()->json($transactions);
        }

        $startDate = Carbon::createFromFormat('Y-m-d', request()->input('start_date'));
        $endDate = Carbon::createFromFormat('Y-m-d', request()->input('end_date'));
        // when user is not admin, get record for that user only
      
        $transactions = Transaction::where('trx_type', 0)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->where('agent_id', $channelId)->orderBy('id', 'desc')->paginate(50);
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

    public function updateCredit(Request $request, $channelID, $trxid){
          //find transaction with the id
          $trx = Transaction::find($trxid);
          $channel = User::find($channelID);
          //check if the channel requesting it is the owner or if they have admin access
          if($trx->channel_id == $channel->id || $channel->access == 'admin'){
                //begin the updating 
                $trx->amount =  $request->amount;
                $trx->customer_id = $request->customer;
                $trx->purpose = $request->purpose;
                $trx->save();

              return response()->json($trx);
          }else{
              return response()->json(['message'=>'You dont have access to this record.']);
          }
    }


   
}
