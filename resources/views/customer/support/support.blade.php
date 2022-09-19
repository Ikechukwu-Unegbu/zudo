@extends('layouts.customer')


@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{asset('css\pages\deposit\deposit.css')}}">
<style>
    .support-page{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    .card-body{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .card{
        box-shadow: 0 0 8px whitesmoke;
    }
</style>

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
    <div class="container">
    <!-- <div>
        <form class="search_form" action="{{route('admin.customer.search')}}" method="get">
            @include('admin.partials._customer_search_form')
        </form>
    </div> -->

    <div>

        @include('partials._message')
    </div>
    <div class="support-page">
        <!--card begins  -->
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><b>Drop a Complain</b></h5>
                <i class="fa-solid fa-microscope fa-4x"></i>
                <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                <p class="card-text text-center">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <button style="width:100% !important;" data-bs-toggle="modal" data-bs-target="#complain" class="card-link btn btn-sm btn-primary">Click</button>
            </div>
         </div>
        <!-- card ends -->
         <!--card begins  -->
         <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><b>Drop a Positive Review</b></h5>
                <i class="fa-solid fa-face-smile fa-4x"></i>
                <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                <p class="card-text text-center">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <button style="width:100% !important;" data-bs-toggle="modal" data-bs-target="#review" class="card-link btn btn-sm btn-primary">Click</button>
            </div>
         </div>
        <!-- card ends -->
    </div>
  
</div>



<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="complain" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hi {{$loggedUser->name}}, we are help to help.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">

            <input style="display:none;" type="text" name="_csrf" value="{{csrf_token()}}"/>
            <div class="form-group mt-4">
                <label for="" class="form-label">Your Message:</label>
                <textarea name="" id="user_complain" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group mt-4">
                <button onclick="checkUserDetails()" type="button" style="float:right; width:100%;" class="btn btn-sm btn-primary">Send</button>
            </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>





<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="review" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tell Us What You Love About Spartan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-group mt-3">
            <label for="" class="form-label">Can We use your feedback publicly with your name?</label>
            <select name="usage" id="usage" class="form-control custom-select" id="inputGroupSelect01">
              <option selected>Choose...</option>
              <option value="anon">Share without my name</option>
              <option value="share">Share with my name</option>
            </select>
          </div>
          <div class="form-group mt-3">
            <label for="" class="form-label"></label>
            <textarea name="review" id="user_review" cols="30" rows="10" class="form-control"></textarea>
          </div>
          <div class="form-group mt-3">
            <!-- <label for="" class="form-label"></label> -->
            <button style="float:right;" type="button" onclick="sendReview()" class="btn btn-sm btn-primary">Send</button>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

@include('customer.support.include._complain_recieved')
@include('pages.support.include._review_recieved')

<script>
    let user_complain = document.getElementById('user_complain')
    let test = document.getElementById('complain_recieved')
    let user_review = document.getElementById('user_review')
    let usage = document.getElementById('usage')
    console.log(test)

    function checkUserDetails() {
           
      let payload = {
        complain:user_complain.value
      }
      let options ={
        method:'POST',
        headers:{
          'Content-Type':'application/json',
          'X-CSRF-Token': document.querySelector('input[name="_csrf"]').value
        },
        body:JSON.stringify(payload)
      }
      //make the call
      fetch('/send-complain', options)
      .then(data=>{
          return data.json();
      }).then(res => {
          console.log('res',res)
          return;
      })
     // return 0;
      $("#complain_recieved").modal('show')   
      $("#complain").modal('hide')
       
    }
    
    function sendReview(){
             
      let payload = {
        review:user_review.value,
        usage:usage.value
      }
      let options ={
        method:'POST',
        headers:{
          'Content-Type':'application/json',
          'X-CSRF-Token': document.querySelector('input[name="_csrf"]').value
        },
        body:JSON.stringify(payload)
      }
      //make the call
      fetch('/send-review', options)
      .then(data=>{
          return data.json();
      }).then(res => {
          console.log('res',res)
          return;
      })
   
    //   var reviewModal = new bootstrap.Modal(document.getElementById('review'))
    //     reviewModal.hide()

        var myModalEl = document.getElementById('review');
            var modal = bootstrap.Modal.getInstance(myModalEl)
            modal.hide();

        var feedbackModal = new bootstrap.Modal(document.getElementById('feedback_recieved'))
        feedbackModal.show()


     

    //   $("#feedback_recieved").modal('show')   
    //   $("#review").modal('hide')
    }
    
</script>
    </section>

@endsection 