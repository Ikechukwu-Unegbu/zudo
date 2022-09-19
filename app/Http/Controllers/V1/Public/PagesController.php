<?php

namespace App\Http\Controllers\V1\Public;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Admin\FaqCategory;
use App\Models\V1\Admin\Transaction;
use App\Models\V1\Public\Complain;
use App\Models\V1\Public\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class PagesController extends Controller
{

    public function faq(){
        return view('customer.faq.faq');

    }

    public function home(){
        $trxVol = Transaction::all()->sum('amount');
        $usersTotal = User::all()->count();
        $array = ['trxvol'=>$trxVol, 'totalusers'=>$usersTotal];
        return view('pages.home.index')->with('stats', $array);
    }

    public function settings(){
        // Auth
    }

    public function widthdrawal(){

        return view('customer.withdraw.withdraw');
    }

    public function contact(){
        return view('pages.contact.index');
    }

    public function customerProfile(){
        return view('customer.myprofile.myprofile');
    }

    public function about(){
        $trxVol = Transaction::all()->sum('amount');
        $usersTotal = User::all()->count();

        $array = ['trxvol'=>$trxVol, 'totalusers'=>$usersTotal, 'branches'=>2];
        $categories = FaqCategory::with('faqs')->orderBy('name', 'ASC')->get();
        return view('pages.about.index', ['categories' => $categories])->with('stats', $array);
    }

    public function support(){

        $complains = Complain::paginate(12);
        $reviws = Testimony::paginate(12);

        if(Auth::user()->access == 'admin' || Auth::user()->access == 'agent')

            return view('pages.support.admin_support')->with('complains', $complains)->with('reviews', $reviws);
        else
        return view('customer.support.support');
    }

    public function complain(Request $request){
        //return response()->json($request->all());die;
        $validate = Validator::make($request->all(), [
            'complain'=>'required|string'
        ]);
        if($validate->fails()){
            return response()->json(["message"=>"Message field is empty."]);
        }
        $complainant = User::find(Auth::user()->id);
        $complain = new Complain();
        $complain->complain = $request->complain;
        $complain->number = Str::random().'-'.$complainant->name;
        $complain->complainant_id = $complainant->id;
        $complain->resolved = 0;
        $complain->save();

        //send sms or notification to this person with their complain number

        return response()->json(["message"=>"Your complain has been recieved."]);

    }

    public function sendreview(Request $request){
        $validate = Validator::make($request->all(), [
            'review'=>'required|string',
            'usage'=>'required|string'
        ]);
        if($validate->fails()){
            return response()->json(["message"=>"There is an empty field."]);
        }
        $review = new Testimony();
        $review->user_id = Auth::user()->id;
        $review->usage = $request->usage;
        $review->review = $request->review;
        $review->save();

        return response()->json(["message"=>"Thank you for the feed back!"]);
    }

    public function resolveComplain($complainId){
        $complain = Complain::find($complainId);
        $complain->resolved = 1;
        $complain->save();

        Session::flash('success', 'Complain set to resolved.');
        //send the user a database notification
        return redirect()->back();
    }


//    public function review()

}
