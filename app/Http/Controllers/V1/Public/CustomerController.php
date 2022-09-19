<?php

namespace App\Http\Controllers\V1\Public;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function resetPassword(Request $request){
        // var_dump($request->all());die;
        $request->validate([
            'old_password'=>'required|string',
            'new_password'=>'required|string', 
            'confirm_new_password'=>'required|string'
        ]);

        if($request->new_password != $request->confirm_new_password){
            Session::flash('failed', 'Password doesnt match.');
            return redirect()->back();
        }
        $user = User::findOrFail(Auth::user()->id);
        if(!Hash::check($request->new_password , $user->password)){
            Session::flash('failed', 'Enter your correct password.');
            return redirect()->back();
        }
       
        $user->password = Hash::make($request->new_password);
        $user->save();
        Session::flash('success', 'New password successfully set.');
        return redirect()->back();
    }
}
