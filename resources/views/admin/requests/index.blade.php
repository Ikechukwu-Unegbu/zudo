@extends('layouts.admin')

@section('head')

@endsection

@section('content')
<div class="container">
    <div class="">
        <!-- <button data-toggle="modal" data-target="#new-request" class="btn btn-sm btn-primary">
            New Request
        </button> -->
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#request-new">
            New Request
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
            <th scope="col">Amount</th>
            <th scope="col">Type</th>
            <th scope="col">Customer</th>
            <th scope="col">Customer Bal.</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
              @if($request->approved ==0)  
                <tr style="background-color:white;">
                    <th scope="row">{{$request->id}}</th>
                    <td>{{$request->amount}}</td>
                    <!-- <th></th> -->
                    <td>{{$request->type}}</td>
                    <td>{{$request->customer->name}}</td>
                    <td>{{$request->customer->mybalance($request->id)}}</td>
                    <td>
                        @if($request->approved == 0) Unresolved @else  Resolved @endif
                    </td>
                    <td>
                        @if(Auth::user()->access == 'admin')
                        <button data-toggle="modal" data-target="#request-{{$request->id}}" class="btn btn-sm btn-primary">Acc. No</button>
                        <!-- <button class="btn btn-sm btn-info">Paid</button> -->
                        <button data-toggle="modal" data-target="#confirm-{{$request->id}}" class="btn btn-sm btn-info">Paid</button>
                        @endif
                    </td>
                <!-- <td>@mdo</td> -->
                </tr>
              @else 
              <tr >
                    <th scope="row">{{$request->id}}</th>
                    <td>{{$request->amount}}</td>
                    <!-- <th></th> -->
                    <td>{{$request->type}}</td>
                    <td>{{$request->customer->name}}</td>
                    <td>{{$request->customer->mybalance($request->id)}}</td>
                    <td>
                        @if($request->approved == 0) Unresolved  @else Resolved @endif
                    </td>
                    <td>
                       @if(Auth::user()->access == 'admin')
                        <button data-toggle="modal" data-target="#request-{{$request->id}}" class="btn btn-sm btn-primary">Acc. No</button>
                        <button data-toggle="modal" data-target="#confirm-{{$request->id}}" class="btn btn-sm btn-info">Paid</button>
                       @endif
                    </td>
                <!-- <td>@mdo</td> -->
                </tr>
              @endif
            @include('admin.requests.modals._accounts_modal')
            @include('admin.requests.modals._confirm_paid_modal')
            @endforeach
        </tbody>
    </table>
</div>
@include('admin.requests.modals._new_request')

<script>
    let userId = document.getElementById('customer');
    let cname = document.getElementById('customer_name')
    console.log(cname)

    userId.addEventListener('change', function(){
        fetch('/agent/fetchuser/'+userId.value)
        .then(data=>{
            return data.json();
        })
        .then(response=>{
            let customer_name = document.getElementById('customer_name')
            cname.innerText = response.name;
            console.log(response)
    
        })
    })

</script>

@endsection