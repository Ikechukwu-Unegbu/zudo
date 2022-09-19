<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Admin\Transaction;
use App\Models\V1\Public\Request as PublicRequest;
use App\Notifications\TellAdminAboutWithdrawalRequest;
use App\Services\SMSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class TransactionController extends Controller
{
    public function xTransaction(){
        if(Auth::user()->access == 'agent'){
            $transactions = Transaction::where('agent_id', Auth::user()->id)->paginate(50);
        }elseif(Auth::user()->access == 'admin'){
            $transactions = Transaction::paginate(50);
        }
       
        return view('admin.transaction.all.all')->with('transactions', $transactions);
    }

    public function depositTransactions(){
        //print('right here'); die;
        if(request()->input('start_date')==null || request()->input('end_date')==null){
            //handle when user is not admin
            if(Auth::user()->access == 'agent'){
                $transactions = Transaction::where('trx_type', 1)
                    ->where('agent_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(50);
                return view('admin.deposit.deposit')->with('transactions', $transactions);
            }
            //when user is admin, get everything.
            $transactions = Transaction::where('trx_type', 1)->orderBy('id', 'desc')->paginate(50);
            return view('admin.deposit.deposit')->with('transactions', $transactions);
        }

        $startDate = Carbon::createFromFormat('Y-m-d', request()->input('start_date'));
        $endDate = Carbon::createFromFormat('Y-m-d', request()->input('end_date'));
        // when user is not admin, get record for that user only
        if(Auth::user()->access == 'agent'){
            $transactions = Transaction::where('trx_type', 1)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('agent_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(50);
            return view('admin.deposit.deposit')->with('transactions', $transactions);
        }else{
            //when user is admin
            $transactions = Transaction::where('trx_type', 1)
            ->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'desc')->paginate(50);
            return view('admin.deposit.deposit')->with('transactions', $transactions);
        }
     
    }

    public function withdrawTransactions(){
        
        if(request()->input('start_date')==null || request()->input('end_date')==null){
           //when user is not admin, get records for that user only
            if(Auth::user()->access == 'agent'){
                $transactions = Transaction::where('trx_type', 0)->orderBy('id', 'desc')
                                ->where('agent_id', Auth::user()->id)->paginate(50);
                return view('admin.deposit.withdrawal')->with('transactions', $transactions);
           }
           //when user is admin, get everything
           $transactions = Transaction::where('trx_type', 0)->orderBy('id', 'desc')->paginate(50);
           return view('admin.deposit.withdrawal')->with('transactions', $transactions);
        }
        $startDate = Carbon::createFromFormat('Y-m-d', request()->input('start_date'));
        $endDate = Carbon::createFromFormat('Y-m-d', request()->input('end_date'));
        if(Auth::user()->access == 'agent'){
            $transactions = Transaction::where('trx_type', 0)->whereBetween('created_at', [$startDate, $endDate])
                    ->where('agent_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(50);
                    return view('admin.deposit.withdrawal')->with('transactions', $transactions);
        }else{
            $transactions = Transaction::where('trx_type', 0)->whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('id', 'desc')->paginate(50);
                return view('admin.deposit.withdrawal')->with('transactions', $transactions);
        }
     
    }


    public function storeAlt(Request $request){
        // var_dump($request->all());die;
        $request->validate([
            'amount'=>'required|string',
            'customer'=>'required|string'
        ]);
       
        $agent = User::find(Auth::user()->id);
        $customer = User::findOrFail($request->customer);
        $trx = new Transaction();
        $trx->amount =$request->input('amount');
        $trx->customer_id = $customer->id;
        $trx->agent_id = $agent->id;
        $trx->purpose = $request->input('purpose', 'Contribution');
        $trx->trx_type = 1;
        $trx->save();

        Session::flash('success', 'Deposit registered successfully for '.$customer->name);
        return redirect()->route('admin.customer.deposit');
    }

    public function store(Request $request, $customerId){
        // var_dump($request->all());die;
        $request->validate([
            'amount'=>'required|string',
            'type'=>'required|string'
        ]);
        $type ='';
      
        $agent = User::find(Auth::user()->id);
        $trx = new Transaction();
        $trx->amount =$request->input('amount');
        $trx->customer_id = $customerId;
        $trx->agent_id = $agent->id;
        $trx->purpose = $request->input('purpose', 'Contribution/Withdrawal');
        $trx->trx_type = $request->type;
        $trx->save();
        $customer = User::find($customerId);
        //send sms to the user

        $smsService = new SMSService();
        $message ='';
        if($request->type == 1){
            $message = "Your contribution of N".$request->amount." recieved.";
        }
        else{
            $message = "Your debit of N".$request->amount." is being processed.";
        }
        $smsresponse = $smsService->senderSMS($message, $customer->phone, 'Spartan');
        $smsService->logsms($smsresponse, $trx);
        //send response
       if($request->type == 1){
            Session::flash('success', 'Deposit registered successfully.');
            return redirect()->route('admin.customer.deposit');
       }else{
            Session::flash('success', 'Deposit registered successfully.');
            return redirect()->route('admin.customer.withdrawal');
       }
    }


    public function updateTrx(Request $request, $id){
      
       $request->validate([
            'amount'=>'required|string',
            'customer'=>'required|string'
       ]);
       if(Auth::user()->access != 'admin'){
            Session::flash('failed', 'You do not have authorization to perform this action');
            return redirect()->back();
       }
        $trx = Transaction::find($id);
        $trx->amount = (int)$request->amount;
        $trx->purpose = $request->purpose;
        $trx->customer_id = $request->customer;
        $trx->trx_type = $request->type;

        $save = $trx->save();

        Session::flash('success', 'Trx edited by admin.');
        $urlArray = explode('/', url()->previous());
        if(in_array('withdrawal', $urlArray)){
            return redirect()->route('admin.customer.withdrawal');
        }
        return redirect()->route('admin.customer.deposit');
    }


    public function registerWithdraw(Request $request){
        $request->validate([
            'amount'=>'required|string',
            'password'=>'required|string', 
            'type'=>'required|string'
        ]);

        if(!Hash::check($request->password, Auth::user()->password)){
            Session::flash('failed', 'Incorrect password. Try again.');
            return redirect()->back();
        }

        $requetModel = new PublicRequest();
        $requetModel->amount = $request->amount;
        $requetModel->type = $request->type;
        $requetModel->customer_id = Auth::user()->id;
        $requetModel->approved = 0;
        $requetModel->save();
        //notify admin of this reqest
        $admin = User::where('access','!=', 'users')->get();
        Notification::sendNow($admin, new TellAdminAboutWithdrawalRequest($requetModel,  User::find(Auth::user()->id)));
        //send response to user
        Session::flash('success', 'Your request has been recieved and being processed.');
        return redirect()->back();
    }



    public function singleUserTransaction($userId){
        $transactions = Transaction::where('customer_id', $userId)->paginate(12);
        $totalDebit = Transaction::where('customer_id', $userId)->where('trx_type', 0)->where('approved', 1)->sum('amount');
        $totalCredit = Transaction::where('customer_id', $userId)->where('trx_type', 1)->sum('amount');
        
        foreach($transactions as $trx){
            // $bookings = DB::table('transactions')
            $totalWiths= Transaction::whereDate('created_at', "<=", Date($trx->created_at))->where('trx_type', 0)
            ->sum('amount');
            $totalContribution= Transaction::whereDate('created_at', "<=", Date($trx->created_at))->where('trx_type', 1)
            ->sum('amount');
            $trx->total_bal = $totalContribution-$totalWiths;
            
        }
        $customer = User::find($userId);
        $totalContribution = Transaction::where('customer_id', $userId)->sum('amount');
       
        return view('admin.transaction.transactions')
                                            ->with('transactions', $transactions)
                                            ->with('user', $customer)
                                            ->with('totalContribution', $totalContribution)
                                            ->with('total_debit', $totalDebit)
                                            ->with('total_credit', $totalCredit);
    }

    
    public function reportgenerate(){
       if(request()->input('start_date') == null || request()->input('end_date')==null || request()->input('userid')==null){
        (new FastExcel(Transaction::all()))->export('exports/transactions.xlsx', function ($trxtion) {
            return [
                'ID'=>$trxtion->id,
                'NAME'=>$trxtion->customer->name,
                'CUSTOMER ID'=>$trxtion->customer->id, 
                'CREDIT'=>$trxtion->trx_type?$trxtion->amount:0,
                'DEBIT'=>$trxtion->trx_type?0:$trxtion->amount,
                'DATE'=>$trxtion->created_at, 
                'AGENT'=>$trxtion->agent->name
            ];
        });
       }

       $startDate = Carbon::createFromFormat('Y-m-d', request()->input('start_date'));
        $endDate = Carbon::createFromFormat('Y-m-d', request()->input('end_date'));
  
        $trx = Transaction::whereBetween('created_at', [$startDate, $endDate])->get();
       (new FastExcel($trx))->export('exports/transactions.xlsx', function ($trxtion) {
            return [
               'ID'=>$trxtion->id,
               'NAME'=>$trxtion->customer->name,
               'CUSTOMER ID'=>$trxtion->customer->id, 
               'CREDIT'=>$trxtion->trx_type?$trxtion->amount:0,
               'DEBIT'=>$trxtion->trx_type?0:$trxtion->amount,
               'DATE'=>$trxtion->created_at, 
               'AGENT'=>$trxtion->agent->name
            ];
        });

    }

}
