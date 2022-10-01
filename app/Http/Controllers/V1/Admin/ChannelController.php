<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Admin\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChannelController extends Controller
{
    public function index(){
        // $agents = User::where('access', 'agent')->get();
        // $channels = Channel::all();
        // return view('admin.channel.index')->with('agents', $agents)
        //                                     ->with('channels', $channels);

        $channels = User::whereAccess('channel')->get();
        return view('admin.channel.index')->with('channels', $channels);
    }

    public function create(Request $request){
        $request->validate([
            'name'      =>   'required|string',
            'username'  =>  'required|string',
            'email'     =>  'required|email|unique:users,email',
            'mobile'    =>  'required|min:11|max:11|unique:users,phone',
            'gender'    =>  'required|string',
            'password'  =>  'required|string|min:6',
            'password_confirmation' =>  'required|string|same:password',
            'description'=> 'required|string',
        ]);

        // $channel = new Channel();
        // $channel->name = $request->name;
        // $channel->description = $request->description;
        // $channel->save();

        User::create([
            'fullname'  =>  $request->name,
            'name'      =>  $request->username,
            'email'     =>  $request->email,
            'phone'     =>  $request->mobile,
            'gender'     =>  $request->gender,
            'password'  =>  bcrypt($request->password),
            'channel_description'   =>  $request->description,
            'access'     => 'channel'
        ]);

        //attach the agent with provided ID to this channel.

        Session::flash('success', 'New channel created.');
        return redirect()->back();
    }
}
