@extends('layouts.admin')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
.search_form{
    display: flex !important;
    flex-direction: row !important;
    align-items: center;   
}
@media(max-width:700px) {
  .mobile{
  display: none;
}
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
<h3 class="text-center"> Customer List</h3>
<div>
    <button class="button mt-3 mb-3 btn btn-sm btn-primary"  data-toggle="modal" data-target="#new-staff">
        New User
    </button>
    <div class="dropdown mt-4">
      <button class="btn btn-secondary dropdown-toggle" style="float: right;" type="button" data-toggle="dropdown" aria-expanded="false">
        Sort By Channel
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Default</a>
        @foreach($channels as $channel)
        <a class="dropdown-item" href="{{route('customers.by.channel', ['channel_id'=>$channel->id])}}">{{$channel->name}}</a>
        @endforeach
      </div>
    </div>

    @include('partials._message')
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th class="mobile" scope="col">Phone</th>
      <!-- <th scope="col">Email</th> -->
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
   @foreach($customers as $customer)
   <tr>
      <th scope="row">{{$customer->id}}</th>
      <td>{{$customer->name}}</td>
      <td class="mobile">{{$customer->phone}}</td>
      <!-- <td>{{$customer->email}}</td> -->
      <td style="display:flex; flex-direction:row; grid-gap:0.8rem;">
        <a href="{{route('admin.user.show', [$customer->id])}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-user"></i></a>
        <a href="{{route('admin.user.transaction', [$customer->id])}}" class="btn btn-sm btn-secondary">Trx</a>
       @if(Auth::user()->access == 'admin')
       <button class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#deactivate-{{$customer->id}}"><i class="fa-regular fa-circle-xmark"></i></button>
       @endif
      </td>
    </tr>
     
      
   @endforeach
  </tbody>
</table>
</div>
@include('admin.agents.include._new_agent_modal')

@endsection