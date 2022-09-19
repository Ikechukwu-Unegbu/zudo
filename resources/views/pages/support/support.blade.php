@extends('layouts.admin')

@section('head')
<link rel="stylesheet" href="{{asset('css\pages\deposit\deposit.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <button style="width:100% !important;" data-toggle="modal" data-target="#complain" class="card-link btn btn-sm btn-primary">Click</button>
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
                <button style="width:100% !important;" data-toggle="modal" data-target="#review" class="card-link btn btn-sm btn-primary">Click</button>
            </div>
         </div>
        <!-- card ends -->
    </div>
  
</div>



<!-- Modal -->
<div class="modal fade" id="complain" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" id="modal-complain">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Hi {{$loggedUser->name}}, we are help to help.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="complain-body">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div> -->
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="review" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tell Us What You Love About Spartan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-group mt-3">
            <label for="" class="form-label">Can We use your feedback publicly with your name?</label>
            <select name="usage" id="usage" class="custom-select" id="inputGroupSelect01">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div> -->
    </div>
  </div>
</div>
@include('pages.support.include._complain_recieved')
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

      $("#feedback_recieved").modal('show')   
      $("#review").modal('hide')
    }
    
</script>
@endsection