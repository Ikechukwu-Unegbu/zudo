<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="request-new" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('agent.withdraw')}}" method="post">
            @csrf 
            <div class="form-group">
                <label for="" class="form-label">Amount</label>
                <input type="text" name="amount" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Customer</label>
                <input type="text" name="customer" id="customer" class="form-control">
                <small id="customer_name"></small>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Method</label>
                <select name="method" class="custom-select" id="inputGroupSelect01">
                    <option selected>Choose...</option>
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                    <!-- <option value="3">Three</option> -->
                </select>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Purpose(Optional)</label>
                <input type="text" name="purpose" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-sm btn-primary">
                    Post Withdraws Request
                </button>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>