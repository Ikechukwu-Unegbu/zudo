<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" >
  Launch static backdrop modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="edit-bank-{{$bank->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit {{$user->name}}'s Bank Deet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('panel.bank.update', [$user->id, $bank->id])}}" method="post">
            @csrf 
            <div class="form-group mt-2">
                <label for="" class="form-label">Bank Name</label>
                <input type="text" name="name" value="{{$bank->bank_name}}" class="form-control">
            </div>
            <div class="form-group mt-2">
                <label for="" class="form-label">Bank Account</label>
                <input type="text" name="account" value="{{$bank->bank_account}}" class="form-control">
            </div>
            <div class="form-group mt-2">
                <button class="btn-sm btn btn-info" style="float: right;">Save</button>
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