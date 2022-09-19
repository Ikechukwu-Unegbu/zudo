
<!-- Modal -->
<div class="modal fade" id="deposit-{{$comment->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="">
        <h5 class="modal-title" id="staticBackdropLabel">@if($comment->transaction->trx_type == 1)Deposit @else Withdrawal @endif Details</h5>
        
        <!-- <span style=""><button class="btn btn-sm"><i class="fa-solid fa-pen-to-square"></i></button></span> -->
        <div>
            <span><button class="btn btn-sm" data-toggle="modal" data-target="#deposit-edit-{{$comment->id}}"><i class="fa-solid fa-pen-to-square"></i></button></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
      </div>
      <div class="modal-body">
      <ul class="list-group">
        <li class="list-group-item">
            <span>Transaction ID: </span>
            <span>{{$comment->transaction->id}}</span>
        </li>
        <li class="list-group-item">
            <span>Agent: </span>
            <span><a href="{{route('admin.user.show', [$comment->transaction->agent->id])}}">{{$comment->transaction->agent->name}}</a></span>
        </li>
        <li class="list-group-item">
            <span>Customer: </span>
            <span> <a href="{{route('admin.user.show', [$comment->transaction->customer->id])}}">{{$comment->transaction->customer->name}}</a></span>
        </li>
        <li class="list-group-item">
            <span>Amount: </span>
            <span>NGN {{$comment->transaction->amount}}</span>
            <!-- <span><button class="btn btn-sm"><i class="fa-solid fa-pen-to-square"></i></button></span>
            -->
        </li> 
        <li class="list-group-item">
            <span>Date: </span>
            <span>{{$comment->transaction->created_at}}</span>
        </li>
        <li class="list-group-item">
            <span>Description: </span>
            <span>{{$comment->transaction->purpose}}</span>
        </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="deposit-edit-{{$comment->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Responding to Transaction Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="">
            @csrf 
            <div class="form-group mt-3">
                <div id="alert" class="alert alert-secondary" role="alert">
                A simple secondary alert—check it out!
                </div>
            </div>
            <div class="form-group mt-4">
                <label for="" class="form-label">Amount</label>
                <input type="text" id="amount" name="amount" value="{{$comment->transaction->amount}}" class="form-control">
            </div>
                <input type="text" style="display: none;" id="comment_id" name="comment_id" value="{{$comment->transaction->id}}">
            <div class="form-group mt-4">
                <label for="" class="form-label">Purpose</label>
                <input type="text" id="purpose" value="{{$comment->transaction->purpose}}" name="purpose" class="form-control">
            </div>

            <div class="form-group mt-3">
                <button id="update_btn" type="button" style="float: right;" class="btn btn-sm btn-group">
                    Update
                </button>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>