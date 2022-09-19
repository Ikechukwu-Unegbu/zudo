
<!-- Modal -->
<div class="modal fade" id="comment-{{$trx->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Comment on {{$trx->created_at}} transact by {{$trx->customer->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('deposit.comment', [$trx->id])}}" method="post">
            @csrf
            <div class="form-group">
                <label for="" class="form-label">Leave a Comment:</label>
                <textarea name="comment" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button style="float: right;" class="btn btn-sm btn-primary">Comment</button>
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