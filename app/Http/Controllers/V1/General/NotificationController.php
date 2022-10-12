<?php

namespace App\Http\Controllers\V1\General;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(){
        
        return view('admin.notification.index');
    }

    public function markall(){
        $user = User::findOrFail(Auth::user()->id);
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        //return redirect
        return redirect()->route('user.nofitication', $user->id);
    }

      
    public function userNotification($userId){
        
        if($userId != Auth::user()->id){
            return redirect()->route('user.nofitication', [Auth::user()->id]);
        }

        if(request()->input('filter') == null || request()->input('filter')=='unread'){
            $notification = User::find($userId)->unreadNotifications;
            return view('customer.notification.index')->with('notifications', $notification);
        }

        if(request()->input('filter') == 'all'){
            $notification = User::find($userId)->notifications()->paginate(30);
            return view('customer.notification.index')->with('notifications', $notification);
        }
        
    }
}
