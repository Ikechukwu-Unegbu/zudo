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
        $agents = User::where('access', 'agent')->get();
        $channels = Channel::all();
        return view('admin.channel.index')->with('agents', $agents)
                                            ->with('channels', $channels);
    }

    public function create(Request $request){
        $request->validate([
            'name'=>'required|string',
            'description'=>'required|string',
        ]);

        $channel = new Channel();
        $channel->name = $request->name;
        $channel->description = $request->description;
        $channel->save();
        
        //attach the agent with provided ID to this channel.

        Session::flash('success', 'New channel created.');
        return redirect()->back();
    }
}
