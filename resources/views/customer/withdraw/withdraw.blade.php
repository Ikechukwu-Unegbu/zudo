@extends('layouts.customer')


@section('head')

@endsection

@section('content')
<div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <a href="" class="btn btn-sm btn-primary">See </a>
        <form class="row g-3" action="{{route('withdraw.register')}}" method="POST">
            @csrf
            <div class="form-group">
                <h3 class="text-center">Withdrawal Request Form</h3>
            </div>
            <div class="form-group">
                @include('partials._message')
            </div>
            <div class="col-12">
                <label for="inputNanme4" class="form-label">Amount</label>
                <input type="text" class="form-control" name="amount" id="inputNanme4">
            </div>
            <div class="col-12">
                <label for="inputEmail4" class="form-label">Cash or Transfer</label>
                <select class="form-select" name="type" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">Cash</option>
                    <option value="2">Transfer</option>
                    <!-- <option value="3">Three</option> -->
                </select>
            </div>
            <div class="col-12">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="inputPassword4">
            </div>
            <div class="col-12">
                <label for="" class="form-label">Description(optional)</label>
                <textarea name="" id="" cols="30" rows="10" name="description" class="form-control"></textarea>
            </div>
          
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </section>

@endsection 