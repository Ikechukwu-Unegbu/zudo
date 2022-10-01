@extends('layouts.admin')

@section('head')

@endsection

@section('content')
<div class="container">
    <div class="">
        <button data-toggle="modal" data-target="#new-channel" class="btn btn-sm btn-primary">
            New Channel
        </button>
    </div>
    <div class="">
        @include('partials._message')
    </div>
    <table class="table">
        <thead>
            <h5 class="text-center"><b>Table of Channels</b></h5>
        </thead>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Description</th>
            <th>No. Customers</th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
            @foreach($channels as $cha)
            <tr>
                <th scope="row">{{$cha->id}}</th>
                <td>{{ $cha->name}}</td>
                <th>{{ $cha->email }}</th>
                <td>{{$cha->channel_description}}</td>
                <td>Nill</td>
                <td>
                    <button class="btn btn-sm btn-primary">View Analytics</button>
                </td>
                <!-- <td>@mdo</td> -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('admin.channel.include._new_channel')
@endsection
