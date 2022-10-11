@extends('layouts.public')

@section('head')

@endsection

@section('content')

  <!-- ======= Hero Section ======= -->
  @include('pages.home.include._hero')
  <!-- End Hero Section -->

  <main id="main">

    <!-- ======= Featured Services Section ======= -->
    @include('pages.home.include._featured_service')
    <!-- End Featured Services Section -->

    <!-- ======= About Us Section ======= -->
    @include('pages.home.include._about')
    <!-- End About Us Section -->

    <!-- ======= Services Section ======= -->
    {{--@include('pages.home.include._services')--}}
    <!-- End Services Section -->

    <!-- ======= Call To Action Section ======= -->
    @include('pages.home.include._call')
    <!-- End Call To Action Section -->

    <!-- ======= Features Section ======= -->
    {{--@include('pages.home.include._features')--}}
    <!-- End Features Section -->

    <!-- ======= Pricing Section ======= -->
    {{--@include('pages.home.include._pricing')--}}
    <!-- End Pricing Section -->
    <br><br><br>
    <!-- ======= Testimonials Section ======= -->
    {{--@include('pages.home.include._testimonial')--}}
    <!-- End Testimonials Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    {{-- @include('pages.home.include._faq') --}}
    <!-- End Frequently Asked Questions Section -->
    <br><br>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('partials._footer')
  <!-- End Footer -->
@endsection