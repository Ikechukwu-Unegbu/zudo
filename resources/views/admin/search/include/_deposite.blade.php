
<!-- Modal -->
<div class="modal fade" id="deposite-{{$customer->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Make Deposte for {{$customer->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('agent.customer.deposit.index', [$customer->id])}}" method="post">
            @csrf
            <div class="form-group">
                <label for="" class="form-label">Amount</label>
                <input type="text" name="amount" placeholder="Enter deposite amount" class="form-control">
            </div>
            <div class="form-group">
            <select class="custom-select" name="type" id="inputGroupSelect01">
                <!-- <option selected value="1">Deposite</option> -->
                <option value="0">Withdraw</option>
            </select>
            </div>
           
            <div class="form-group">
                <label for="" class="form-label">Description(Optional)</label>
                <textarea name="" id="" name="purpose" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <!-- <div class="form-group">
                <label for="" class="form-label">Confirm Password</label>
                <input type="text" name="confirm" class="form-control">
            </div> -->
            <div class="form-group">
                <button style="float: right;" class="btn btn-sm btn-primary">Create</button>
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