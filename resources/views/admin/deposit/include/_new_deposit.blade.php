<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="new-deposit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"> New Deposit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('agent.customer.dep')}}" method="post">
            @csrf 
            <div class="form-group">
              <h5 id="wallet" class="textcenter">

              </h5>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Amount <span><b class="must">*</b></span></label>
                <input type="text" name="amount" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label for="" class="form-label">User ID <span><b class="must">*</b></span></label>
                <input type="text" id="customer" name="customer" class="form-control">
                <small><span style="font-weight:bold ;" id="customer_display"></span></small>
            </div>
            <div class="form-group mt-3">
                <label for="" class="form-label">Description(Optional)</label>
                <!-- <input type="text" name="" class="form-control"> -->
                <textarea name="purpose" id="" cols="30" rows="5" class="form-control"></textarea>
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
{{-- @foreach ($transactions as $trx)
<div class="modal fade" id="edit-deposit-{{ $trx->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"> Edit Deposit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('agent.customer.dep')}}" method="post">
              @csrf
              <div class="form-group">
                  <label for="" class="form-label">Amount <span><b class="must">*</b></span></label>
                  <input type="text" name="amount" value="{{ $trx->amount }}" class="form-control">
              </div>
              @if(auth()->user()->access == 'admin')
              <div class="form-group mt-3">
                  <label for="" class="form-label">User ID <span><b class="must">*</b></span></label>
                  <input type="text" name="customer" class="form-control">
                  <small><span></span></small>
              </div>
              @endif
              <div class="form-group">
                  <label for="" class="form-label">Select a User <span>*</span></label>
                  <select class="custom-select" name="customer">
                      <option selected>Open this select menu</option>
                      @foreach($users as $user)
                          <option value="{{ $user->id }}" {{ ($user->id == $trx->customer_id) ? 'selected' : '' }}>{{ $user->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group mt-3">
                  <label for="" class="form-label">Description(Optional)</label>
                  <!-- <input type="text" name="" class="form-control"> -->
                  <textarea name="purpose" id="" cols="30" rows="5" class="form-control">{{ $trx->purpose }}</textarea>
              </div>
              <div class="form-group mt-3">
                  <button style="float: right;" class="btn btn-sm btn-primary">Save</button>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btn-sm">Understood</button>
        </div>
      </div>
    </div>
</div>
@endforeach --}}
