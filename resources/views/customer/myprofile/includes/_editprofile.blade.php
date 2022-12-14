<div class="tab-pane fade profile-edit pt-3" id="profile-edit">

<!-- Profile Edit Form -->
<form>
  <div class="row mb-3">
    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
    <div class="col-md-8 col-lg-9">
      <img @if($loggedUser->avatar == null) src="{{asset('image\avatar.jpg')}}" @else @endif alt="Profile">
      <div class="pt-2">
        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
      </div>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
    <div class="col-md-8 col-lg-9">
      <input name="fullName" type="text" class="form-control" id="fullName" value="{{$loggedUser->fullname}}">
    </div>
  </div>

  <!-- <div class="row mb-3">
    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
    <div class="col-md-8 col-lg-9">
      <textarea name="about" class="form-control" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
    </div>
  </div> -->

 
  <div class="row mb-3">
    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
    <div class="col-md-8 col-lg-9">
      <input name="job" type="text" class="form-control" id="Job" value="Web Designer">
    </div>
  </div>

 

  <div class="row mb-3">
    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
    <div class="col-md-8 col-lg-9">
      <input name="address" type="text" class="form-control" id="Address" value="{{$loggedUser->address}}">
    </div>
  </div>

  <div class="row mb-3">
    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
    <div class="col-md-8 col-lg-9">
      <input name="phone" type="text" class="form-control" id="Phone" value="{{$loggedUser->phone}}">
    </div>
  </div>

  <div class="row mb-3">
    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
    <div class="col-md-8 col-lg-9">
      <input name="email" type="email" class="form-control" id="Email" value="{{$loggedUser->email}}">
    </div>
  </div>


  <div class="text-center">
    <button type="submit" class="btn btn-primary">Save Changes</button>
  </div>
</form><!-- End Profile Edit Form -->

</div>