@extends('layouts.admin')

@section('head')

<link rel="stylesheet" href="{{asset('css/pages/notification/notification.css')}}">
@endsection

@section('content')
<div class="container">
  <div>
    <form class="search_form" action="{{route('admin.customer.search')}}" method="get">
        <input type="text" name="not_search" class="form-control">
        <button class="btn btn-sm">Search</button>
    </form>
</div>
    <div class="mt-5">
        @foreach($nots as $not)
        
            <a href="{{$not->data['url']}}" class="card notification-card">
                <div class="card-body">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=464&q=80" alt="" class="img-fluid not-img">
                    <div><span>{{$not->data['message']}}</span></div>
                </div>
            </a>
        @endforeach
    </div>
</div>


@endsection