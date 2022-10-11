<style>
  .form-label span{
    color: red;
    font-weight: bolder;
  }
</style>
<!-- Modal -->
<div class="modal fade" id="new-staff" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">New Zudovest Channel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('channel.channel.create')}}" method="post" enctype='multipart/form-data'>
            @csrf
            <div class="form-group">
                <label for="" class="form-label">Username <span>*</span></label>
                <input type="text" name="username" class="form-control">
            </div>
           {{-- <div class="form-group mt-2">
              <label for="" class="form-label">Profile Pics</label>
              <div class="custom-file">
                <!-- <label for="" class="form-label">Upload Doc/ID Card</label> -->
                <input type="file" name="user_dp" class="form-control" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <!-- <label class="custom-file-label" for="inputGroupFile01">Choose file</label> -->
              </div>
            </div>--}}
            <div class="form-group">
                <label for="" class="form-label">Fullname <span>*</span></label>
                <input type="text" name="fullname" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Email <span>*</span></label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Phone <span>*</span></label>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="form-group">
              <label for="" class="form-label">Select User type <span>*</span></label>
                <select class="custom-select" name="user_type">
                    <option selected>Open this select menu</option>
                    <option value="channel">Agent</option>
                    <option value="user">Customer</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            {{--<div class="form-group">
                <label for="" class="form-label">Select a Channel <span>*</span></label>
                    <select class="custom-select" name="channel">
                      <option selected>Open this select menu</option>
                        @foreach($channels as $channel)
                            <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                        @endforeach
                    </select>
            </div>--}}
            <div class="form-group">
                <label for="" class="form-label">Password <span>*</span></label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Confirm Password <span>*</span></label>
                <input type="password" name="confirm" class="form-control">
            </div>
            <hr>
            <!-- next of kin -->
           {{-- <h5 class="text-center">Next of Kin Info</h5>
            <div class="form-group mt-2">
              <label for="" class="form-label">Fullname: </label>
              <input type="text" name="kin_fullname" class="form-control">
            </div>
            <div class="form-group mt-2">
              <label for="" class="form-label">Email: </label>
              <input type="text" class="form-control" name="kin_email">
            </div>
            <div class="form-group mt-2">
              <label for="" class="form-label">Phone: </label>
              <input type="text" name="kin_phone" class="form-control">
            </div>
            <div class="form-group mt-2">
              <label for="" class="form-label">Gender:</label>
              <select class="custom-select" name="kin_gender" id="inputGroupSelect02">
                <option selected>Choose...</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <!-- <option value="3">Three</option> -->
              </select>
            </div>
            <div class="form-group mt-2">
              <label for="" class="form-label">Doc/ID Card</label>
              <div class="custom-file">
                <!-- <label for="" class="form-label">Upload Doc/ID Card</label> -->
                <input type="file" name="kin_image" class="form-control" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <!-- <label class="custom-file-label" for="inputGroupFile01">Choose file</label> -->
              </div>
            </div>
            <hr>
            <h5 class="text-center">Bank Details</h5>
            <div class="form-group mt-2">
              <label for="" class="form-label">Bank Name: </label>
              <input type="text" name="bank_name" class="form-control">
            </div>
            <div class="form-group mt-2">
              <label for="" class="form-label">Bank Account: </label>
              <input type="text" name="bank_account" class="form-control">
            </div>--}}
            <divi class="form-group mt-2">
              <label for="" class="form-label">Description</label>
              <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
            </divi>
            <div class="form-group mt-3">
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
