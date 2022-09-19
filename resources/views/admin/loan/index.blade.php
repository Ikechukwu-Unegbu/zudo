@extends('layouts.admin')

@section('head')
<link rel="stylesheet" href="{{asset('css\pages\deposit\deposit.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container">

<div>
 @include('partials._message')
</div>

    <h2 class="text-center"><b>Loan Management</b> is Coming Soon!</h2>
    
</div>


@endsection