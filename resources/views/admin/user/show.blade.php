@extends('layouts.admin')

@section('head')
<style>
.search_form{
    display: flex !important;
    flex-direction: row !important;
    align-items: center;   
}
.user-deet-container{
    background-color: white;
    margin-top: 3rem;
    padding: 2rem;
}
.user-dp{
    height: 12rem;
    width: 12rem;
    border-radius: 50%;
}
.wall_div{
    display:flex;
    justify-content:center; 
    align-items:center;
    width: 100% !important;

}
</style>
@endsection

@section('content')
<div class="container">
    <div>
        <form class="search_form" action="{{route('admin.customer.search')}}" method="get">
            @include('admin.partials._customer_search_form')
        </form>
    </div>
    <div class="user-deet-container">
        <div class="profile-image" style="display: flex; justify-content:center;">
            <img @if($user->avatar == null) src="{{asset('image\avatar.jpg')}}" @else src="{{asset('public/userfiles/'.$user->avatar)}}"  @endif alt="" class="user-dp img-fluid">
        </div>
        <br>
        <div class="mt-4 mb-4">
            <h2 class="text-center">N {{$wallet->balance}}</h2>
        </div>
        <br>
        @if($user->access == 'channel')
        <div class="wall_div" >
            <div class="text-center">{{$user->channel_description}}</div>
        </div>
        @endif
        <!-- <div class="mt-4"> -->
            <a href="{{route('admin.user.transaction',[$user->id ])}}" style="float: right;" class="btn btn-primary btn-sm">
                View Transactions
            </a>
            <button class="btn btn-sm btn-info" style="float: right; margin-right:1rem;" data-toggle="modal" data-target="#new-kin">Add Kin</button>
            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#new-bank" style="float: right; margin-right:1rem;">Add Bank</button>
            
        <!-- </div> -->
        <h3 style="display: block;" class="">User Information</h3>
        <div class="">
            @include('partials._message')
        </div>
        <div class="deet-div">
            
            <ul class="list-group">
                <li class="list-group-item">
                    <span>Name: </span>
                    <span>{{$user->name}} {{$user->fullname}}</span>
                </li>
                <li class="list-group-item">
                    <span>Email: </span>
                    <span>{{$user->email}}</span>
                </li>
                <li class="list-group-item">
                    <span>Phone: </span>
                    <span>{{$user->phone}}</span>
                </li>
                <li class="list-group-item">
                    <span>Access Level:  </span>
                    <span>{{$user->access}}</span>
                </li>
                
                <li class="list-group-item">A fourth item</li>
                <li class="list-group-item">And a fifth one</li>
            </ul>
        </div>
        <div class="deet-div mt-4">
            <h3 class="text-center">More User Info</h3>
            @foreach($bankacc as $bank)
                <li class="list-group-item">
                    <span style="font-weight:bolder;">Bank Details</span>
                    <span>{{$bank->bank_name}} - {{$bank->bank_account}}</span>
                    <span><button class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit-bank-{{$bank->id}}" style="float: right; margin-right:1rem;">Edit Bank</button></span>
                </li>
                @include('admin.user.includes._edit_bank')
            @endforeach
        </div>
        <div class="deet-div mt-4">
            <h3 class="text-center">Next of Kin</h3>
            @if(count($kins) == 0)
            <h5 class="text-center">No Next of Kin Provided</h5>
            @else
                @foreach($kins as $k)
                <div class="card" style="width: 18rem;">
                    <img @if($k->image == null) src="{{asset('image\avatar.jpg')}}" @else src="{{asset('public/userfiles/'.$k->image)}}"  @endif alt="...">
                    <div class="card-body">
                        <li class="list-group-item">
                            <span>Name: </span>
                            <span>{{$k->fullname}}</span>
                        </li>
                        <li class="list-group-item">
                            <span>Email:  </span>
                            <span>{{$k->email}}</span>
                        </li>
                        <li class="list-group-item">
                            <span>Phone:  </span>
                            <span>{{$k->phone}}</span>
                        </li>
                        <button class="btn btn-sm btn-primary" style="width:100%;" data-toggle="modal" data-target="#edit-kin-{{$k->id}}">Edit</button>
                    </div>
                </div>
                @include('admin.user.includes._edit_kins')
                @endforeach
            @endif
            <!-- start of card -->
            
            <!-- end of card -->
        </div>
    </div>


</div>
{{--@include('admin.user.includes._new_bank')--}}
@include('admin.agents.include._new_agent_modal')
@include('admin.user.includes._new_kin')

@endsection