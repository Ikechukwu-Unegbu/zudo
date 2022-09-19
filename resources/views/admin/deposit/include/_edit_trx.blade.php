<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="edit-{{$trx->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><b>Admin Record Editing</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('deposit.com.based.update', [$trx->id])}}" method="post">
            @csrf 
            <div class="form-group">
                <label for="" class="form-label">Amount <span><b class="must">*</b></span></label>
                <input type="text" name="amount" value="{{$trx->amount}}" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label for="" class="form-label">User ID <span><b class="must">*</b></span></label>
                <input type="text" name="customer" value="{{$trx->customer->id}}" class="form-control">
                <small><span></span></small>
            </div>
            <div class="form-group mt-3">
                <label for="" class="form-label">Trx Type - Debit or Credit</label>
                <select class="custom-select" name="type" id="inputGroupSelect01">
                    <option  @if($trx->trx_type == 1) selected @endif value="1">Credit</option>
                    <option @if($trx->trx_type == 0) selected @endif  value="0">Withdrawal</option>
                    <!-- <option value="3">Three</option> -->
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="" class="form-label">Description(Optional)</label>
                <!-- <input type="text" name="" class="form-control"> -->
                <textarea name="purpose" id="" cols="30" rows="5" class="form-control">{!!$trx->purpose!!}</textarea>
            </div>
            <div class="form-group mt-3">
                <button style="float: right;" class="btn btn-sm btn-primary">Save</button>
            </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm">Understood</button>
      </div> -->
    </div>
  </div>
</div>