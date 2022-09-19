<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Kin;
use App\Models\V1\Users\Bankaccount;
use App\Services\FileUploadService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class UserController extends Controller
{
    public function updateBank(Request $request, $userid, $bankId){
        $request->validate([
            'name'=>'required|string',
            'account'=>'required|string'
        ]);
        $bankModel = Bankaccount::where('user_id', $userid)->where('id', $bankId)->first();
        $bankModel->bank_name = $request->name;
        $bankModel->bank_account = $request->account;
        $bankModel->save();

        //final
        FacadesSession::flash('success', 'Bank details updated.');
        return redirect()->back();
    }

    public function newBank(Request $request, $userid){
        $request->validate([
            'name'=>'required|string',
            'account'=>'required|string',
        ]);
        $user = User::findOrFail($userid);
        $bankModel = new Bankaccount();
        $bankModel->bank_name = $request->name;
        $bankModel->user_id = $user->id;
        $bankModel->bank_account = $request->account;

        $bankModel->save();
        //final message
        FacadesSession::flash('success', 'New bank detail added.');
        return redirect()->back();
    }

    public function newKin(Request $request, $userid){
        $request->validate([
            'fullname'=>"required|string",
            'phone'=>'required|string',
            'email'=>'required|string',
            'gender'=>'required|string'
        ]);

        $user = User::findOrFail($userid);
        //insert texts into db
        $kinModel = new Kin();
        $kinModel->fullname = $request->fullname;
        $kinModel->email = $request->email;
        $kinModel->gender = $request->gender;
        $kinModel->phone = $request->phone;
        $kinModel->user_id = $user->id;
        $kinModel->relationship = $request->relation;
        $kinModel->save();

        //check if image is being uploaded and handle it
        if($request->hasFile('kin_image')){
            $uploaderInstance = new FileUploadService();
            $uploaderInstance->upload($request, 'kin', $kinModel->id);
        }
        //final response
        FacadesSession::flash('success', 'Next of kin added.');
        return redirect()->back();
    }

    public function updateKin(Request $request, $userid, $kinId){
        $request->validate([
            'fullname'=>"required|string",
            'phone'=>'required|string',
            'email'=>'required|string',
            'gender'=>'required|string'
        ]);

        //insert texts into db
        $kinModel = Kin::where('user_id', $userid)->where('id', $kinId)->first();
        $kinModel->fullname = $request->fullname;
        $kinModel->email = $request->email;
        $kinModel->gender = $request->gender;
        $kinModel->phone = $request->phone;
        $kinModel->save();

        //handle image
        if($request->hasFile('image')){
            //get the old image and delete it from file system

            //upload new one
            $uploaderInstance = new FileUploadService();
            $uploaderInstance->upload($request, 'kin', $kinModel->id);
            
        }
        //send final message 
        FacadesSession::flash('success', 'Successfully edited kin details.');
        return redirect()->back();

    }
}
