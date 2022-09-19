@extends('layouts.admin')

@section('head')
<link rel="stylesheet" href="{{asset('css\pages\deposit\deposit.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .support-page{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    .card-body{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .card{
        box-shadow: 0 0 8px whitesmoke;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="mb-3">
        <form class="search_form" action="{{route('admin.customer.search')}}" method="get">
           <input type="text" name="search-key" placeholder="Enter complain key or complainant name." class="form-control">
           <button class="btn btn-sm">Search</button>
        </form>
    </div>

    <div>
        <h3 class="text-center text-dark">Custumer Complain View</h3>
        @include('partials._message')
    </div>
    <div class="admin-support-page">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Complains</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Feedbacks</button>
        </li>
        <!-- <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
        </li> -->
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            @include('pages.support.include._complain_table')
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @include('pages.support.include._feedback_table')
        </div>
        <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div> -->
    </div>
    
        <!-- table start -->
       
        
        <!-- table end -->

    </div>
  
</div>



@endsection