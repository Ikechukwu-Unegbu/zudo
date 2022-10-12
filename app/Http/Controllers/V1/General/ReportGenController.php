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
use Illuminate\Support\Facades\Response;
use Rap2hpoutre\FastExcel\FastExcel;

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

    public function allTransactionExcelReport(){
        //generate unique name for the file
        $time = rand(1000, 10000000);
        if(request()->input('start')==null && request()->input('end')==null){
             //generating the file
            (new FastExcel(Transaction::all()))->export('excel/'.$time.'.xlsx', function ($trx) {
                return [
                    'ID' => $trx->id,
                    'CREDIT' => $trx->trx_tpye == 1 ? $trx->amount : '-',
                    'DEBIT'=> $trx->trx_tpye == 0 ? $trx->amount : '-',
                    'AGENT NAME' => $trx->agent->name,
                    'CUSTOMER NAME'=>$trx->customer->name,
                    'DATE'=>date('d-m-Y', strtotime($trx->created_at)),
                ];
            });
        }else{
            $startDate = Carbon::createFromFormat('Y-m-d', request()->input('start'));
            $endDate = Carbon::createFromFormat('Y-m-d', request()->input('end'));
            (new FastExcel(Transaction::whereBetween('created_at', [$startDate, $endDate])->get()))
                ->export('excel/'.$time.'.xlsx', function ($trx) {
                return [
                    'ID' => $trx->id,
                    'CREDIT' => $trx->trx_tpye == 1 ? $trx->amount : '-',
                    'DEBIT'=> $trx->trx_tpye == 0 ? $trx->amount : '-',
                    'AGENT NAME' => $trx->agent->name,
                    'CUSTOMER NAME'=>$trx->customer->name,
                    'DATE'=>date('d-m-Y', strtotime($trx->created_at)),
                ];
            });
        }
       
       
        // var_dump([99403030,03003003]);
        $filepath = public_path('excel/'.$time.'.xlsx');
        return Response::download($filepath);
    }
}
