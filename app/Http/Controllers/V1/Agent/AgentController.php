<?php

namespace App\Http\Controllers\V1\Agent;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Admin\Transaction;
use App\Models\V1\Public\Request as PublicRequest;
use App\Notifications\TellAdminAboutWithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class AgentController extends Controller
{
    public function initiateWithdraw(Request $request){
        $request->validate([
            'customer'=>'required',
            'amount'=>'required|string',
            'method'=>'required|string'
        ]);
        $quest = new PublicRequest();
        $quest->amount = $request->amount;
        $quest->type = $request->type;
        $quest->approved = 0;
        $quest->customer_id = $request->customer;
        $quest->description = $request->description;
        $quest->staff_id = Auth::user()->id;
        $quest->save();
         //send notifications
         $admin = User::where('access','!=', 'users')->get();
         $user = User::find($request->customer);
         Notification::sendNow($admin, new TellAdminAboutWithdrawalRequest($quest, $user));

        
        //send message 
        Session::flash('success', 'Withdrawal request posted for admin.');
        return redirect()->back();
    }

    public function getUser($id){
        $user = User::find($id);
        return response()->json($user);
    }


    public function allTransactionByAgent(Request $request,$agentId, $customerId=null){
        //print(request()->input('userid'));die;
       
        if(request()->input('userid') !=null && request()->input('start_date') != null && request()->input('end_date')){
            $startDate = Carbon::createFromFormat('Y-m-d', request()->input('start_date'))->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', request()->input('end_date'))->endOfDay();
            $transaction = Transaction::where('agent_id', $agentId)
            ->where('customer_id', request()->input('userid'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->paginate(20);
            $agent = User::find($agentId);
            return view('admin.transaction.agent_trx')->with('transactions', $transaction)
                                                        ->with('agent', $agent);
        }
        
        $transaction = Transaction::where('agent_id', $agentId)->paginate(20);
        $agent = User::find($agentId);
        return view('admin.transaction.agent_trx')->with('transactions', $transaction)
        ->with('agent', $agent);
    }

}
