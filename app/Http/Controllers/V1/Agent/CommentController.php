<?php

namespace App\Http\Controllers\V1\Agent;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Admin\Comment;
use App\Notifications\NewComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function store(Request $request, $trxId){
        
        $request->validate([
            'comment'=>'required|string'
        ]);
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->transaction_id = $trxId;
        $comment->user_id = Auth::user()->id;
        $comment->save();
        //notify admin of the comment.
        $admin = User::where('access', 'admin')->get();
        Notification::sendNow($admin, new NewComment($comment));
        //send response
        Session::flash('success', 'Comment successfully added.');
        return redirect()->back();
    }

    public function comments(){
        if(Auth::user()->access !== 'admin') return redirect()->back();
        $comments = Comment::orderBy('id', 'desc')->paginate(30);
        return view('admin.comment.index')->with('comments', $comments);
    }

    public function destroy(){

    }
}
