@extends('layouts.admin')

@section('head')
<link rel="stylesheet" href="{{asset('css/pages/comment/comment.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    #alert{
        display: none;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="filter">
        <form action="" method="get" class="filter_form">
            <select class="custom-select" id="inputGroupSelect01">
                <option selected>Choose...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <input type="date" class="form-control">
            <input type="date" class="form-control">
            <button style="width: 15rem;" class="btn btn-sm btn-primary">Fetch</button>
        </form>
    </div>
    <!-- copied comment html -->
    <div class="comment-container">
        @foreach($comments as $comment)
        <div class="card comment-card">
        <div class="card-body comment-card-body">
           
            <div class="inner-comment">
                <img @if($comment->user->avatar == null) src="{{asset('image\avatar.jpg')}}" @else @endif class="img-fluid" alt="">
                <div class="comment-content">
                    {{$comment->comment}}
                </div>
            </div>
           
            <div class="comment-footer">
                <div class="deet">
                    <span>Date: </span>
                    <span>{{$comment->created_at}}</span>
                </div>
                <div class="deet">
                    <span>Agent: </span>
                    <span>{{$comment->user->name}}</span>
                </div>
                <div class="deet">
                    <button class="btn btn-sm" data-toggle="modal" data-target="#deposit-{{$comment->id}}">See Trx</button>
                </div>
            </div>
        </div>
    </div>
            @include('admin.comment._deposit_modal')
        @endforeach

        <div>{{$comments->links()}}</div>
    </div>
    <!-- end -->
  
</div>

<script>
    let updateBtn = document.getElementById('update_btn');
    let amount = document.getElementById('amount');
    let purpose = document.getElementById('purpose')      
    let commentId = document.getElementById('comment_id')
    let alert = document.getElementById('alert')



    updateBtn.addEventListener('click', function(){
        console.log(amount.value, purpose.value, commentId.value);
        
        fetch('/update-deposite/'+amount.value+'/'+purpose.value+'/'+commentId.value)
            .then(data => {
                return data.json();
                })
            .then(response => {
                console.log(response);
                    alert.innerText = response['message']
                    alert.style.display = 'flex';
                });
            })
</script>
@endsection