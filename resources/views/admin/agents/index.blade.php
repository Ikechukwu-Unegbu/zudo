@extends('layouts.admin')

@section('head')

@endsection

@section('content')
<div class="container">
<h3 class="text-center">Channels or Agents List</h3>
<div>
    @if(Auth::user()->access == 'admin' || Auth::user()->access =='superadmin')
    <button class="button btn btn-sm btn-primary"  data-toggle="modal" data-target="#new-staff">
        new channel
    </button>
    @endif

    @include('partials._message')
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Email</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
   @foreach($channels as $agent)
   <tr>
      <th scope="row">{{$agent->id}}</th>
      <td>{{$agent->name}}</td>
      <td>{{$agent->phone}}</td>
      <td>{{$agent->email}}</td>
      <td>
        <a href="{{route('admin.user.show', [$agent->id])}}" class="btn btn-sm btn-primary">Profile</a>
        <a href="{{route('panel.agent.transactions', [$agent->id])}}" class="btn btn-sm btn-secondary">Transactions</a>
        <button class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#deactivate-{{$agent->id}}">Deactivate</button>
      </td>
    </tr>
    @include('admin.agents.include._deactivate_modal')   
      
   @endforeach
  </tbody>
</table>
</div>
@include('admin.agents.include._new_agent_modal')

@endsection