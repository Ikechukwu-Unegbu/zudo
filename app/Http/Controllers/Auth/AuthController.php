<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Users\Wallet;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function registerIndex()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name'  =>  'required|string',
            'username'  =>  'required|string|unique:users,name',
            'email'     =>  'required|email|unique:users,email',
            'password'  =>  'required|string|min:6',
            'password_confirmation'  =>  'required|same:password'
        ]);

        return DB::transaction(function()use($request){
            $user = User::create([
                'name'  =>  $request->username,
                'fullname'  =>  $request->name,
                'email'     =>  $request->email,
                'password'  =>  bcrypt($request->password),
                'access'    =>  'user',
            ]);
            //create wallet for user
            $wallet = new Wallet();
            $wallet->balance = 0;
            $wallet->user_id = $user->id;
            $wallet->save();
            //notify admin
            session()->flash('success', 'Congratulations, your account has been successfully created.');
            return redirect()->to(route('login'));
        });
    }

    public function storeSession(Request $request)
    {
        $this->validate($request, [
            'email'     =>      'required|string|email',
            'password'   =>     'required|string'
        ]);

        if(Auth::attempt($request->only('email', 'password')))
        {
            if(auth()->user()->access == 'user')
            {
                return redirect()->intended('/panel');
            }else{
                auth()->logout();
                return redirect()->back()->withErrors('You are not allow to Access this Page');
            }
        }
        else {
            return redirect()->back()->withErrors(trans('auth.failed'));
        }
    }

    public function channelLoginIndex()
    {
        return view('auth.channel.login');
    }

    public function channelLogin(Request $request)
    {
        $this->validate($request, [
            'email'     =>      'required|string',
            'password'   =>     'required|string'
        ]);

        $anyUser = User::where('phone', $request->email)->orWhere('email', $request->email)->first();
        
        
        if(!$anyUser){
            Session::flash('failed', "Incorrect Credentials.");
            return redirect()->back();
        }
       
        if(!Hash::check($request->password, $anyUser->password)){
            Session::flash('failed', 'Incorrect Credentials.');
            return redirect()->back();
        }
        $user = User::find($anyUser->id);
       
        Auth::guard('web')->login($user, $request->remember_me);
   
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function channelRegisterIndex()
    {
        return view('auth.channel.register');
    }

    public function channelRegister(Request $request)
    {
        $this->validate($request, [
            'name'  =>  'required|string',
            'username'  =>  'required|string|unique:users,name',
            'email'     =>  'required|email|unique:users,email',
            'password'  =>  'required|string|min:6',
            'password_confirmation'  =>  'required|same:password'
        ]);

        return DB::transaction(function()use($request){
            $user = User::create([
                'name'  =>  $request->username,
                'fullname'  =>  $request->name,
                'email'     =>  $request->email,
                'password'  =>  bcrypt($request->password),
                'access'    =>  'channel',
            ]);
            //instantiate wallet 
            $wallet = new Wallet();
            $wallet->balance = 0;
            $wallet->user_id = $user->id;
            $wallet->save();
            session()->flash('success', 'Congratulations, your account has been successfully created.');
            return redirect()->to(route('channels.login'));

        });
    }

    public function adminRegisterIndex()
    {
        return view('auth.admin.register');
    }

    public function adminRegister(Request $request)
    {
        $this->validate($request, [
            'name'  =>  'required|string',
            'username'  =>  'required|string|unique:users,name',
            'email'     =>  'required|email|unique:users,email',
            'password'  =>  'required|string|min:6',
            'password_confirmation'  =>  'required|same:password'
        ]);
        return DB::transaction(function()use($request){
            
            $user = User::create([
                'name'  =>  $request->username,
                'fullname'  =>  $request->name,
                'email'     =>  $request->email,
                'password'  =>  bcrypt($request->password),
                'access'    =>  'admin',
            ]);
            //create wallet 
            $wallet = new Wallet();
            $wallet->balance = 0;
            $wallet->user_id = $user->id;
            $wallet->save();
            session()->flash('success', 'Congratulations, your account has been successfully created.');
            return redirect()->to(route('administrator.index'));
        });
    }

    public function AdminLoginIndex()
    {
        return view('auth.admin.login');
    }

    public function AdminLogin(Request $request)
    {
        $this->validate($request, [
            'email'     =>      'required|string|email',
            'password'   =>     'required|string'
        ]);

        if(Auth::attempt($request->only('email', 'password')))
        {
            if(auth()->user()->access == 'admin')
            {
                return redirect()->intended('/panel');
            }else{
                auth()->logout();
                return redirect()->back()->withErrors('You are not allow to Access this Page');
            }
        }
        else {
            return redirect()->back()->withErrors(trans('auth.failed'));
        }
    }

    public function forgtPasswordIndex()
    {
        return view('auth.forgot-password');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
