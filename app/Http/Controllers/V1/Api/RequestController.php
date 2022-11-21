<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Public\Request as PublicRequest;
use App\Notifications\TellAdminAboutWithdrawalRequest;
use Illuminate\Http\Request;
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

        return response()->json($requetModel);
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

        return response()->json($requestModel);
    }



}
