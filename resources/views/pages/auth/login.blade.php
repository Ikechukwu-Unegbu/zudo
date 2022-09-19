@extends('layouts.public')

@section('head')
@endsection

@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('https://cdn.pixabay.com/photo/2016/05/06/09/25/human-1375492_960_720.png');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h3 class="text-light">Spartan Cooperative Limited</h3>
                            <p>
                            Spartan Cooperative Limited is a technology-driven grassroots financial services company. We focus on both banked and unbanked, leveraging cutting-edge technology and a human-centered approach to provide financial services to our customers and members.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li>Login</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        <!-- ======= About Us Section ======= -->
     
        <div class="container mb-5" style="margin-bottom: 5rem;">
            <form action="{{route('login')}}" method="POST" class="form mb-5 py-5">
                @csrf 
                @include('partials._message')
                <div class="form-group">
                    <h4 class="text-center">Login</h4>
                </div>
                <div class="form-group mt-4">
                    <label for="" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control">
                </div>
                <div class="form-group mt-4">
                    <label for="" class="form-label">Password</label>
                    <input type="text" name="password" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <label for="" class="form-label">Remember Me</label>
                    <input type="checkbox" name="remember_me">
                </div>
                <div class="form-group mt-4">
                    <button style="float:right;" class="btn btn-sm btn-primary">Login</button>
                </div>
            </form>
        </div>

        
     
        

        
      
    </main>
@endsection
