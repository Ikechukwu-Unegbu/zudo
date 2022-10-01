

<!-- Modal -->
<div class="modal fade" id="new-kin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create Kin for {{$user->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('panel.kin.add', [$user->id])}}" enctype="multipart/form-data" method="post">
          @csrf 
          <div class="form-group mt-3">
            <label for="" class="form-label">Fullname</label>
            <input type="text" name="fullname" class="form-control">
          </div>
          <div class="form-group mt-3">
            <label for="" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control">
          </div>
          <div class="form-group mt-3">
            <label for="" class="form-label">Email</label>
            <input type="text" name="email" class="form-control">
          </div>
          <div class="form-group mt-3">
            <label for="" class="form-label">Gender</label>
            <select name="gender" class="custom-select">
                <option selected>Open this select menu</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
               
            </select>
          </div>
          <div class="form-group mt-3">
            <label for="" class="form-label">Relationship</label>
            <select name="relation" class="custom-select">
                <option selected>Open this select menu</option>
                <option value="brother">Brother</option>
                <option value="sister">Sister</option>
                <option value="aunt">Aunt</option>
                <option value="mother">Mother</option>
                <option value="father">Father</option>
                <option value="spouse">Spouse</option>
                <option value="child">Child</option>
            </select>
          </div>
          <div class="form-group mt-3">
            <label for="" class="form-label">ID Card</label>
            <input type="file" name="kin_image" class="form-control">
          </div>
          <div class="form-group mt-3">
            <button class="btn btn-sm btn-info" style="float: right;">Add</button>
          </div>
        </form>
      </div>
  
    </div>
  </div>
</div>