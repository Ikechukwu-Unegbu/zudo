<div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img @if($loggedUser->avatar == null) src="{{asset('image\avatar.jpg')}}" @else @endif alt="Profile" class="rounded-circle">
              <h3>{{$loggedUser->name}} @if($loggedUser->fullname !== null) ({{$loggedUser->fullname}}) @endif</h3>
              <h3>Spartan Member</h3>
              <!-- <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div> -->
            </div>
          </div>
