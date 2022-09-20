<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

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

        $user = User::create([
            'name'  =>  $request->username,
            'fullname'  =>  $request->name,
            'email'     =>  $request->email,
            'password'  =>  bcrypt($request->password),
            'access'    =>  'user',
        ]);
        session()->flash('success', 'Congratulations, your account has been successfully created.');
        return redirect()->to(route('login'));
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
            'email'     =>      'required|string|email',
            'password'   =>     'required|string'
        ]);

        if(Auth::attempt($request->only('email', 'password')))
        {
            if(auth()->user()->access == 'channel')
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

        $user = User::create([
            'name'  =>  $request->username,
            'fullname'  =>  $request->name,
            'email'     =>  $request->email,
            'password'  =>  bcrypt($request->password),
            'access'    =>  'channel',
        ]);
        session()->flash('success', 'Congratulations, your account has been successfully created.');
        return redirect()->to(route('channels.login'));
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

        $user = User::create([
            'name'  =>  $request->username,
            'fullname'  =>  $request->name,
            'email'     =>  $request->email,
            'password'  =>  bcrypt($request->password),
            'access'    =>  'admin',
        ]);
        session()->flash('success', 'Congratulations, your account has been successfully created.');
        return redirect()->to(route('administrator.index'));
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
