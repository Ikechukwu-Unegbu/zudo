<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Admin\Transaction;
use App\Models\V1\Kin;
use App\Models\V1\Public\Request as PublicRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\V1\Public\Request as ModelRequest;
use App\Models\V1\Users\Bankaccount;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function home(){
        if(Auth::user()->access =='user')
        {
            //var_dump(Auth::user()->id);die;
            $contributions = Transaction::where('customer_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(14);
            $withdrawal = PublicRequest::where('customer_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            $total = Transaction::where('customer_id', Auth::user()->id)->sum('amount');
            $totalWithdraw = PublicRequest::where('customer_id', Auth::user()->id)->sum('amount');
            $bankinfo = Bankaccount::where('user_id', Auth::user()->id)->get();
            return view('customer.home.index')
                                                ->with('bankacc', $bankinfo)
                                                ->with('cons', $contributions)
                                                ->with('withdraws', $withdrawal)
                                                ->with('total', $total)
                                                ->with('totalwithdraw', $totalWithdraw);
        }
        else
        {
            /* This section is responsible for Charts */
            $months = [];
            for ($m=1; $m<=12; $m++) {
                $months[] = date('m', mktime(0,0,0,$m, 1, date('Y')));

            }
            $MonthlyRegisteredUsers = [];
            $strMonth = [];
            $monthlyContribution = [];
            $monthlyWithdrawal = [];
            foreach ($months as $month) {
                $MonthlyRegisteredUsers[] = User::whereRaw('MONTH(created_at) = ?', $month)->count();
                $monthlyContribution[] = Transaction::where('trx_type', true)->whereRaw('MONTH(created_at) = ?', $month)->count();
                $monthlyWithdrawal[] = Transaction::where('trx_type', false)->whereRaw('MONTH(created_at) = ?', $month)->count();
                $strMonth[] = date('M', mktime(0,0,0,$month, 1, date('Y')));
            }

            $totalAgent = [];
            $agentName = [];
            foreach (User::whereAccess('channel')->get() as $channel)
            {
                $totalAgent[] = Transaction::whereAgentId($channel->id)->sum('amount');
                $agentName[] = $channel->name;
            }
            /*  */
            return view('admin.home.index', [
                'users' => User::whereAccess('user')->count(),
                'channels' => User::whereAccess('channel')->count(),
                'transations'   =>  Transaction::whereTrxType(true)->sum('amount'),
                'withdraws'     =>  Transaction::whereTrxType(false)->sum('amount'),
                'monthlyRegisteredUsers' => $MonthlyRegisteredUsers,
                'months'    =>  $strMonth,
                'trxContData' => $monthlyContribution,
                'trxWithData' => $monthlyWithdrawal,
                'agentsMoneyCollectionData' => $totalAgent,
                'agentsMoneyCollection' => $agentName,
            ]);
        }

    }

    public function requests(){
        $requests = ModelRequest::paginate(20);
        return view('admin.requests.index')->with('requests', $requests);
    }

    public function agents(){
        $agents = User::where('access', 'agent')->orderBy('id', 'desc')->get();
        return view('admin.agents.index')->with('agents', $agents);
    }

    public function customers(){
        $customers = User::orderBy('id', 'desc')->paginate(20);
        $channels = User::whereAccess('channel')->get();

        return view('admin.customers.customers', compact('channels'))->with('customers', $customers);
    }

    public function userCreate(Request $request){
        $request->validate([
            'username'=>'required|string',
            'fullname'=>'required|string',
            'phone'=>'required|string',
            'email'=>'required|string',
            'password'=>'required|string',
            'user_type'=>'required|string'

        ]);
        DB::transaction(function() use($request){
            //first create user
            $user = new User();
            $user->fullname = $request->fullname;
            $user->name = $request->username;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->access = $request->user_type;
            $user->channel_id = $request->channel;
            $user->save();
            // $newUser = User::find()
            //create account records
            $account = new Bankaccount();
            $account->bank_name = $request->bank_name;
            $account->bank_account = $request->bank_account;
            $account->user_id = $user->id;
            $account->save();

            //create a kin record
            $kin = new Kin();
            $kin->fullname = $request->kin_fullname;
            $kin->email = $request->kin_email;
            $kin->phone = $request->kin_phone;
            $kin->user_id = $user->id;
            $kin->save();

            //image upload - starting with profile image
            if($request->hasFile('kin_image')) {
                $uploadInstance = new FileUploadService();
                $uploadInstance->upload($request, 'kin', $kin->id);
            }

            //image upload -- next of kin document
            if($request->hasFile('user_dp')) {
                $uploadInstance = new FileUploadService();
                $uploadInstance->upload($request, 'user', $user->id);
            }
        });


        Session::flash('success', 'New user(agent) succcessfully created.');
        return redirect()->back();
    }

    public function deactivateAgent($agentId){
        $agent = User::find($agentId);
        $agent->delete();
        Session::flash('success', 'Agent '.$agent->name.' has been deactivated.');
        return redirect()->back();
    }

    public function showUser($userid){
        $user = User::find($userid);
        $bankinfo = Bankaccount::where('user_id', $userid)->get();
        $kins = Kin::where('user_id', $userid)->get();

        return view('admin.user.show')->with('user', $user)->with('bankacc', $bankinfo)
                                        ->with('kins', $kins);
    }

    public function chartPage(){
        return view('admin.chart.chart');
    }


    public function requestResolve($id){
        $request = Transaction::findOrFail($id);
        $request->approved=1;
        $request->save();


        Session::flash('success', 'Resolved');
        return redirect()->back();
    }

    public function popOut($target){

        DB::transaction(function() use($target) {
            $request = ModelRequest::findOrFail($target);
            $trx = new Transaction();
            $agentId = 0;
            $purpose = "debit - processed from request. Approved by admin";
            if($request->staff_id != null) $agentId = $request->staff_id;
            if($request->description != null) $purpose = $request->description;
            $trx->customer_id = $request->customer_id;
            $trx->agent_id = Auth::user()->id;
            $trx->trx_type = 0;
            $trx->purpose = $purpose;
            $trx->amount = $request->amount;
            $trx->approved = 1;
            $trx->withdraw_type = $request->type;
            $trx->save();

            $request->approved = 1;
            $request->save();
        });
        Session::flash('success', 'Resolved and moved to transaction.');
        return redirect()->route('admin.customer.withdrawal');
    }
}
