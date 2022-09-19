<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\V1\Admin\Setting;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiteSettingsController extends Controller
{
    public function index(){
        $setting = Setting::find(1);
        return view('admin.Settings.settings')->with('setting', $setting);
    }

    public function sms(){
       $setting = Setting::find(1);
       if($setting->sms==1){
            $setting->sms =0;
       }else{
            $setting->sms =1;
       }
       $setting->save();
       Session::flash('success', 'SMS settings have be successfully reset.');
       return redirect()->back();
    }

    public function debit(){
        $setting = Setting::find(1);
        if($setting->e_debit==1){
             $setting->e_debit =0;
        }else{
             $setting->e_debit =1;
        }
        $setting->save();
        Session::flash('success', 'E-debit settings have be successfully reset.');
        return redirect()->back();
    }


    public function credit(){
        $setting = Setting::find(1);
        if($setting->e_credit==1){
             $setting->e_credit =0;
        }else{
             $setting->e_credit =1;
        }
        $setting->save();
        Session::flash('success', 'E-credit settings have be successfully reset.');
        return redirect()->back();
    }

    public function user_data(){
        $setting = Setting::find(1);
        if($setting->user_data==1){
             $setting->user_data =0;
        }else{
             $setting->user_data =1;
        }
        $setting->save();
        Session::flash('success', "User's control over their data setting resetted.");
        return redirect()->back();
    }


}
