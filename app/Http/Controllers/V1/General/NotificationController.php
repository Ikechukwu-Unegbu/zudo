<?php

namespace App\Http\Controllers\V1\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        
        return view('admin.notification.index');
    }
}
