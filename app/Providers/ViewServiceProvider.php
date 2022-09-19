<?php

namespace App\Providers;

use App\Models\User;
use App\Models\V1\Public\Complain;
use App\Models\V1\Public\Testimony;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view){
            if(Auth::check()){
                $user = User::find(Auth::user()->id);
                 $notifications = User::find(Auth::user()->id)->notifications()->paginate(20);//auth()->user()->notifications->paginate(20);
                $unread = User::find(Auth::user()->id)->unreadNotifications;
                $complain = Complain::where('resolved', 0)->get();
             
                $view->with('nots', $notifications)
                                        ->with('unread', $unread)
                                        ->with('loggedUser', $user)
                                        ->with('comp', $complain);
            }
        });
    
    }
}
