<?php

namespace App\Http\Controllers\V1\General;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
   public function customerSearch(Request $request){
    $channels = User::where('access', 'channel')->get();
    if($request->keyword !== null){
        $result = User::where('name','LIKE','%'.$request->keyword.'%')
            ->orWhere('fullname','LIKE','%'.$request->keyword.'%')
            ->get();
        return view('admin.search.customer_search')->with('customers', $result)->with('channels', $channels); 
    } 
    else{
        if($request->keyid != null){
            $result = User::where('id', (int)$request->keyid)->get();
            return view('admin.search.customer_search')->with('customers', $result)->with('channels', $channels);
        }
    }

   }

   
}
