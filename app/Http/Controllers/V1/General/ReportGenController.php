<?php

namespace App\Http\Controllers\V1\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\V1\Admin\Transaction;
use App\Models\V1\Public\Request as PublicRequest;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Carbon;

class ReportGenController extends Controller
{
    public function adminGeneratingUserReport($userId){
        set_time_limit(300);
        
        $transactions = Transaction::where('customer_id', $userId)->get();
       
        foreach($transactions as $trx){
            $trx->customer->toArray();
            $totalWiths= Transaction::whereDate('created_at', "<=", Date($trx->created_at))->where('trx_type', 0)
            ->sum('amount');
            $totalContribution= Transaction::whereDate('created_at', "<=", Date($trx->created_at))->where('trx_type', 1)
            ->sum('amount');
            $trx->total_bal = $totalContribution-$totalWiths;
            
        }

        $customer = User::find($userId);
        foreach($transactions as $trx){
            $trx->agent->toArray();
        }
        $data['transactions'] = $transactions->toArray();
        $data['user']=$customer->toArray();
        $data['totalContribution'] = $totalContribution;
        $data['totalWiths'] = $totalWiths;
        view()->share('data',$data);
        
                                          
        $pdf = FacadePdf::loadView('admin.transaction.include._table_for_pdf',$data);
        return $pdf->download('pdf_file.pdf');
    }

    public function agentUserTransactionReport($agentId){
        $agent  = User::findOrFail($agentId);
        if(request()->input('userid') !=null && request()->input('start_date') != null && request()->input('end_date')){
            $startDate = Carbon::createFromFormat('Y-m-d', request()->input('start_date'))->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', request()->input('end_date'))->endOfDay();
            $transaction = Transaction::where('agent_id', $agentId)
            ->where('customer_id', request()->input('userid'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->paginate(20);

            //convert to array 
            foreach($transaction as $trx){
                // $trx->toArray();
                $trx->customer->toArray();
                $trx->agent->toArray();
            }
            //pass data to pdf view
            $agent = User::find($agentId);
            $data['transactions'] = $transaction->toArray();
            $data['agent']= $agent;
            view()->share($data);

            //generate pdf
            $pdf = FacadePdf::loadView('admin.transaction.include._table_for_pdf',$data);
            return $pdf->download('pdf_file.pdf');
        }
        
        $transaction = Transaction::where('agent_id', $agentId)->paginate(20);
        $agent = User::find($agentId);
        $data['transactions'] = $transaction->toArray();
        $data['agent']= $agent;
        view()->share($data);

        //generate pdf
        $pdf = FacadePdf::loadView('admin.transaction.include._table_for_pdf',$data);
        return $pdf->download('pdf_file.pdf');
    }
}
