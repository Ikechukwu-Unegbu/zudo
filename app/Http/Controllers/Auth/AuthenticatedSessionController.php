<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\V1\Admin\Transaction;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   
        $trxVol = Transaction::all()->sum('amount');
        $usersTotal = User::all()->count();
        $array = ['trxvol'=>$trxVol, 'totalusers'=>$usersTotal];
        return view('pages.auth.login')->with('stats', $array);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
      
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

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
