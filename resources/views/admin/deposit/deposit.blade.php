@extends('layouts.admin')

@section('head')
<link rel="stylesheet" href="{{asset('css\pages\deposit\deposit.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  textarea{
    height: 6rem !important;
  }
  .must{
    color: red;
  }
</style>
@endsection

@section('content')
<div class="container">
  <div>
    <form class="search_form" action="{{route('admin.customer.deposit')}}" method="get">
        <div class="form-group">
          <!-- <label for="" class="form-label">Start Date</label> -->
          <input type="date" name="start_date" class="form-control">
        </div>
        <div class="form-group">
          <!-- <label for="" class="form-label">End Date</label> -->
          <input type="date" name="end_date" class="form-control"/>
        </div>
        <div class="form-group">
          <!-- <label for="" class="form-label"></label> -->
          <button class="btn btn-info">Go</button>
        </div>
    </form>
</div>
<h3 class="text-center">Deposits</h3>
<div>

    {{--@include('partials._message')--}}
</div>
    <!-- table start -->
    <div class="">
      <button class="btn btn-sm btn-primary"
      data-toggle="modal" data-target="#new-deposit">New Deposit</button>
    </div>
    <table class="table">
      <thead class="mb-2 mt-2">
        @include('partials._message')
      </thead>
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Amount</th>
          <th class="mobile" scope="col">Agent</th>
          <th scope="col">Customer</th>
          <th class="mobile">Date</th>
          <!-- <th>Status</th> -->
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($transactions as $trx)
        <tr>
          <th scope="row">{{$trx->id}}</th>
          <td>{{$trx->amount}}</td>
          <td class="mobile">{{$trx->agent->name}}</td>
          <td>{{$trx->customer->name}}</td>
          <td class="mobile">{{ date('M d-Y @ h:ma', strtotime($trx->created_at)) }}</td>
          {{--<td>
            @if($trx->sync != 0)
                <span>Approved</span>
            @else
                <span>Pending</span>
            @endif
          </td>--}}
          <td>
            <!-- comment buttons -->
            @if($loggedUser->access == 'channel')
            <button data-toggle="modal" data-target="#comment-{{$trx->id}}" class="btn btn-sm btn-secondary">
                <span>{{count($trx->comment)}}</span>|<span> <i class="fa fa-solid fa-comment"></i></span>
            </button>
            <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#read-{{$trx->id}}">
                <span>{{count($trx->comment)}}</span>|<span><i class="fa fa-solid fa-eye"></i></span>
            </button>
            {{-- <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#edit-deposit-{{$trx->id}}">
                <span><i class="fa fa-solid fa-edit"></i></span>
            </button> --}}
            @elseif($loggedUser->access == 'admin')
            <button data-toggle="modal" data-toggle="modal" data-target="#read-{{$trx->id}}" data-target="#read-{{$trx->id}}" class="btn btn-sm btn-secondary">
                <span>{{count($trx->comment)}}</span>|<span><i class="fa-solid fa-eye"></i></span>
            </button>
            @else
            @endif
            <!-- end of comment buttons -->
            <!-- beginning of edit -->
            <!-- @if($loggedUser->access == 'agent')
            <button data-toggle="modal" @if($trx->sync ==1)disabled=true @else disabled=false @endif  data-target="#comment-{{$trx->id}}" class="btn btn-sm btn-secondary">
                <span><i class="fa-solid fa-pen-to-square"></i></span>
            </button>
            @elseif($loggedUser->access == 'admin')
            <button class="btn btn-sm btn-secondary">
                <span><i class="fa-solid fa-pen-to-square"></i></span>
            </button>
            @else
            @endif -->
            <!--view comments if any  -->

          </td>
        </tr>
        @include('admin.deposit.include._comment')
        @include('admin.deposit.include._read_comment')
        @endforeach
      </tbody>
    </table>
    <!-- table end -->
    <div class="">
      {{$transactions->links()}}
    </div>
</div>

@include('admin.deposit.include._new_deposit')
@endsection
