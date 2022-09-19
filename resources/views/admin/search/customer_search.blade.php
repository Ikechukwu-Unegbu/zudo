@extends('layouts.admin')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
.search_form{
    display: flex !important;
    flex-direction: row !important;
    align-items: center;   
}
table{
  width: 100% !important;
}
@media(max-width:700px){
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
<h3 class="text-center"> Agents or Staffs List</h3>
<div>
    <button class="button btn btn-sm btn-primary"  data-toggle="modal" data-target="#new-staff">
        new staff
    </button>

    @include('partials._message')
</div>

<table class="table">
  <thead>Search Results</thead>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th class="mobile" scope="col">Phone</th>
      <th class="mobile" scope="col">Email</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
   @foreach($customers as $customer)
   <tr>
      <th scope="row"> <a>{{$customer->id}}</a></th>
      <td> <a href="{{route('admin.user.show', [$customer->id])}}" >{{$customer->name}}</a></td>
      <td class="mobile">{{$customer->phone}}</td>
      <td class="mobile">{{$customer->email}}</td>
      <td>
        <!-- <a class="btn btn-sm btn-primary">Profile</a> -->
        <a href="{{route('admin.user.transaction', [$customer->id])}}" class="btn mobile btn-sm btn-secondary">Trx</a>
        @if(Auth::user()->access == 'admin')
        <button  class="mobile btn btn-sm btn-danger"  data-toggle="modal" data-target="#deactivate-{{$customer->id}}"><i class="fa-regular fa-circle-xmark"></i></button>
        @endif
        <button class="btn btn-sm btn-success"  data-toggle="modal" data-target="#deposite-{{$customer->id}}">Credit</button>
        <a href="{{route('admin.requests')}}" class="btn btn-sm btn-info">Debit</a>
      </td>
    </tr>
     
      @include('admin.search.include._deposite')
   @endforeach
  </tbody>
</table>
</div>
@include('admin.agents.include._new_agent_modal')

@endsection